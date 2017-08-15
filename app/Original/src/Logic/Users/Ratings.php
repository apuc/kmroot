<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Ratings
 * @package Kinomania\Original\Users
 */
class Ratings
{
    use TRepository;
    use TDate;

    public function getList($userId, $page = 1)
    {
        $list = [];

        $userId = intval($userId);
        $page = intval($page);
        $offset = ($page - 1) * 12;

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`date`, t3.`rate` as `average`, t3.`rate_count`
                                                 FROM (SELECT `id` FROM `user_film_vote` WHERE `userId` = {$userId} ORDER BY `id` DESC) as `t` 
                                                 JOIN `user_film_vote` as `t2` ON t2.`id` = t.`id` 
                                                 JOIN `film` as `t1` ON t1.`id` = t2.`filmId` 
                                                 LEFT JOIN `film_stat` as `t3` ON t1.`id` = t3.`filmId`
                                                 ORDER BY t2.`id` DESC LIMIT {$offset}, 12");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
            }

            $date = $this->formatDate($row['date'], true, ', &nbsp;');

            if (1 < $page) {
                $list[] = [$row['id'], Server::STATIC[$row['s']], $row['image'], $row['name_origin'], $row['name_ru'], $row['rate'], $date, $row['average'], $row['rate_count']];
            } else {
                $list[] = [$row['id'], $image, $row['name_origin'], $row['name_ru'], $row['rate'], $date, $row['average'], $row['rate_count']];
            }
        }

        return $list;
    }
}