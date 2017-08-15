<?php
namespace Kinomania\Original\Logic\Person;

use Kinomania\Original\Key\Person\Frame;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Frames
 * @package Kinomania\Original\Person
 */
class Frames
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @return array
     */
    public function get($personId)
    {
        $list = ['list' => []];
        $personId = intval($personId);

        $list['photo_session'] = false;
        $list['film_set'] = false;
        $list['concept'] = false;
        $list['screenshot'] = false;

        $result = $this->mysql()->query("SELECT 
                                            t1.`id`, t1.`s`, t1.`image`, t1.`width`, t1.`height`, t1.`size`, t1.`photo_session`, t1.`film_set`, t1.`concept`, t1.`screenshot`
                                            FROM `film_frame_person` as `t` JOIN `film_frame` as `t1` ON t.`frameId` = t1.`id` 
                                            WHERE t.`personId` = {$personId} ORDER BY `order` DESC");
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
                                                        FROM `film_frame` as `t1`
                                                        LEFT JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                                        WHERE t1.`id` = {$row['id']} LIMIT 1
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

            $item = [
                Frame::ID => $row['id'],
                Frame::IMAGE => $image,
                Frame::PREVIEW => $preview,
                Frame::WIDTH => $row['width'],
                Frame::HEIGHT => $row['height'],
                Frame::SIZE => $row['size'],
                Frame::TYPE => $type,
                Frame::CAST => $cast,
            ];

            $list['list'][] = $item;
        }

        return $list;
    }
}