<?php
namespace Kinomania\Original\Logic\Script;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Script
 * @package Kinomania\Original\Script
 */
class Script
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getList()
    {
        $list = [
            'ru' => [],
            'en' => []
        ];

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t3.`s`, t3.`image`, t3.`name_origin`, t3.`name_ru`
                                            FROM (SELECT `id` FROM `film_script` WHERE `language` = 'ru' ORDER BY `id` DESC LIMIT 16) as `t`
                                            JOIN `film_script` AS `t1` ON t.`id` = t1.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` ORDER BY t1.`id` DESC LIMIT 16
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['filmId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $list['ru'][] = [
                \Kinomania\Original\Key\Film\Script::ID => $row['id'],
                \Kinomania\Original\Key\Film\Script::IMAGE => $image,
                \Kinomania\Original\Key\Film\Script::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME => $row['name_ru'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME_EN => $row['name_origin'],
            ];
        }
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t3.`s`, t3.`image`, t3.`name_origin`, t3.`name_ru`
                                            FROM (SELECT `id` FROM `film_script` WHERE `language` = 'en' ORDER BY `id` DESC LIMIT 16) as `t`
                                            JOIN `film_script` AS `t1` ON t.`id` = t1.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` ORDER BY t1.`id` DESC LIMIT 16
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['filmId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $list['en'][] = [
                \Kinomania\Original\Key\Film\Script::ID => $row['id'],
                \Kinomania\Original\Key\Film\Script::IMAGE => $image,
                \Kinomania\Original\Key\Film\Script::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME => $row['name_ru'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $list;
    }
    
    public function ajaxList()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        //$query = "SELECT ANY_VALUE(t1.`id`) as `id`, t1.`filmId`, t3.`s`, t3.`image`, t3.`name_origin`, t3.`name_ru` ";
        $query = "SELECT t1.`id` as `id`, t1.`filmId`, t3.`s`, t3.`image`, t3.`name_origin`, t3.`name_ru` ";
        $letter = trim($filter['letter']);
        if (!empty($letter)) {
            $letter = $this->mysql()->real_escape_string($letter);
            //$query .= " FROM (SELECT ANY_VALUE(a.`id`) as `id` FROM `film_script` as `a` JOIN `film_letter` as `l` ON a.`filmId` = l.`filmId` WHERE 1 AND l.`letter` = '{$letter}' GROUP BY a.`filmId` ORDER BY ANY_VALUE(a.`id`) DESC) as `t` ";
            $query .= " FROM (SELECT a.`id` as `id` FROM `film_script` as `a` JOIN `film_letter` as `l` ON a.`filmId` = l.`filmId` WHERE 1 AND l.`letter` = '{$letter}' ORDER BY a.`id` DESC) as `t` ";
        } else {
            //$query .= " FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_script` GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC) as `t` ";
            $query .= " FROM (SELECT `id` as `id` FROM `film_script` ORDER BY `id` DESC) as `t` ";
        }
        $query .= " JOIN `film_script` AS `t1` ON t.`id` = t1.`id`          
                    JOIN `film` as `t3` ON t1.`filmId` = t3.`id` ";

        $genre = $filter['genre'];
        if (count($genre)) {
            $query .= " JOIN `film_genre` as `g1` ON g1.`filmId` = t1.`filmId` ";
        }
        $query .= " WHERE 1 ";

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
        $query .= " AND t3.`type` IN ('', 'series', 'series_ru') ";

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
        $offset = ($page - 1) * 16;
        //$query .= " GROUP BY t3.`id` LIMIT {$offset}, 16";
        $query .= " LIMIT {$offset}, 16";

        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['filmId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $list[] = [
                \Kinomania\Original\Key\Film\Script::ID => $row['id'],
                \Kinomania\Original\Key\Film\Script::IMAGE => $image,
                \Kinomania\Original\Key\Film\Script::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME => $row['name_ru'],
                \Kinomania\Original\Key\Film\Script::FILM_NAME_EN => $row['name_origin'],
            ];
        }

        return $list;
    }
}