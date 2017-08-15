<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;

/**
 * Class Reviews
 * @package Kinomania\Original\Users
 */
class Reviews
{
    use TRepository;
    use TDate;

    public function getList($userId, $page = 1)
    {
        $list = [];

        $userId = intval($userId);
        $page = intval($page);
        $offset = ($page - 1) * 12;

        $COUNTRY_RU = Country::RU;
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`text`, t1.`date`, t2.`s`, t2.`image`, t2.`country`, t2.`year`, t2.`name_origin`, t2.`name_ru`, t3.`comment` 
                                        FROM `film_review` AS `t1`
                                        JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                        LEFT JOIN `film_review_stat` as `t3` ON t1.`id` = t3.`reviewId`
                                        WHERE t1.`userId` = {$userId} ORDER BY t1.`id` DESC LIMIT {$offset}, 12");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['filmId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
            }

            $row['country'] = explode(',', $row['country']);
            $country = [];
            foreach ($row['country'] as $code) {
                if (isset($COUNTRY_RU[$code])) {
                    $country[] = $COUNTRY_RU[$code];
                }
            }
            $country = implode(', ', $country);
            if (!empty($country)) {
                $country .= ',';
            }

            $row['date'] = $this->formatDate($row['date'], true, ', ');
            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote>$2</blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);
            $list[] = [
                'id' => $row['id'],
                'filmId' => $row['filmId'],
                'text' => $row['text'],
                'image' => $image,
                'date' => $row['date'],
                'name_origin' => $row['name_origin'],
                'name_ru' => $row['name_ru'],
                'year' => $row['year'],
                'country' => $country,
                'comment' => $row['comment'],
            ];
        }

        return $list;
    }
}