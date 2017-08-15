<?php
namespace Original\Route_art_ssi_yellow;

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

        $review = '';
        $interview = '';
        $movie_memorial = '';
        $shorts = '';

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Рецензии' AND t3.`status` = 'show' AND t3.`arthouse` = 'yes'
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
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Интервью'
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
            $interview = $row;
        }

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'BOOM'
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
            $movie_memorial = $row;
        }

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Short'
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
            $shorts = $row;
        }

        $this->addData([
            'review' => $review,
            'interview' => $interview,
            'movie_memorial' => $movie_memorial,
            'shorts' => $shorts
        ]);

        $this->setTemplate('art/ssi/yellow.html.php');
    }
}