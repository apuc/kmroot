<?php
namespace Original\Route_index_ssi_trailer;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=1800');
        
        $list = [];

        /**
         * New.
         */
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` AS `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 66, 67, 68, 70, 75, 77, 88, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 141, 142, 143, 144, 
                                        5, 12, 13, 14, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 50, 51, 53, 64, 69, 71, 72, 73, 74, 76, 89, 90, 91, 108, 137, 138, 139, 140
                                        ) AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 50) AS `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show'
                                        LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['new'][] = $item;
        }

        /**
         * Popular.
         */
        $list['popular'] = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` AS `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 66, 67, 68, 70, 75, 77, 88, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 141, 142, 143, 144, 
                                        5, 12, 13, 14, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 50, 51, 53, 64, 69, 71, 72, 73, 74, 76, 89, 90, 91, 108, 137, 138, 139, 140
                                        ) AND `popular` = 'yes' AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 50) AS `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show'
                                        LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['popular'][] = $item;
        }

        /**
         * Comment.
         */
        $date = strtotime('now') - 1209600; // 14 days
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` as `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) as `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 66, 67, 68, 70, 75, 77, 88, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 141, 142, 143, 144, 
                                        5, 12, 13, 14, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 50, 51, 53, 64, 69, 71, 72, 73, 74, 76, 89, 90, 91, 108, 137, 138, 139, 140
                                        ) AND `date` > {$date} AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 50) as `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` as `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` as `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show'
                                        ORDER BY t4.`comment` DESC LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['comment'][] = $item;
        }

        /**
         * Local.
         */
        $list['local'] = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` AS `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 66, 67, 68, 70, 75, 77, 88, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 141, 142, 143, 144, 
                                        5, 12, 13, 14, 17, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 50, 51, 53, 64, 69, 71, 72, 73, 74, 76, 89, 90, 91, 108, 137, 138, 139, 140
                                        ) AND `popular` IN ('no','yes') AND `local` = 'yes' AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 50) AS `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show'
                                        LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['local'][] = $item;
        }

        /**
         * Series.
         */
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` AS `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 52, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 66, 67, 68, 70, 75, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 141, 142, 143, 144
                                        ) AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 500) AS `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show' AND t3.`type` = 'series'
                                        LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['series'][] = $item;
        }

        /**
         * Series ru.
         */
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`popular`, t1.`local`, t1.`m`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`, t4.`comment`
                                        FROM `trailer` AS `t1`
                                        JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                        1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 18, 31, 32, 33, 34, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47 ,48, 49, 52, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 66, 67, 68, 70, 75, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 141, 142, 143, 144
                                        ) AND `no_main` = 'false' GROUP BY `filmId` ORDER BY `id` DESC LIMIT 500) AS `t` ON t1.`id` = t.`id`
                                        JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                        JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                        LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                        WHERE t3.`status` = 'show' AND t3.`type` = 'series_ru'
                                        ORDER BY t1.`date` DESC LIMIT 10
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = $row;
            $item['cast'] = [];
            $item['crew'] = [];

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['cast'][$row2['id']] = $name;
            }

            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $item['crew'][$row2['id']] = $name;
            }

            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $item['country'] = [];
            $country = explode(',', $row['country']);
            foreach ($country as $code) {
                $name = Country::RU[$code] ?? '';
                if (!empty($name)) {
                    $item['country'][] = $name;
                }
            }
            $item['country'] = implode(', ', $item['country']);

            $list['series_ru'][] = $item;
        }

        $this->addData([
            'list' => $list
        ]);

        $this->setTemplate('index/ssi/trailer.html.php');
    }
}