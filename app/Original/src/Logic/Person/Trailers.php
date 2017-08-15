<?php
namespace Kinomania\Original\Logic\Person;

use Kinomania\Original\Key\Person\Trailer;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Trailers
 * @package Kinomania\Original\Person
 */
class Trailers
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @return array
     */
    public function get($personId)
    {
        $list = [];

        $personId = intval($personId);

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t3.`name_origin`, t3.`name_ru`, t4.`comment`
                                            FROM `trailer_person` as `t` 
                                            JOIN `trailer` AS `t1` ON t.`trailerId` = t1.`id`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t.`personId` = {$personId} AND t1.`status` = 'show' ORDER BY t1.`id` DESC
                                        ");
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
}