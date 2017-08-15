<?php
namespace Kinomania\Original\Logic\Trailer;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Trailer
 * @package Kinomania\Original\Trailer
 */
class Trailer
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`, t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment` 
                                            FROM (SELECT `id` FROM `trailer` WHERE `status` = 'show' AND `local` IN ('no','yes') ORDER BY `id` DESC) as `t` 
                                            JOIN `trailer` AS `t1` ON t.`id` = t1.`id` JOIN `film` as `t3` ON t1.`filmId` = t3.`id`  
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id` 
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId` WHERE 1 AND t3.`year` <= 2038 AND t3.`type` = '' ORDER BY t1.`id` DESC LIMIT 0, 24
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            if (0 == $row['comment']) {
                $row['comment'] = '';
            }

            $list[] = [
                \Kinomania\Original\Key\Person\Trailer::ID => $row['id'],
                \Kinomania\Original\Key\Person\Trailer::DATE => $this->formatDate($row['date'], true, ' '),
                \Kinomania\Original\Key\Person\Trailer::NAME => $row['name'],
                \Kinomania\Original\Key\Person\Trailer::COMMENT => $row['comment'],
                \Kinomania\Original\Key\Person\Trailer::IMAGE => $image,
                \Kinomania\Original\Key\Person\Trailer::HD_480 => $row['hd480'],
                \Kinomania\Original\Key\Person\Trailer::HD_720 => $row['hd720'],
                \Kinomania\Original\Key\Person\Trailer::HD_1080 => $row['hd1080'],
                \Kinomania\Original\Key\Person\Trailer::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Person\Trailer::FILM_NAME => $name,
            ];
        }

        return $list;
    }

    public function ajaxList()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        $query = "SELECT ANY_VALUE(t1.`id`) as `id`, t1.`filmId`, ANY_VALUE(t1.`s`) as `s`, ANY_VALUE(t1.`image`) as `image`, ANY_VALUE(t1.`date`) as `date`,
                    ANY_VALUE(t1.`hd480`) as `hd480`, ANY_VALUE(t1.`hd720`) as `hd720`, ANY_VALUE(t1.`hd1080`) as `hd1080`, ANY_VALUE(t2.`name`) as `name`, ANY_VALUE(t3.`name_origin`) as `name_origin`, ANY_VALUE(t3.`name_ru`) as `name_ru`, ANY_VALUE(t4.`comment`) as `comment`
                    FROM (SELECT a.`id` FROM `trailer` as `a` ";
        $letter = trim($filter['letter']);
        if (!empty($letter)) {
            $query .= " JOIN `film_letter` as `l` ON a.`filmId` = l.`filmId` ";
        }
        $query .= "  WHERE a.`status` = 'show' ";

        /**
         * Trailer language.
         */
        $local = [];
        if (in_array('no', $filter['local'])) {
            $local[] = '\'no\'';
        }
        if (in_array('yes', $filter['local'])) {
            $local[] = '\'yes\'';
        }
        if (count($local)) {
            $local = implode(',', $local);
            $query .= " AND a.`local` IN ({$local}) ";
        } else {
            $query .= " AND a.`local` IN ('no','yes') ";
        }

        /**
         * Trailer type.
         */
        $typeList = [];
        foreach ($filter['type'] as $type) {
            switch ($type) {
                case 'трейлер':
                    $typeList = array_merge($typeList, [2, 3, 4, 6, 8, 31, 33, 34, 38, 39, 40, 41, 42, 44, 45, 46, 52, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 66, 67, 68, 70, 75, 77, 92, 93, 94, 95, 96, 97, 98, 99, 101, 102, 103, 104, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 141, 142, 143, 144]);
                    break;
                case 'тизер':
                    $typeList = array_merge($typeList, [1, 18, 31, 32, 43, 47, 48, 49, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 100, 101, 105, 106, 107, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119]);
                    break;
                case 'телеролик':
                    $typeList = array_merge($typeList, [108]);
                    break;
                case 'эпизод':
                    $typeList = array_merge($typeList, [12, 13, 14, 24, 25, 27, 28, 29, 71]);
                    break;
                case 'репортаж':
                    $typeList = array_merge($typeList, [17, 23]);
                    break;
                case 'клип':
                    $typeList = array_merge($typeList, [22]);
                    break;
            }
        }
        if (count($typeList)) {
            $type = implode(',', $typeList);
            $query .= " AND a.`type` IN ({$type}) ";
        }
        if (!empty($letter)) {
            $letter = $this->mysql()->real_escape_string($letter);
            $query .= " AND l.`letter` = '{$letter}' ";
        }

        $query .= " ORDER BY a.`id` DESC) as `t`
                    JOIN `trailer` AS `t1` ON t.`id` = t1.`id`
                    JOIN `film` as `t3` ON t1.`filmId` = t3.`id`";
        $genre = $filter['genre'];
        if (count($genre)) {
            $query .= " JOIN `film_genre` as `g1` ON g1.`filmId` = t1.`filmId` ";
        }
        $query .=  " JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                    LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId` WHERE 1 ";

        /**
         * Film genre.
         */
        if (count($genre)) {
            foreach ($genre as $k => $v) {
                $genre[$k] = $this->mysql()->real_escape_string($v);
            }
            $genre = array_map(function($val) {
                return '\'' . $val . '\'';
            }, $genre);
            $genre = implode(",", $genre);
            $query .= " AND g1.`genre` IN ($genre) ";
        }

        /**
         * Film type.
         */
        switch ($filter['tab']) {
            case 'series_ru':
                $type = 'series_ru';
                break;
            case 'series_en':
                $type = 'series';
                break;
            default:
                $type = '';
        }
        if (!empty($type)) {
            $query .= " AND t3.`type` = '{$type}' ";
        } else {
            if ('film' == $filter['tab']) {
                $query .= " AND t3.`type` = '' ";
            }
        }

        /**
         * Film year.
         */
        $yearList = $filter['year'];
        $yearFrom = $yearList[0] ?? 1888;
        $yearTo = $yearList[1] ?? 2038;
        $yearFrom = intval($yearFrom);
        $yearTo = intval($yearTo);
        if (1888 > $yearFrom) {
            $yearFrom = 1888;
        }
        if (2038 < $yearTo) {
            $yearTo = 2038;
        }

        if ($yearFrom > $yearTo) {
            $temp = $yearTo;
            $yearTo = $yearFrom;
            $yearFrom = $temp;
        }
        if ($yearFrom == $yearTo) {
            if (2020 > $yearTo) {
                $query .= " AND t3.`year` = {$yearFrom}";
            }
        } else {
            if (1888 < $yearFrom) {
                if (2020 > $yearTo) {
                    $query .= " AND t3.`year` >= {$yearFrom} AND t3.`year` <= {$yearTo}";
                } else {
                    $query .= " AND t3.`year` >= {$yearFrom}";
                }
            } else {
                $query .= " AND t3.`year` <= {$yearTo}";
            }
        }

        /**
         * Page offset.
         */
        $page = intval($filter['page']);
        if (1 > $page) {
            $page = 1;
        }
        $offset = ($page - 1) * 24;
        $query .= " GROUP BY t1.`filmId` ORDER BY ANY_VALUE(t1.`id`) DESC LIMIT {$offset}, 24";

        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            if (0 == $row['comment']) {
                $row['comment'] = '';
            }

            $list[] = [
                \Kinomania\Original\Key\Person\Trailer::ID => $row['id'],
                \Kinomania\Original\Key\Person\Trailer::DATE => $this->formatDate($row['date'], true, ' '),
                \Kinomania\Original\Key\Person\Trailer::NAME => $row['name'],
                \Kinomania\Original\Key\Person\Trailer::COMMENT => $row['comment'],
                \Kinomania\Original\Key\Person\Trailer::IMAGE => $image,
                \Kinomania\Original\Key\Person\Trailer::HD_480 => $row['hd480'],
                \Kinomania\Original\Key\Person\Trailer::HD_720 => $row['hd720'],
                \Kinomania\Original\Key\Person\Trailer::HD_1080 => $row['hd1080'],
                \Kinomania\Original\Key\Person\Trailer::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Person\Trailer::FILM_NAME => $name,
            ];
        }
        
        return $list;
    }
}