<?php
namespace Kinomania\Control\Video;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Config\Server;
use Kinomania\System\Text\TText;

class Video extends DB
{
    use TText;
    
    const TYPE_EXIST = 'TYPE_EXIST';

    public function load($id = 0, $url = '')
    {
        set_time_limit(0);

        $post = new PostBag();
        if (0 == $id) {
            $id = $post->fetchInt('id');
        }
        if ('' == $url) {
            $url = $post->fetch('url');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::MEDIA[Server::MEDIA_CURRENT] . '/upload/video');
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'url' => urlencode($url),
        ];

        if (isset($_FILES['fileList'])) {
            if (count($_FILES['fileList']['tmp_name'])) {
                foreach ($_FILES['fileList']['tmp_name'] as $k => $file) {
                    if (!empty($_FILES['fileList']['name'][$k])) {
                        $postVar['fileList' . $k] = new \CURLFile($file, $_FILES['fileList']['type'][$k], $_FILES['fileList']['name'][$k]);
                    }
                }
            }
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        
        return curl_exec($ch);
    }

    /**
     * @param $m
     * @param int $id
     * @param int $hd
     * @return mixed
     */
    public function deleteVideo($m, $id, $hd)
    {
        $id = intval($id);
        $hd = intval($hd);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::MEDIA[$m] . '/upload/video?handler=delete');
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'hd' => $hd,
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    public function editTrailer()
    {
        $this->error = '';
        $post = new PostBag();

        $permissible = ['no', 'yes', 'show', 'hide', 'true', 'false', ''];

        $id = $post->fetchInt('id');
        $filmId = $post->fetchInt('filmId');
        $status = $post->fetch('status');
        if (!in_array($status, $permissible)) {
            $this->error = 'BAD STATUS VALUE';
            return false;
        }
        $date = strtotime($post->fetch('date'));
        $no_main = $post->fetch('no_main');
        if (!in_array($no_main, $permissible)) {
            $this->error = 'BAD POPULAR VALUE';
            return false;
        }
        $popular = $post->fetch('popular');
        if (!in_array($popular, $permissible)) {
            $this->error = 'BAD POPULAR VALUE';
            return false;
        }
        $local = $post->fetch('local');
        if (!in_array($local, $permissible)) {
            $this->error = 'BAD LOCAL VALUE';
            return false;
        }
        $type = $post->fetchInt('type');

        /**
        $result = $this->db->query("SELECT 1 FROM `trailer` WHERE `filmId` = {$filmId} AND `type` = {$type} AND `id` != {$id} LIMIT 1");
        if (0 < $result->num_rows) {
            $this->error = self::TYPE_EXIST;
            return false;
        }
         * **/

        $this->db->query("UPDATE `trailer` SET
                            `filmId` = {$filmId},
                            `status` = '{$status}',
                            `no_main` = '{$no_main}',
                            `date` = FROM_UNIXTIME('{$date}'),
                            `popular` = '{$popular}',
                            `local` = '{$local}',
                            `type` = {$type}
                            WHERE `id` = {$id} LIMIT 1
                          ");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Stat.
         */
        if (0 < $filmId) {
            $stat = new Stat($this->db);
            $stat->updateTrailerCount($filmId);
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('film:' . $filmId)) {
            $redis->delete('film:' . $filmId);
            if ($redis->exists('film:' . $filmId . ':min')) {
                $redis->delete('film:' . $filmId . ':min');
            }
        }

        return true;
    }

    /**
     * @param $id
     * @return Trailer
     */
    public function getTrailer($id)
    {
        $id = intval($id);
        $item = new Trailer();

        $result = $this->db->query("SELECT t1.*, t2.`name` FROM `trailer` as `t1` JOIN `trailer_type` as `t2` ON t1.`type` = t2.`id` WHERE t1.`id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $personList = [];
            $result2 = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `trailer_person` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`trailerId` = {$row['id']}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $personList[$row2['id']] = $name;
            }
            $row['personList'] =  $personList;
            $item->initFromArray($row);
        }
        
        return $item;
    }

    /**
     * @param int $filmId
     * @return array
     */
    public function getTrailerList($filmId)
    {
        $list = [];
        
        $filmId = intval($filmId);
        
        $result = $this->db->query("SELECT t1.*, t2.`name` FROM `trailer` as `t1` JOIN `trailer_type` as `t2` ON t1.`type` = t2.`id` WHERE t1.`filmId` = {$filmId} ORDER BY t1.`id`");
        while ($row = $result->fetch_assoc()) {
            $item = new Trailer();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }

    /**
     * Create new trailer.
     * @return bool
     */
    public function addTrailer()
    {
        $this->error = '';
        $post = new PostBag();

        $permissible = ['no', 'yes'];

        $filmId = $post->fetchInt('filmId');
        $s = Server::STATIC_CURRENT;
        $image = '';
        $date = strtotime('now');
        $popular = $post->fetch('popular');
        if (!in_array($popular, $permissible)) {
            $this->error = 'BAD POPULAR VALUE';
            return false;
        }
        $local = $post->fetch('local');
        if (!in_array($local, $permissible)) {
            $this->error = 'BAD LOCAL VALUE';
            return false;
        }
        $type = $post->fetchInt('type');

        /**
        $result = $this->db->query("SELECT 1 FROM `trailer` WHERE `filmId` = {$filmId} AND `type` = {$type} LIMIT 1");
        if (0 < $result->num_rows) {
            $this->error = self::TYPE_EXIST;
            return false;
        }
         * **/

        $this->db->query("INSERT INTO `trailer` SET
                            `filmId` = {$filmId},
                            `status` = 'hide',
                            `no_main` = 'false',
                            `s` = {$s},
                            `image` = '{$image}',
                            `date` = FROM_UNIXTIME('{$date}'),
                            `popular` = '{$popular}',
                            `local` = '{$local}',
                            `type` = {$type},
                            `m` = 0,
                            `hd480` = '',
                            `hd720` = '',
                            `hd1080` = '',
                            `source` = '',
                            `weight` = 0
                          ");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function addType()
    {
        $this->error = '';
        $post = new PostBag();
        
        $name = $this->db->real_escape_string($this->clearText($post->fetch('name')));

        /**
         * Name must be unique.
         */
        $result = $this->db->query("SELECT 1 FROM `trailer_type` WHERE `name` = '{$name}' LIMIT 1");
        if (0 < $result->num_rows) {
            $this->error = self::TYPE_EXIST;
            return false;
        }
        
        $this->db->query("INSERT INTO `trailer_type` SET `name` = '{$name}'");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }
        
        return true;
    }

    /**
     * @return array
     */
    public function getTypeList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT `id`, `name` FROM `trailer_type` ORDER BY `name`");
        while ($row = $result->fetch_assoc()) {
            $list[$row['id']] = $row['name'];
        }
        
        return $list;
    }

    /**
     * @param $id
     * @return string
     */
    public function getTypeNameById($id)
    {
        $id = intval($id);
        $result = $this->db->query("SELECT `name` FROM `trailer_type` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            return $row['name'];
        }
        
        return '';
    }

    /**
     * @return bool
     */
    public function editType()
    {
        $post = new PostBag();
        
        $id = $post->fetchInt('id');
        $name = $this->db->real_escape_string($this->clearText($post->fetch('name')));

        /**
         * Name must be unique.
         */
        $result = $this->db->query("SELECT 1 FROM `trailer_type` WHERE `name` = '{$name}' AND `id` != {$id} LIMIT 1");
        if (0 < $result->num_rows) {
            $this->error = self::TYPE_EXIST;
            return false;
        }

        $this->db->query("UPDATE `trailer_type` SET `name` = '{$name}' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }
        
        return true;
    }

    /**
     * @return bool
     */
    public function deleteType()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');

        /**
         * Type uses.
         */
        $result = $this->db->query("SELECT 1 FROM `trailer` WHERE `type` = {$id} LIMIT 1");
        if (0 < $result->num_rows) {
            $this->error = self::TYPE_EXIST;
            return false;
        }

        $this->db->query("DELETE FROM `trailer_type` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id = 0)
    {
        $post = new PostBag();

        if (0 == $id) {
            $id = $post->fetchInt('id');
        } else {
            $id = intval($id);
        }

        $filmId = 0;
        $result = $this->db->query("SELECT `filmId`, `m`, `hd480`, `hd720`, `hd1080` FROM `trailer` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (!empty($row['hd480'])) {
                $this->deleteVideo(Server::MEDIA_CURRENT, $id, '480');
            }
            if (!empty($row['hd720'])) {
                $this->deleteVideo(Server::MEDIA_CURRENT, $id, '720');
            }
            if (!empty($row['hd1080'])) {
                $this->deleteVideo(Server::MEDIA_CURRENT, $id, '1080');
            }
            $filmId = $row['filmId'];
        }

        $this->db->query("DELETE FROM `trailer` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Image.
         */
        $static = new StaticS();
        json_decode($static->delete('film_trailer', 0, $id, 'jpeg'), true);

        $this->db->query("DELETE FROM `trailer_person` WHERE `trailerId` = {$id}");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $this->db->query("DELETE FROM `trailer_stat` WHERE `trailerId` = {$id}");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Comment.
         */
        $comment = new Comment($this->db);
        $result = $this->db->query("SELECT `id` FROM `comment` WHERE `relatedId` = {$id} AND `type` = 'trailer' AND `parent` = 0");
        while ($row = $result->fetch_assoc()) {
            $comment->delete($row['id']);
        }

        /**
         * Stat.
         */
        if (0 < $filmId) {
            $stat = new Stat($this->db);
            $stat->updateTrailerCount($filmId);
        }

        return true;
    }



    public function personList($filmId)
    {
        $list = [];
        $filmId = intval($filmId);

        $result = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru`  FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$filmId} ORDER BY t1.`order`");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            $list[$row['id']] = $name;
        }

        $result = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru`  FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$filmId} ORDER BY t1.`order`");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            if (!isset($list[$row['id']])) {
                $list[$row['id']] = $name;
            }
        }

        return $list;
    }

    /**
     * @return bool
     */
    public function person()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');
        $personList = $post->fetch('personList');
        if (!is_array($personList)) {
            $personList = explode(',', $personList);
        }

        $result = $this->db->query("SELECT `id`, `personId` FROM `trailer_person` WHERE `trailerId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            if (!in_array($row['personId'], $personList)) {
                $this->db->query("DELETE FROM `trailer_person` WHERE `id` = {$row['id']} LIMIT 1");
            }
        }

        foreach ($personList as $personId) {
            $personId = intval($personId);
            $result = $this->db->query("SELECT 1 FROM `trailer_person` WHERE `trailerId` = {$id} AND `personId` = {$personId}");
            if (0 == $result->num_rows) {
                $this->db->query("INSERT INTO `trailer_person` SET `trailerId` = {$id}, `personId` = {$personId}");
            }
        }
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }
}