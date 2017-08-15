<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Comments
 * @package Kinomania\Original\Users
 */
class Comments
{
    use TRepository;
    use TDate;

    public function getList($userId, $page = 1)
    {
        $list = [];

        $userId = intval($userId);
        $page = intval($page);
        $offset = ($page - 1) * 12;
        
        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`relatedId`, t1.`type`, t1.`text`, t1.`date` 
                                        FROM (SELECT `id` FROM `comment` WHERE `userId` = {$userId} ORDER BY `date` DESC LIMIT {$offset}, 12) as `t`
                                        JOIN `comment` AS `t1` ON t1.`id` = t.`id` 
                                        ORDER BY t1.`date` DESC LIMIT 12");
        while ($row = $result->fetch_assoc()) {
            $type = '';
            $image = '';
            $link = '';
            $title = '';

            switch ($row['type']) {
                case 'news':
                    $type = 'новости';

                    $result2 = $this->mysql()->query("SELECT `s`, `image`, `category`, `title` FROM `news` WHERE `id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nni.jpg';
                        }

                        switch ($row2['category']) {
                            case 'Новости кино':
                                $link = '/news/';
                                break;
                            case 'Зарубежные сериалы':
                                $link = '/news/';
                                break;
                            case 'Российские сериалы':
                                $link = '/news/';
                                break;
                            case 'Арткиномания':
                                $link = '/news/';
                                break;
                            case 'Фестивали и премии':
                                $link = '/news/';
                                break;
                            default:
                                $type = 'статье';
                                $link = '/article/';
                        }

                        $title = $row2['title'];
                    }

                    $link .= $row['relatedId'];

                    break;
                case 'film':
                    $type = 'фильму';

                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru` FROM
                                                                      `film_review` as `t2`  
                                                                      JOIN `film` as `t1` ON t1.`id` = t2.`filmId`
                                                                      WHERE t2.`id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }

                        $link = '/film/' . $row2['id'];
                    }
                    break;
                case 'trailer':
                    $type = 'трейлеру';

                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru` 
                                                                  FROM `film` as `t1`
                                                                  JOIN `trailer` as `t2` ON t1.`id` = t2.`filmId` 
                                                                  WHERE t2.`id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row2['id']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }
                        $link = '/film/' . $row2['id'] . '/trailers/';

                    }

                    $link .= $row['relatedId'];

                    break;
                case 'person':
                    $type = 'персоне';

                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru` FROM
                                                                      `person_review` as `t2`  
                                                                      JOIN `person` as `t1` ON t1.`id` = t2.`personId`
                                                                      WHERE t2.`id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nop.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }

                        $link = '/people/' . $row2['id'];
                    }
                    break;
            }


            $row['type'] = $type;
            $row['image'] = $image;
            $row['link'] = $link;
            $row['title'] = $title;

            $row['date'] = $this->formatDate($row['date'], true, ', ');
            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote>$2</blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);
            $row['text'] = str_replace('&amp;quot;', '"', $row['text']);
            $row['text'] = str_replace('&amp;laquo;', '«', $row['text']);
            $row['text'] = str_replace('&amp;hellip;', '…', $row['text']);
            $row['text'] = str_replace('&amp;raquo;', '»', $row['text']);
            $list[] = $row;
        }

        return $list;
    }
}