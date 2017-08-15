<?php
namespace Original\Route_rss_news_films_xml;

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

        $chanel->addChild('title', 'Новости кино');
        $chanel->addChild('link', 'http://www.kinomania.ru/');
        $chanel->addChild('description', 'http://www.kinomania.ru/');

        $image = $chanel->addChild('image');
        $image->addChild('url', 'http://www.kinomania.ru/app/img/logo-rss.gif');
        $image->addChild('title', 'Новости кино');
        $image->addChild('link', 'http://www.kinomania.ru/');

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons` FROM `news` as `t1` 
                                        WHERE t1.`status` = 'show' AND `category` = 'Новости кино' ORDER BY t1.`publish` DESC LIMIT 24");
        while ($row = $result->fetch_assoc()) {
            $item = $chanel->addChild('item');
            $item->addChild('title', $row['title']);
            $item->addChild('link', 'http://www.kinomania.ru/news/' . $row['id']);
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];

                $image = $item->addChild('enclosure');
                $image->addAttribute('url', $row['image']);
                $image->addAttribute('type', 'image/jpeg');
            }
            $item->addChild('description', '<![CDATA[' . htmlspecialchars(html_entity_decode($row['anons'])) . ']]>');
            $item->addChild('pubDate', date("Y-d-m G-i-s", strtotime($row['publish'])));
        }

        $response = new Response();
        $response->header('Content-type', 'application/xml; charset=utf-8');
        $xml = $xml->asXML();
        $response->setContent($xml);
        $this->setResponse($response);
    }
}