<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Stars
 * @package Kinomania\Original\Users
 */
class Stars
{
    use TRepository;
    use TDate;

    public function getList($userId, $page = 1)
    {
        $list = [];

        $userId = intval($userId);
        $page = intval($page);
        $offset = ($page - 1) * 12;

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`personId`, t1.`text`, t1.`date`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t3.`comment` 
                                        FROM `person_review` AS `t1`
                                        JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                        LEFT JOIN `person_review_stat` as `t3` ON t1.`id` = t3.`reviewId`
                                        WHERE t1.`userId` = {$userId} ORDER BY t1.`id` DESC LIMIT {$offset}, 12");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['personId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
            }

            $row['date'] = $this->formatDate($row['date'], true, ', ');
            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote>$2</blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);
            $list[] = [
                'id' => $row['id'],
                'personId' => $row['personId'],
                'text' => $row['text'],
                'image' => $image,
                'date' => $row['date'],
                'name_origin' => $row['name_origin'],
                'name_ru' => $row['name_ru'],
                'comment' => $row['comment'],
            ];
        }


        return $list;
    }
}