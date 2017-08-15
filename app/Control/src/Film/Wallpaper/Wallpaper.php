<?php
namespace Kinomania\Control\Film\Wallpaper;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

class Wallpaper extends DB
{
 
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

        $result = $this->db->query("SELECT `id`, `personId` FROM `film_wallpaper_person` WHERE `wallpaperId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            if (!in_array($row['personId'], $personList)) {
                $this->db->query("DELETE FROM `film_wallpaper_person` WHERE `id` = {$row['id']} LIMIT 1");
            }
        }

        foreach ($personList as $personId) {
            $personId = intval($personId);
            $result = $this->db->query("SELECT 1 FROM `film_wallpaper_person` WHERE `wallpaperId` = {$id} AND `personId` = {$personId}");
            if (0 == $result->num_rows) {
                $this->db->query("INSERT INTO `film_wallpaper_person` SET `wallpaperId` = {$id}, `personId` = {$personId}");
            }
        }
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $item = new Item();

        $id = intval($id);

        $result = $this->db->query("SELECT * FROM `film_wallpaper` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $personList = [];
            $result2 = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_wallpaper_person` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`wallpaperId` = {$row['id']}");
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
     * @param $filmId
     * @return array
     */
    public function getPhoto($filmId)
    {
        $list = [];
        $filmId = intval($filmId);

        $result = $this->db->query("SELECT `id`, `s`, `image`, `width`, `height` FROM `film_wallpaper` WHERE `filmId` = {$filmId} ORDER BY `id` DESC");
        while ($row = $result->fetch_assoc()) {
            $personList = [];
            $result2 = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_wallpaper_person` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`wallpaperId` = {$row['id']}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $personList[$row2['id']] = $name;
            }
            $row['personList'] =  $personList;
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }

        return $list;
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
}