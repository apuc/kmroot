<?php
namespace Kinomania\Control\Film\Frame;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Person\Stat;
use Kinomania\System\Base\DB;

class Frame extends DB
{
    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');

        $photo_session = 'no';
        if ($post->has('photo_session')) {
            $photo_session = 'yes';
        }
        $film_set = 'no';
        if ($post->has('film_set')) {
            $film_set = 'yes';
        }
        $concept = 'no';
        if ($post->has('concept')) {
            $concept = 'yes';
        }
        $screenshot = 'no';
        if ($post->has('screenshot')) {
            $screenshot = 'yes';
        }

        $this->db->query("UPDATE `film_frame` SET `photo_session` = '{$photo_session}', `film_set` = '{$film_set}', `concept` = '{$concept}', `screenshot` = '{$screenshot}' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
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

        $result = $this->db->query("SELECT `id`, `personId` FROM `film_frame_person` WHERE `frameId` = {$id}");
        $stat = new Stat($this->db);
        while ($row = $result->fetch_assoc()) {
            if (!in_array($row['personId'], $personList)) {
                $this->db->query("DELETE FROM `film_frame_person` WHERE `id` = {$row['id']} LIMIT 1");

                /**
                 * Person stat.
                 */
                $stat->updateFrameCount($row['personId']);
            }
        }

        foreach ($personList as $personId) {
            $personId = intval($personId);
            $result = $this->db->query("SELECT 1 FROM `film_frame_person` WHERE `frameId` = {$id} AND `personId` = {$personId}");
            if (0 == $result->num_rows) {
                $this->db->query("INSERT INTO `film_frame_person` SET `frameId` = {$id}, `personId` = {$personId}");
            }

            /**
             * Person stat.
             */
            $stat->updateFrameCount($personId);
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

        $result = $this->db->query("SELECT * FROM `film_frame` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $personList = [];
            $result2 = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_frame_person` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`frameId` = {$row['id']}");
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

        $result = $this->db->query("SELECT `id`, `s`, `image`, `width`, `height`, `size`, `photo_session`, `film_set`, `concept`, `screenshot` FROM `film_frame` WHERE `filmId` = {$filmId} ORDER BY `order` DESC");
        while ($row = $result->fetch_assoc()) {
            $personList = [];
            $result2 = $this->db->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_frame_person` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`frameId` = {$row['id']}");
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