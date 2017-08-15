<?php
namespace Kinomania\Original\Logic\Photo;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Photo
 * @package Kinomania\Original\Photo
 */
class Photo
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`personId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`photo`
                                              FROM (SELECT ANY_VALUE(`id`) as `id` FROM `person_photo` GROUP BY `personId` ORDER BY `id` DESC) as `t`
                                              JOIN `person_photo` AS `t1` ON t1.`id` = t.`id`
                                              LEFT JOIN `person_stat` as `t4` ON t1.`personId` = t4.`personId`               
                                              JOIN `person` as `t3` ON t1.`personId` = t3.`id` ORDER BY t1.`id` DESC LIMIT 24
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.285.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                \Kinomania\Original\Key\Person\Photo::ID => $row['id'],
                \Kinomania\Original\Key\Person\Photo::IMAGE => $image,
                \Kinomania\Original\Key\Person\Photo::COUNT => $row['photo'],
                \Kinomania\Original\Key\Person\Photo::LIST => [],
                \Kinomania\Original\Key\Person\Photo::PERSON_ID => $row['personId'],
                \Kinomania\Original\Key\Person\Photo::PERSON_NAME => $name,
                \Kinomania\Original\Key\Person\Photo::PERSON_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $list;
    }
    
    public function getPopular()
    {
        $popular = [];

        $popularId = [];
        $result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'person_photo' LIMIT 1");
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
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`personId`, t1.`s`, 
                                            t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`photo`
                                            FROM `person_photo` AS `t1` 
                                            JOIN `person` as `t3` ON t1.`personId` = t3.`id` 
                                            LEFT JOIN `person_stat` as `t4` ON t1.`personId` = t4.`personId`
                                            WHERE t1.`id` IN ({$popularId})
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.205.256.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    \Kinomania\Original\Key\Person\Photo::ID => $row['id'],
                    \Kinomania\Original\Key\Person\Photo::IMAGE => $image,
                    \Kinomania\Original\Key\Person\Photo::COUNT => $row['photo'],
                    \Kinomania\Original\Key\Person\Photo::LIST => [],
                    \Kinomania\Original\Key\Person\Photo::PERSON_ID => $row['personId'],
                    \Kinomania\Original\Key\Person\Photo::PERSON_NAME => $name,
                    \Kinomania\Original\Key\Person\Photo::PERSON_NAME_EN => $row['name_origin'],
                ];
            }
        }

        if (12 > count($popular)) {
            $result = $this->mysql()->query("SELECT ANY_VALUE(t1.`id`) AS `id`, t1.`personId`, ANY_VALUE(t1.`s`) AS `s`, 
                                            ANY_VALUE(t1.`image`) AS `image`, ANY_VALUE(t3.`name_origin`) AS `name_origin`, ANY_VALUE(t3.`name_ru`) AS `name_ru`, ANY_VALUE(t4.`photo`) AS `photo`
                                            FROM `person_photo` AS `t1` 
                                            JOIN `person` AS `t3` ON t1.`personId` = t3.`id` 
                                            LEFT JOIN `person_stat` AS `t4` ON t1.`personId` = t4.`personId`
                                            WHERE 1 GROUP BY t1.`personId` ORDER BY ANY_VALUE(t1.`id`) DESC LIMIT 40, 12
                                        ");
            while ($row = $result->fetch_assoc()) {
                if (12 == count($popular)) {
                    break;
                }
                if (!empty($row['image'])) {
                    $iName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.205.256.' . $row['image'];
                } else {
                    $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
                }

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $popular[] = [
                    \Kinomania\Original\Key\Person\Photo::ID => $row['id'],
                    \Kinomania\Original\Key\Person\Photo::IMAGE => $image,
                    \Kinomania\Original\Key\Person\Photo::COUNT => $row['photo'],
                    \Kinomania\Original\Key\Person\Photo::LIST => [],
                    \Kinomania\Original\Key\Person\Photo::PERSON_ID => $row['personId'],
                    \Kinomania\Original\Key\Person\Photo::PERSON_NAME => $name,
                    \Kinomania\Original\Key\Person\Photo::PERSON_NAME_EN => $row['name_origin'],
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

        $query =  "SELECT t1.`id`, t1.`personId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`photo`";
        $letter = trim($filter['letter']);
        if (!empty($letter)) {
            $letter = $this->mysql()->real_escape_string($letter);
            $query .= " FROM (SELECT ANY_VALUE(a.`id`) as `id` FROM `person_photo` as `a` JOIN `person_letter` as `l` ON a.`personId` = l.`personId` WHERE l.`letter` = '{$letter}' GROUP BY a.`personId` ORDER BY a.`id` DESC) as `t` ";
        } else {
            $query .= "FROM (SELECT ANY_VALUE(`id`) as `id` FROM `person_photo` GROUP BY `personId` ORDER BY `id` DESC) as `t`";
        }
        $query .=  "JOIN `person_photo` AS `t1` ON t1.`id` = t.`id`
                                              LEFT JOIN `person_stat` as `t4` ON t1.`personId` = t4.`personId`               
                                              JOIN `person` as `t3` ON t1.`personId` = t3.`id` WHERE 1 ";

        /**
         * Person sex.
         */
        $sex = $filter['sex'];
        if (!in_array('male', $sex) || !in_array('female', $sex)) {
            if (in_array('male', $sex)) {
                $query .= " AND t3.`sex` = 'male'";
            } else if (in_array('female', $sex)) {
                $query .= " AND t3.`sex` = 'female'";
            }
        }

        /**
         * Person origin.
         */
        $origin = $filter['origin'];
        if (count($origin)) {
            foreach ($origin as $k => $v) {
                $origin[$k] = $this->mysql()->real_escape_string($v);
            }
            $origin = array_map(function($val) {
                return '\'' . $val . '\'';
            }, $origin);
            $origin = implode(",", $origin);
            $query .= " AND t3.`origin` IN ($origin) ";
        }

        /**
         * Person age.
         */
        $yearList = $filter['year'];
        $yearFrom = $yearList[0] ?? 0;
        $yearTo = $yearList[1] ?? 100;
        $yearFrom = intval($yearFrom);
        $yearTo = intval($yearTo);
        if (0 > $yearFrom) {
            $yearFrom = 0;
        }
        if (100 < $yearTo) {
            $yearTo = 100;
        }

        if ($yearFrom > $yearTo) {
            $temp = $yearTo;
            $yearTo = $yearFrom;
            $yearFrom = $temp;
        }
        if ($yearFrom == $yearTo) {
            $time = new \DateTime(date('Y-m-d'));
            $yearFrom = $time->modify('-' . $yearFrom . ' year')->format('Y-m-d');
            $query .= " AND t3.`birthday` >= '{$yearFrom}' AND t3.`birthday` <= '{$yearFrom}'";
        } else {
            if (0 < $yearFrom) {
                $time = new \DateTime(date('Y-m-d'));
                $yearFrom = $time->modify('-' . $yearFrom . ' year')->format('Y-m-d');
                if (100 > $yearTo) {
                    $time = new \DateTime(date('Y-m-d'));
                    $yearTo = $time->modify('-' . $yearTo . ' year')->format('Y-m-d');
                    $query .= " AND t3.`birthday` <= '{$yearFrom}' AND t3.`birthday` >= '{$yearTo}'";
                } else {
                    $query .= " AND t3.`birthday` <= '{$yearFrom}'";
                }
            } else {
                if (100 > $yearTo) {
                    $time = new \DateTime(date('Y-m-d'));
                    $yearTo = $time->modify('-' . $yearTo . ' year')->format('Y-m-d');
                    $query .= " AND t3.`birthday` >= '{$yearTo}'";
                }
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
        $query .= " ORDER BY t1.`id` DESC LIMIT {$offset}, 24";

        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.285.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $list[] = [
                \Kinomania\Original\Key\Person\Photo::ID => $row['id'],
                \Kinomania\Original\Key\Person\Photo::IMAGE => $image,
                \Kinomania\Original\Key\Person\Photo::COUNT => $row['photo'],
                \Kinomania\Original\Key\Person\Photo::LIST => [],
                \Kinomania\Original\Key\Person\Photo::PERSON_ID => $row['personId'],
                \Kinomania\Original\Key\Person\Photo::PERSON_NAME => $name,
                \Kinomania\Original\Key\Person\Photo::PERSON_NAME_EN => $row['name_origin'],
            ];
        }

        return $list;
    }
}