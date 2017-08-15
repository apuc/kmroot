<?php
namespace Kinomania\Control\Person\Video;

use Kinomania\System\Base\DB;

class Video extends DB
{
    public function getList($personId)
    {
        $personId = intval($personId);

        $list = [];

        $result = $this->db->query("SELECT t2.`id`, t2.`filmId`, t4.`name`, t3.`name_origin`, t3.`name_ru`
                                    FROM `trailer_person` as `t1`
                                    JOIN `trailer` as `t2` ON t1.`trailerId` = t2.`id`
                                    JOIN `film` as `t3` ON t2.`filmId` = t3.`id`
                                    JOIN `trailer_type` as `t4` ON t2.`type` = t4.`id` 
                                    WHERE t1.`personId` = {$personId} ORDER BY t2.`id` DESC
        ");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            
            $item = new Item();
            $item->initFromArray([
                'id' => $row['id'],
                'filmId' => $row['filmId'],
                'type' => $row['name'],
                'name' => $name
            ]);
            $list[] = $item;
        }

        return $list;
    }
}