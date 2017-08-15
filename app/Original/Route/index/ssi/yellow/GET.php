<?php
namespace Original\Route_index_ssi_yellow;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $box = '';
        $review = '';
        $wait = '';
        $be = '';

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Бокс-офис'
                                         ORDER BY `publish` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.172.172.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            if (!empty($row['title_short'])) {
                $row['title'] = $row['title_short'];
            }
            $box = $row;
        }

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Рецензии'
                                         ORDER BY `publish` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.172.172.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            if (!empty($row['title_short'])) {
                $row['title'] = $row['title_short'];
            }
            $review = $row;
        }

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Ожидания'
                                         ORDER BY `publish` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.172.172.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            if (!empty($row['title_short'])) {
                $row['title'] = $row['title_short'];
            }
            $wait = $row;
        }

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Был бы повод'
                                         ORDER BY `publish` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.172.172.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            if (!empty($row['title_short'])) {
                $row['title'] = $row['title_short'];
            }
            $be = $row;
        }

        $this->addData([
            'box' => $box,
            'review' => $review,
            'wait' => $wait,
            'be' => $be
        ]);
        $this->setTemplate('index/ssi/yellow.html.php');
    }
}