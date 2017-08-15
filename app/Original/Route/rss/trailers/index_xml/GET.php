<?php
namespace Original\Route_rss_trailers_index_xml;

use Dspbee\Core\Response;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $xml = new \SimpleXMLElement('<xml/>');

        $rss = $xml->addChild('rss');
        $rss->addAttribute('version', '2.0');
        $chanel = $rss->addChild('chanel');

        $chanel->addChild('title', 'Последние трейлеры');
        $chanel->addChild('link', 'http://www.kinomania.ru/');
        $chanel->addChild('description', 'http://www.kinomania.ru/ - все о кино');

        $image = $chanel->addChild('image');
        $image->addChild('url', 'http://www.kinomania.ru/app/img/logo-rss.gif');
        $image->addChild('title', 'Последние трейлеры');
        $image->addChild('link', 'http://www.kinomania.ru/');

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`, t2.`name`, t3.`name_origin`, t3.`name_ru`
                                            FROM `trailer` AS `t1`
                                            JOIN (SELECT ANY_VALUE(`id`) AS `id` FROM `trailer` WHERE `status` = 'show' AND `type` IN (
                                            1, 2, 3, 4, 6, 7, 8, 10, 11, 15, 16, 31, 33, 34, 37, 38, 39, 40, 41, 42, 44, 45, 46, 66, 67, 68, 70, 75, 77, 88, 99, 101, 102, 103, 104, 109, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 141, 142, 143, 144
                                            ) GROUP BY `filmId` ORDER BY `id` DESC LIMIT 50) AS `t` ON t1.`id` = t.`id`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            JOIN `film` AS `t3` ON t1.`filmId` = t3.`id`
                                            WHERE t3.`status` = 'show'
                                            LIMIT 50
                                        ");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            $item = $chanel->addChild('item');
            $item->addChild('title', $row['name'] . ' ' . $name);
            $item->addChild('link', 'http://www.kinomania.ru/film/' . $row['filmId'] . '/trailers/' . $row['id']);
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM_TRAILER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];

                $image = $item->addChild('enclosure');
                $image->addAttribute('url', $row['image']);
                $image->addAttribute('type', 'image/jpeg');
            }
            $item->addChild('description', '<![CDATA[]]>');
            $item->addChild('pubDate', date("Y-d-m G-i-s", strtotime($row['date'])));
        }

        $response = new Response();
        $response->header('Content-type', 'application/xml; charset=utf-8');
        $xml = $xml->asXML();
        $response->setContent($xml);
        $this->setResponse($response);
    }
}