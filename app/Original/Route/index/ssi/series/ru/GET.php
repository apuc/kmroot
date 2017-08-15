<?php
namespace Original\Route_index_ssi_series_ru;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $list = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` 
                                         FROM `news` as `t1` 
                                         LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId`
                                         WHERE t1.`status` = 'show' AND t1.`category` = 'Российские сериалы'
                                         ORDER BY `publish` DESC LIMIT 4");
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $cnt++;
            $row['publish'] = $this->formatDate($row['publish']);
            if (2 == $cnt || 3 == $cnt) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.289.210.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
                }
            } else {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.445.210.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
                }
            }
            $list[] = $row;
        }
        $this->addData([
            'list' => $list
        ]);
        $this->setTemplate('index/ssi/series.ru.html.php');
    }
}