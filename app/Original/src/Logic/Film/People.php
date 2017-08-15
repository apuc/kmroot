<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class People
 * @package Kinomania\Original\Film
 */
class People
{
    use TRepository;
    use TDate;
    
    public function cast($filmId)
    {
        $filmId = intval($filmId);

        $this->item['list'] = [];
        $result = $this->mysql()->query("SELECT t1.`role_ru`, t1.`role_en`, t1.`voice`, t1.`self`, t1.`uncredited`, t1.`episodes`, t1.`year`, t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`,
                                          t3.`frame`, t3.`video`
                                          FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                          LEFT JOIN `person_stat` as `t3` ON t1.`personId` = t3.`personId` 
                                          WHERE t1.`filmId` = {$filmId} AND t2.`status` = 'show' ORDER BY t1.`order`");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.116.' . $row['image'];
            }

            $row['image'] = '';
            $row['imageList'] = [];
            if (0 < $row['frame']) {
                $result2 = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `film_frame` as `t1` JOIN `film_frame_person` as `t2` ON t1.`id` = t2.`frameId` WHERE t1.`filmId` = {$filmId} AND t2.`personId` = {$row['id']}");
                if ($row2= $result2->fetch_assoc()) {
                    if (0 < $row2['count']) {
                        $row['frame'] = ' ' . $this->plural_form($row2['count'], ['кадр', 'кадра', 'кадров']);

                        $first = true;
                        $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image` FROM `film_frame` as `t1` JOIN `film_frame_person` as `t2` ON t1.`id` = t2.`frameId` WHERE t1.`filmId` = {$filmId} AND t2.`personId` = {$row['id']} ORDER BY t1.`order`");
                        while ($row2 = $result2->fetch_assoc()) {
                            if ($first) {
                                $first = false;
                                if ('' != $row2['image']) {
                                    $imageName = md5($row2['id']);
                                    $row['image'] = Server::STATIC[$row2['s']] . '/image' . Path::FILM_FRAME . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.160.100.' . $row2['image'];
                                }
                            }
                            if ('' != $row2['image']) {
                                $imageName = md5($row2['id']);
                                $row['imageList'][] = Server::STATIC[$row2['s']] . Path::FILM_FRAME . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row2['image'];
                            }
                        }
                    } else {
                        $row['frame'] = '';
                    }
                }
            } else {
                $row['frame'] = '';
            }

            if (0 < $row['video']) {
                $result2 = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `trailer` as `t1` JOIN `trailer_person` as `t2` ON t1.`id` = t2.`trailerId` WHERE t1.`filmId` = {$filmId} AND t2.`personId` = {$row['id']}");
                if ($row2= $result2->fetch_assoc()) {
                    if (0 < $row2['count']) {
                        $row['video'] = ' ' . $this->plural_form($row2['count'], ['видео', 'видео', 'видео']);
                        if ('' != $row['frame']) {
                            $row['video'] = ', ' . $row['video'];
                        }
                    } else {
                        $row['video'] = '';
                    }
                }
            } else {
                $row['video'] = '';
            }

            $this->item['list'][] = [
                $row['id'],
                $image,
                $row['name_ru'],
                $row['name_origin'],
                $row['role_ru'],
                $row['role_en'],
                $row['voice'],
                $row['self'],
                $row['uncredited'],
                $row['year'],
                $row['episodes'],
                $row['frame'],
                $row['video'],
                $row['image'],
                $row['imageList'],
            ];
        }

        $this->item['type'] = '';
        if ([] != $this->item['list']) {
            $result = $this->mysql()->query("SELECT `type` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->item['type'] = $row['type'];
            }
        }
        
        return $this->item;
    }
    
    public function crew($filmId)
    {
        $filmId = intval($filmId);

        $this->item['list'] = [];
        $result = $this->mysql()->query("SELECT t1.`type` , t1.`episodes`, t1.`year`, t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`,
                                          t3.`frame`, t3.`video`
                                          FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                          LEFT JOIN `person_stat` as `t3` ON t1.`personId` = t3.`personId` 
                                          WHERE t1.`filmId` = {$filmId} AND t2.`status` = 'show' ORDER BY t1.`type`, t1.`order`");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.116.' . $row['image'];
            }

            $this->item['list'][] = [
                $row['id'],
                $image,
                $row['name_ru'],
                $row['name_origin'],
                $row['type'],
                $row['year'],
                $row['episodes'],
            ];
        }

        $this->item['type'] = '';
        if ([] != $this->item['list']) {
            $result = $this->mysql()->query("SELECT `type` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->item['type'] = $row['type'];
            }
        }
        
        return $this->item;
    }

    private function plural_form($number, $after)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2: $cases[min($number % 10, 5)] ];
    }
    
    private $item;
}
