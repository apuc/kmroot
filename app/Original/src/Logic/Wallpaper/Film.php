<?php
namespace Kinomania\Original\Logic\Wallpaper;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Key\Film\Wallpaper;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Film
 * @package Kinomania\Original\Wallpaper
 */
class Film
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`wallpaper`
                                              FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_wallpaper` GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC) as `t`
                                              JOIN `film_wallpaper` AS `t1` ON t1.`id` = t.`id`
                                              LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`               
                                              JOIN `film` as `t3` ON t1.`filmId` = t3.`id` WHERE t3.`status` = 'show' LIMIT 24
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.355.200.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                Wallpaper::ID => $row['id'],
                Wallpaper::IMAGE => $image,
                Wallpaper::COUNT => $row['wallpaper'],
                Wallpaper::LIST => [],
                Wallpaper::REL_ID => $row['filmId'],
                Wallpaper::REL_NAME => $name,
                Wallpaper::REL_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $list;
    }
    
    public function getPopular()
    {
        $popular = [];

        $popularId = [];
        $result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'film_wallpaper' LIMIT 1");
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
                                            t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`wallpaper`
                                            FROM `film_wallpaper` AS `t1` 
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` 
                                            LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`
                                            WHERE t1.`id` IN ({$popularId})
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.350.197.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    Wallpaper::ID => $row['id'],
                    Wallpaper::IMAGE => $image,
                    Wallpaper::COUNT => $row['wallpaper'],
                    Wallpaper::LIST => [],
                    Wallpaper::REL_ID => $row['filmId'],
                    Wallpaper::REL_NAME => $name,
                    Wallpaper::REL_NAME_EN => $row['name_origin'],
                ];
            }
        }

        if (4 > count($popular)) {
            $result = $this->mysql()->query("SELECT ANY_VALUE(t1.`id`) AS `id`, t1.`filmId`, ANY_VALUE(t1.`s`) AS `s`, 
                                            ANY_VALUE(t1.`image`) AS `image`, ANY_VALUE(t3.`name_origin`) AS `name_origin`, ANY_VALUE(t3.`name_ru`) AS `name_ru`, ANY_VALUE(t4.`wallpaper`) AS `wallpaper`
                                            FROM `film_wallpaper` AS `t1` 
                                            JOIN `film` AS `t3` ON t1.`filmId` = t3.`id` 
                                            LEFT JOIN `film_stat` AS `t4` ON t1.`filmId` = t4.`filmId`
                                            WHERE t3.`status` = 'show' GROUP BY t1.`filmId` LIMIT 40, 4
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (4 == count($popular)) {
                    break;
                }
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.350.197.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    Wallpaper::ID => $row['id'],
                    Wallpaper::IMAGE => $image,
                    Wallpaper::COUNT => $row['wallpaper'],
                    Wallpaper::LIST => [],
                    Wallpaper::REL_ID => $row['filmId'],
                    Wallpaper::REL_NAME => $name,
                    Wallpaper::REL_NAME_EN => $row['name_origin'],
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

        $query = "SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`wallpaper` ";
        $letter = trim($filter['letter']);
        if (!empty($letter)) {
            $letter = $this->mysql()->real_escape_string($letter);
            $query .= " FROM (SELECT ANY_VALUE(a.`id`) as `id` FROM `film_wallpaper` as `a` JOIN `film_letter` as `l` ON a.`filmId` = l.`filmId` WHERE l.`letter` = '{$letter}' GROUP BY a.`filmId` ORDER BY ANY_VALUE(a.`id`) DESC) as `t` ";
        } else {
            $query .= "FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_wallpaper` GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC) as `t`";
        }
        $query .= " JOIN `film_wallpaper` AS `t1` ON t1.`id` = t.`id`
                    LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`               
                    JOIN `film` as `t3` ON t1.`filmId` = t3.`id`  ";

        $genre = $filter['genre'];
        if (count($genre)) {
            $query .= " JOIN `film_genre` as `g1` ON g1.`filmId` = t1.`filmId` ";
        }
        $query .= " WHERE t3.`status` = 'show' ";

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
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.355.200.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                Wallpaper::ID => $row['id'],
                Wallpaper::IMAGE => $image,
                Wallpaper::COUNT => $row['wallpaper'],
                Wallpaper::LIST => [],
                Wallpaper::REL_ID => $row['filmId'],
                Wallpaper::REL_NAME => $name,
                Wallpaper::REL_NAME_EN => $row['name_origin'],
            ];
        }

        return $list;
    }
}