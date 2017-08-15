<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Script
 * @package Kinomania\Original\Film
 */
class Script
{
    use TRepository;
    use TDate;
    
    public function get($filmId, $scriptId)
    {
        $list = [];

        $filmId = intval($filmId);
        $scriptId = intval($scriptId);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `file`, `text`
                                            FROM `film_script` WHERE `filmId` = {$filmId} AND `id` = {$scriptId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $list['item'] = [
                'id' => $row['id'],
                'file' => $row['file'],
                'text' => $row['text'],
            ];
        }

        $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `year`, `preview` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($filmId);
                $image_org = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                $image_min = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.306.443.' . $row['image'];
            } else {
                $image_org = '';
                $image_min = Server::STATIC[0] . '/app/img/content/np_nopic_film.jpg';
            }

            /**
             * Director.
             */
            $director = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` 
                                         JOIN `film_crew` as `t1` ON t.`id` = t1.`id`
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t1.`type` = 'Режиссер' AND t2.`status` = 'show'");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $director[$row2['id']] = $name;
            }

            /**
             * Script.
             */
            $script = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` 
                                         JOIN `film_crew` as `t1` ON t.`id` = t1.`id`
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t1.`type` = 'Сценарист' AND t2.`status` = 'show'");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $script[$row2['id']] = $name;
            }

            $list['film'] = [
                'id' => $row['id'],
                'image_org' => $image_org,
                'image_min' => $image_min,
                'year' => $row['year'],
                'preview' => $row['preview'],
                'director' => $director,
                'script' => $script,
            ];
        }
        
        return $list;
    }
}
