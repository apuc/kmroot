<?php
namespace Kinomania\Control\Award;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Film\Stat;
use Kinomania\System\Base\DB;

/**
 * Manage awards.
 * Class Award
 * @package Kinomania\Control\Award
 */
class Award extends DB
{
    /**
     * Error codes.
     */
    const ER_INPUT = 1;
    const ER_EXIST = 2;

    /**
     * @param int $year
     * @param array $nominationIdList
     * @return array
     */
    public function getSetList($year, $nominationIdList)
    {
        $list = [];

        $year = intval($year);
        $nominationIdList = array_map(function ($value) {
            return intval($value);
        }, $nominationIdList);
        $nominationIdList = implode(',', $nominationIdList);

        $result = $this->db->query("SELECT 
                                    t1.`id`, t1.`nominationId`, t1.`win`, t1.`filmId`, t1.`personId`, t2.`name_ru` as `filmName_ru`, t2.`name_origin` as `filmName_origin`, t3.`name_ru`  as `personName_ru`, t3.`name_origin` as `personName_origin`
                                    FROM `awards_set` as `t1` 
                                    LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                    LEFT JOIN `person` as `t3` ON t1.`personId` = t3.`id`
                                    WHERE t1.`year` = {$year} AND t1.`nominationId` IN ($nominationIdList)
                                    ORDER BY t1.`nominationId`
                                    ");
        if (!empty($this->db->error)) {
            return [];
        }
        while ($row = $result->fetch_assoc()) {
            $key = 'winner';
            if ('false' == $row['win']) {
                $key = 'nominee';
            }
            $item = new Set\Item();
            $item->initFromArray($row);
            $list[$row['nominationId']][$key][] = $item;
        }
        
        return $list;
    }

    /**
     * @param $awardId
     * @return array
     */
    public function getNominationList($awardId)
    {
        $awardId = intval($awardId);
        $list = [];

        $result = $this->db->query("SELECT * FROM `awards_nomination` WHERE `awardId` = {$awardId}");
        while ($row = $result->fetch_assoc()) {
            $item = new Nomination\Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }


    /**
     * @param int $id
     * @return Item
     */
    public function getById($id): Item
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `awards` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT * FROM `awards` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $row['yearList'] = [];
            $result_2 = $this->db->query("SELECT `year` FROM `awards_year` WHERE `awardId` = {$row['id']} ORDER BY `year`");
            while ($row_2 = $result_2->fetch_assoc()) {
                $row['yearList'][] = $row_2['year'];
            }
            
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $this->error = '';
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $filmList = [];
        $personList = [];
        $result = $this->db->query("SELECT `filmId`, `personId` FROM `awards_set` WHERE `awardId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $filmList[] = $row['filmId'];
            $personList[] = $row['personId'];
        }

        $this->db->query("DELETE FROM `awards_year` WHERE `awardId` = {$id}");
        $this->db->query("DELETE FROM `awards_nomination` WHERE `awardId` = {$id}");
        $this->db->query("DELETE FROM `awards_set` WHERE `awardId` = {$id}");
        $this->db->query("DELETE FROM `awards` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Film and person stat.
         */
        $filmStat = new Stat($this->db);
        foreach ($filmList as $filmId) {
            $filmStat->updateAwardCount($filmId);
        }
        $personStat = new \Kinomania\Control\Person\Stat($this->db);
        foreach ($personList as $personId) {
            $personStat->updateAwardCount($personId);
        }

        /**
         * Cache.
         */
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('awards')) {
            $redis->delete('awards');
        }

        return true;
    }

    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';
        $post = new PostBag();

        $id = $post->fetchInt('id');

        $code = $post->fetchEscape('code', $this->db);
        if (preg_match('/[^a-z0-9]/', $code)) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `awards` WHERE `id` != {$id} AND `code` = '{$code}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::ER_EXIST;
            return false;
        }
        
        $name_ru = $post->fetchEscape('name_ru', $this->db);
        $name_en = $post->fetchEscape('name_en', $this->db);
        $type = $post->fetchEscape('type', $this->db);
        $description = $post->fetchEscape('description', $this->db);

        $this->db->query("UPDATE `awards` SET
                          `code` = '{$code}',
                          `name_ru` = '{$name_ru}',
                          `name_en` = '{$name_en}',
                          `type` = '{$type}',
                          `description` = '{$description}'
                          WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('awards')) {
            $redis->delete('awards');
        }

        return true;
    }

    /**
     * Create new award.
     * @return bool
     */
    public function add()
    {
        $this->error = '';

        $post = new PostBag();

        $code = $post->fetchEscape('code', $this->db);
        if (preg_match('/[^a-z0-9]/', $code)) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `awards` WHERE `code` = '{$code}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::ER_EXIST;
            return false;
        }

        $name_ru = $post->fetchEscape('name_ru', $this->db);
        $name_en = $post->fetchEscape('name_en', $this->db);
        $type = 'hidden';
        switch ($post->fetch('type')) {
            case 'award':
                $type = 'award';
                break;
            case 'festival':
                $type = 'festival';
        }
        $description = $post->fetchEscape('description', $this->db);

        $this->db->query("INSERT INTO `awards` SET `code` = '{$code}', `name_ru` = '{$name_ru}', `name_en` = '{$name_en}', `type` = '{$type}', `description` = '{$description}', `year` = ''");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('awards')) {
            $redis->delete('awards');
        }

        return true;
    }
}