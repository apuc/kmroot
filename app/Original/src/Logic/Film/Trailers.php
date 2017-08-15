<?php
namespace Kinomania\Original\Logic\Film;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Comment\Comment;
use Kinomania\Original\Key\Person\Trailer;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Trailers
 * @package Kinomania\Original\Film
 */
class Trailers
{
    use TRepository;
    use TDate;
    
    public function get($filmId)
    {
        $list = [];

        $filmId = intval($filmId);

        if (!Wrap::$debugEnabled) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment`
                                            FROM `trailer` AS `t1`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t1.`filmId` = {$filmId} AND t1.`status` = 'show' ORDER BY t1.`local` DESC, t1.`id` DESC 
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment`
                                            FROM `trailer` AS `t1`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t1.`filmId` = {$filmId} ORDER BY t1.`local` DESC, t1.`id` DESC 
                                        ");
        }
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
                Trailer::ID => $row['id'],
                Trailer::DATE => $this->formatDate($row['date'], true, ' '),
                Trailer::NAME => $row['name'],
                Trailer::COMMENT => $row['comment'],
                Trailer::IMAGE => $image,
                Trailer::HD_480 => $row['hd480'],
                Trailer::HD_720 => $row['hd720'],
                Trailer::HD_1080 => $row['hd1080'],
                Trailer::FILM_ID => $row['filmId'],
                Trailer::FILM_NAME => $name,
            ];
        }
        
        return $list;
    }
    public function getById($filmId, $trailerId)
    {
        $list = [];

        $filmId = intval($filmId);
        $trailerId = intval($trailerId);

        if (!Wrap::$debugEnabled) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment`
                                            FROM `trailer` AS `t1`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t1.`id` = {$trailerId} AND t1.`filmId` = {$filmId} AND t1.`status` = 'show' LIMIT 1 
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment`
                                            FROM `trailer` AS `t1`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t1.`id` = {$trailerId} AND t1.`filmId` = {$filmId} LIMIT 1 
                                        ");
        }
        if ($row = $result->fetch_assoc()) {
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

            $list['item'] = [
                Trailer::ID => $row['id'],
                Trailer::DATE => $this->formatDate($row['date'], true, ' '),
                Trailer::NAME => $row['name'],
                Trailer::COMMENT => $row['comment'],
                Trailer::IMAGE => $image,
                Trailer::HD_480 => $row['hd480'],
                Trailer::HD_720 => $row['hd720'],
                Trailer::HD_1080 => $row['hd1080'],
                Trailer::FILM_ID => $row['filmId'],
                Trailer::FILM_NAME => $name,
            ];

            $result = $this->mysql()->query("SELECT t1.`id`, t1.`parent`, t1.`userId`, t1.`name`, t1.`date`, t1.`text`, t3.`like`, t3.`dislike`, t2.`s`, t2.`image`, t2.`login` 
                                                FROM `comment` as `t1` JOIN (SELECT `id` FROM `comment` WHERE `relatedId` = {$trailerId} AND `type` = 'trailer' ORDER BY `date`) as `t` ON t1.`id` = t.`id` 
                                                LEFT JOIN `comment_stat` as `t3` ON t1.`id` = t3.`commentId` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id`
                                              ");
            $list['count'] = $result->num_rows;
            $commentList = [];
            while ($row = $result->fetch_assoc()) {
                if (!empty($row['login'])) {
                    $row['name'] = $row['login'];
                }
                if (empty($row['like'])) {
                    $row['like'] = 0;
                }
                if (empty($row['dislike'])) {
                    $row['dislike'] = 0;
                }
                if ('' != $row['image']) {
                    $imageName = md5($row['userId']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/no-avatar-m.jpg';
                }

                $commentList[$row['id']] = [
                    Comment::ID => $row['id'],
                    Comment::PARENT => $row['parent'],
                    Comment::IMAGE => $row['image'],
                    Comment::LOGIN => $row['login'],
                    Comment::NAME => $row['name'],
                    Comment::TEXT => $row['text'],
                    Comment::DATE => $this->formatDate($row['date'], true, ', '),
                    Comment::LIKE => $row['like'],
                    Comment::DISLIKE => $row['dislike'],
                    Comment::CHILD => [],
                ];
            }

            foreach ($commentList as $k => &$v) {
                if ($v[Comment::PARENT] != 0) {
                    $commentList[$v[Comment::PARENT]][Comment::CHILD][] =& $v;
                }
            }
            unset($v);
            foreach ($commentList as $k => $v) {
                if ($v[Comment::PARENT] != 0) {
                    unset($commentList[$k]);
                }
            }

            $list['list'] = $commentList;
        }

        return $list;
    }
}
