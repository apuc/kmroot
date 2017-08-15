<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;

/**
 * Class Year
 * @package Kinomania\Original\Film
 */
class Year
{
    use TRepository;
    use TDate;
    
    public function getList($year, $page = 1)
    {
        $list = [];

        $year = intval($year);
        $page = intval($page);
        $offset = ($page - 1) * 24;
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t1.`year`, t1.`country`, t3.`frame`, t3.`wallpaper`, t3.`poster`, t3.`trailer` 
                                         FROM (SELECT `id` FROM `film` WHERE `status` = 'show' AND `year` = {$year} ORDER BY `weight` DESC LIMIT {$offset}, 24) as `t`
                                         JOIN `film` as `t1` ON t1.`id` = t.`id`
                                         LEFT JOIN `film_stat` as `t3` ON t1.`id` = t3.`filmId`
                                         ORDER BY t1.`weight` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }

            /**
             * Director.
             */
            $crew = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_crew` WHERE `filmId` = {$row['id']} ORDER BY `order` LIMIT 1) as `t` 
                                         JOIN `film_crew` as `t1` ON t.`id` = t1.`id`
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t1.`type` = 'Режиссер' AND t2.`status` = 'show' LIMIT 1");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $crew[$row2['id']] = $name;
            }

            /**
             * Actor.
             */
            $cast = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_cast` WHERE `filmId` = {$row['id']} ORDER BY `order` LIMIT 16) as `t` 
                                         JOIN `film_cast` as `t1` ON t.`id` = t1.`id` 
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t2.`status` = 'show' LIMIT 4");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $cast[$row2['id']] = $name;
            }

            $row['country'] = explode(',', $row['country']);
            if (1 < $page) {
                $country = [];
                foreach ($row['country'] as $code) {
                    $code = trim($code);
                    if (!empty($code)) {
                        $country[] = Country::RU[$code];
                    }
                }
                $row['country'] = implode(', ', $country);
            }

            $list[] = [
                'id' => $row['id'],
                'image' => $row['image'],
                'name_origin' => $row['name_origin'],
                'name_ru' => $row['name_ru'],
                'cast' => $cast,
                'crew' => $crew,
                'country' => $row['country'],
                'frame' => $row['frame'],
                'wallpaper' => $row['wallpaper'],
                'poster' => $row['poster'],
                'trailer' => $row['trailer'],
            ];
        }
        
        return $list;
    }
}
