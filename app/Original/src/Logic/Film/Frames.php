<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\Original\Key\Person\Frame;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Frames
 * @package Kinomania\Original\Film
 */
class Frames
{
    use TRepository;
    use TDate;
    
    public function get($filmId)
    {
        $list = [];
        $filmId = intval($filmId);

        $list['photo_session'] = false;
        $list['film_set'] = false;
        $list['concept'] = false;
        $list['screenshot'] = false;

        $result = $this->mysql()->query("SELECT 
                                            t1.`id`, t1.`s`, t1.`image`, t1.`width`, t1.`height`, t1.`size`, t1.`photo_session`, t1.`film_set`, t1.`concept`, t1.`screenshot`
                                            FROM `film_frame` as `t1` WHERE `filmId` = {$filmId} ORDER BY `order` DESC");
        while ($row = $result->fetch_assoc()) {
            $type = '';
            if ('yes' == $row['photo_session']) {
                $type .= 'photo_session ';
                $list['photo_session'] = true;
            }
            if ('yes' == $row['film_set']) {
                $type .= 'film_set ';
                $list['film_set'] = true;
            }
            if ('yes' == $row['concept']) {
                $type .= 'concept ';
                $list['concept'] = true;
            }
            if ('yes' == $row['screenshot']) {
                $type .= 'screenshot ';
                $list['screenshot'] = true;
            }

            $cast = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                        FROM `film_frame_person` as `t1`
                                                        LEFT JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                        WHERE t1.`frameId` = {$row['id']} ORDER BY t1.`id`
                                                      ");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $cast[] = [$row2['id'], $name];
            }


            $imageName = md5($row['id']);
            $image = Server::STATIC[$row['s']] . Path::FILM_FRAME . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            $preview = Server::STATIC[$row['s']] . '/image' . Path::FILM_FRAME . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.355.237.' . $row['image'];

            $list['list'][] = [
                Frame::ID => $row['id'],
                Frame::IMAGE => $image,
                Frame::PREVIEW => $preview,
                Frame::WIDTH => $row['width'],
                Frame::HEIGHT => $row['height'],
                Frame::SIZE => $row['size'],
                Frame::TYPE => $type,
                Frame::CAST => $cast,
            ];
        }
        
        return $list;
    }
    
    public function getById($filmId, $frameId)
    {
        $list = [];
        
        $filmId = intval($filmId);
        $frameId = intval($frameId);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `width`, `height`, `size`
                                            FROM `film_frame` WHERE `filmId` = {$filmId} AND `id` = {$frameId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . Path::FILM_FRAME . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];

                $cast = [];
                $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                        FROM `film_frame_person` as `t1`
                                                        LEFT JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                        WHERE t1.`frameId` = {$row['id']} ORDER BY t1.`id`
                                                      ");
                while ($row2 = $result2->fetch_assoc()) {
                    $name = $row2['name_ru'];
                    if (empty($name)) {
                        $name = $row2['name_origin'];
                    }
                    $cast[] = [$row2['id'], $name];
                }

                $list['item'] = [
                    Frame::ID => $row['id'],
                    Frame::IMAGE => $image,
                    Frame::PREVIEW => '',
                    Frame::WIDTH => $row['width'],
                    Frame::HEIGHT => $row['height'],
                    Frame::SIZE => $row['size'],
                    Frame::TYPE => '',
                    Frame::CAST => $cast,
                ];
            }
        }

        $list['list'] = [];
        if (isset($list['item'])) {
            $result = $this->mysql()->query("SELECT `id` FROM `film_frame` WHERE `filmId` = {$frameId} AND `image` != '' ORDER BY `order` DESC");
            while ($row = $result->fetch_assoc()) {
                $list['list'][] = $row['id'];
            }
        }
        
        return $list;
    }
}
