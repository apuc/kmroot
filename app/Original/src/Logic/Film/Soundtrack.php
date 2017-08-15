<?php
namespace Kinomania\Original\Logic\Film;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Soundtrack
 * @package Kinomania\Original\Film
 */
class Soundtrack
{
    use TRepository;
    use TDate;
    
    public function get($filmId)
    {
        $list = [];

        $filmId = intval($filmId);

        if (!Wrap::$debugEnabled) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`path`,
                                            t1.`year`
                                            FROM `film_sound_dir` AS `t1`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            WHERE t1.`filmId` = {$filmId} AND t1.`status` = 'show' ORDER BY t1.`id` DESC 
                                        ");
        } else {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`path`,
                                            t1.`year`
                                            FROM `film_sound_dir` AS `t1`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            WHERE t1.`filmId` = {$filmId} ORDER BY t1.`id` DESC 
                                        ");

        }
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_SOUNDTRACK . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.277.275.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $soundList = [];
            $result2 = $this->mysql()->query("SELECT `id`, `m`, `author`, `name`, `time`, `order` FROM `film_sound_track` WHERE `dirId` = {$row['id']} ORDER BY `order`");
            while ($row2 = $result2->fetch_assoc()) {
                if (empty($row['path'])) {
                    $iName = md5($row2['id']);
                    $path = Server::MEDIA[$row2['m']] . Path::FILM_SOUNDTRACK_MEDIA . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.mp3';
                } else {
                    $path = '//fs.kinomania.ru/soundtracks' . $row['path'] . '/' . $row2['order'] . '.mp3';
                }
                $soundList[] = [
                    \Kinomania\Original\Key\Film\Soundtrack::AUTHOR => $row2['author'],
                    \Kinomania\Original\Key\Film\Soundtrack::NAME => $row2['name'],
                    \Kinomania\Original\Key\Film\Soundtrack::TIME => $row2['time'],
                    \Kinomania\Original\Key\Film\Soundtrack::SOUND => $path,
                ];
            }

            $list[] = [
                \Kinomania\Original\Key\Film\Soundtrack::ID => $row['id'],
                \Kinomania\Original\Key\Film\Soundtrack::IMAGE => $image,
                \Kinomania\Original\Key\Film\Soundtrack::YEAR => $row['year'],
                \Kinomania\Original\Key\Film\Soundtrack::LIST => $soundList,
            ];
        }
        
        return $list;
    }
    
    public function popular()
    {
        $popular = [];
        
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`
                                            FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_sound_dir` WHERE `status` = 'show' AND `popular` = 'yes' GROUP BY `filmId` ORDER BY `id` DESC) AS `t` 
                                            JOIN `film_sound_dir` AS `t1` ON t.`id` = t1.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` 
                                            WHERE t3.`status` = 'show'  
                                            ORDER BY t1.`id` DESC LIMIT 12
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_SOUNDTRACK . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.205.205.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $popular[] = [
                \Kinomania\Original\Key\Film\Soundtrack::ID => $row['id'],
                \Kinomania\Original\Key\Film\Soundtrack::IMAGE => $image,
                \Kinomania\Original\Key\Film\Soundtrack::YEAR => '',
                \Kinomania\Original\Key\Film\Soundtrack::LIST => [],
                \Kinomania\Original\Key\Film\Soundtrack::FILM_ID => $row['filmId'],
                \Kinomania\Original\Key\Film\Soundtrack::FILM_NAME => $name,
                \Kinomania\Original\Key\Film\Soundtrack::FILM_NAME_EN => $row['name_origin'],
            ];
        }
        
        return $popular;
    }
}
