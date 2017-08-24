<?php
namespace Kinomania\Original\Logic\Poster;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Key\Award\Nominee;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Poster
 * @package Kinomania\Original\Poster
 */
class Poster
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];

        $filmId = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster`
                                            FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_poster` WHERE `width` > 738 GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC LIMIT 12) as `t`
                                            JOIN `film_poster` AS `t1` ON t.`id` = t1.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId` LIMIT 6
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.331.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $filmId[] = $row['filmId'];
            $list[] = [
                \Kinomania\Original\Key\Film\Poster::ID => $row['id'],
                \Kinomania\Original\Key\Film\Poster::IMAGE => $image,
                \Kinomania\Original\Key\Film\Poster::COUNT => $row['poster'],
                \Kinomania\Original\Key\Film\Poster::LIST => [],
                \Kinomania\Original\Key\Film\Poster::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Poster::FILM_NAME => $name,
                \Kinomania\Original\Key\Film\Poster::FILM_NAME_EN => $row['name_origin'],
            ];
        }

        $filmId = implode(',', $filmId);

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster`
                                              FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_poster` WHERE `width` = 738 AND `filmId` NOT IN ({$filmId}) GROUP BY `id` ORDER BY ANY_VALUE(`id`) DESC LIMIT 2) as `t`
                                            JOIN `film_poster` AS `t1` ON t.`id` = t1.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId` LIMIT 2
                                        ");
        
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.738.369.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                \Kinomania\Original\Key\Film\Poster::ID => $row['id'],
                \Kinomania\Original\Key\Film\Poster::IMAGE => $image,
                \Kinomania\Original\Key\Film\Poster::COUNT => $row['poster'],
                \Kinomania\Original\Key\Film\Poster::LIST => [],
                \Kinomania\Original\Key\Film\Poster::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Poster::FILM_NAME => $name,
                \Kinomania\Original\Key\Film\Poster::FILM_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $list;
    }
    
    public function getPopular()
    {
        $popular = [];
        
        $popularId = [];
        $result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'film_poster' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $popularId = unserialize($row['list']);
        }
        if (0 < count($popularId)) {
            foreach ($popularId as $k => $v) {
                $v = intval($v);
                if (1 > $v) {
                    unset($popularId[$k]);
                }
                $popularId[$k] = $v;
            }
            $popularId = implode(',', $popularId);
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, 
                                            t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster`
                                            FROM `film_poster` AS `t1` 
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` 
                                            LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`
                                            WHERE t1.`id` IN ({$popularId})
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.205.274.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    \Kinomania\Original\Key\Film\Poster::ID => $row['id'],
                    \Kinomania\Original\Key\Film\Poster::IMAGE => $image,
                    \Kinomania\Original\Key\Film\Poster::COUNT => $row['poster'],
                    \Kinomania\Original\Key\Film\Poster::LIST => [],
                    \Kinomania\Original\Key\Film\Poster::FILM_ID => $row['filmId'],
                    \Kinomania\Original\Key\Film\Poster::FILM_NAME => $name,
                    \Kinomania\Original\Key\Film\Poster::FILM_NAME_EN => $row['name_origin'],
                ];
            }
        }

        if (12 > count($popular)) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster`
                                            FROM `film_poster` AS `t1` 
                                            JOIN `film` AS `t3` ON t1.`filmId` = t3.`id` 
                                            LEFT JOIN `film_stat` AS `t4` ON t1.`filmId` = t4.`filmId`
                                            WHERE t1.`popular` = 'yes' ORDER BY t1.`id` DESC LIMIT 12
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (12 == count($popular)) {
                    break;
                }
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.205.274.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    \Kinomania\Original\Key\Film\Poster::ID => $row['id'],
                    \Kinomania\Original\Key\Film\Poster::IMAGE => $image,
                    \Kinomania\Original\Key\Film\Poster::COUNT => $row['poster'],
                    \Kinomania\Original\Key\Film\Poster::LIST => [],
                    \Kinomania\Original\Key\Film\Poster::FILM_ID => $row['filmId'],
                    \Kinomania\Original\Key\Film\Poster::FILM_NAME => $name,
                    \Kinomania\Original\Key\Film\Poster::FILM_NAME_EN => $row['name_origin'],
                ];
            }
        }
        
        return $popular;
    }

    public function ajaxList()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        $query = "SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster` ";
        $letter = trim($filter['letter']);
        if (!empty($letter)) {
            $letter = $this->mysql()->real_escape_string($letter);
            $query .= " FROM (SELECT ANY_VALUE(a.`id`) as `id` FROM `film_poster` as `a` JOIN `film_letter` as `l` ON a.`filmId` = l.`filmId` WHERE l.`letter` = '{$letter}' GROUP BY l.`filmId` ORDER BY ANY_VALUE(a.`id`) DESC) as `t` ";
        } else {
            $query .= " FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_poster` GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC) as `t` ";
        }
        $query .= " JOIN `film_poster` AS `t1` ON t1.`id` = t.`id`
                  LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`               
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
        $offset = ($page - 1) * 24;
        $query .= " LIMIT {$offset}, 24";

        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.331.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                \Kinomania\Original\Key\Film\Poster::ID => $row['id'],
                \Kinomania\Original\Key\Film\Poster::IMAGE => $image,
                \Kinomania\Original\Key\Film\Poster::COUNT => $row['poster'],
                \Kinomania\Original\Key\Film\Poster::LIST => [],
                \Kinomania\Original\Key\Film\Poster::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Poster::FILM_NAME => $name,
                \Kinomania\Original\Key\Film\Poster::FILM_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $list;
    }
}