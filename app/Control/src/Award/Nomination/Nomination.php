<?php
namespace Kinomania\Control\Award\Nomination;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

/**
 * Class Nomination
 * @package Kinomania\Control\Award\Nomination
 */
class Nomination extends DB
{
    /**
     * Error codes.
     */
    const ER_INPUT = 1;
    const ER_EXIST = 2;
    
    /**
     * @param $id
     * @return Item
     */
    public function getById($id): Item
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `awards_nomination` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $this->error = '';
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $this->db->query("DELETE FROM `awards_nomination` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
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
        $name_ru = $post->fetchEscape('name_ru', $this->db);
        $name_en = $post->fetchEscape('name_en', $this->db);
        $awardId = $post->fetchInt('awardId');
        $type = $post->fetchEscape('type', $this->db);
        
        if (empty($name_ru)) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $item = $this->getById($id);
        if ($item->name_ru() != $name_ru) {
            $result = $this->db->query("SELECT 1 FROM `awards_nomination` WHERE `name_ru` = '{$name_ru}' AND `awardId` = {$awardId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->error = self::ER_EXIST;
                return false;
            }
        }

        $this->db->query("UPDATE `awards_nomination` SET
                          `name_ru` = '{$name_ru}',
                          `name_en` = '{$name_en}',
                          `type` = '{$type}'
                          WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function add()
    {
        $this->error = '';
        $post = new PostBag();
        
        $name_ru = $post->fetchEscape('name_ru', $this->db);
        $name_en = $post->fetchEscape('name_en', $this->db);
        $awardId = $post->fetchInt('awardId');
        $type = $post->fetchEscape('type', $this->db);

        if (empty($name_ru)) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `awards_nomination` WHERE `name_ru` = '{$name_ru}' AND `awardId` = {$awardId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::ER_EXIST;
            return false;
        }

        $this->db->query("INSERT INTO `awards_nomination` SET
                          `name_ru` = '{$name_ru}',
                          `name_en` = '{$name_en}',
                          `awardId` = {$awardId},
                          `type` = '{$type}'
                          ");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }
}