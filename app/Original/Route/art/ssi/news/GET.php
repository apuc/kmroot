<?php
namespace Original\Route_art_ssi_news;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class GET
 * @package Original\Route_art_ssi_news
 */
class GET extends DefaultController
{
    use TDate;
    use TRepository;
    
    public function index()
    {
        header('Cache-Control: public, max-age=720');
        
        $list = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM `news` as `t1` 
                                        LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                        WHERE t1.`status` = 'show' AND t1.`center` = 'no' AND `category` = 'Арткиномания' ORDER BY t1.`publish` DESC LIMIT 4");
        $active = true;
        while ($row = $result->fetch_assoc()) {
            $row['active'] = $active;
            $active = false;
            $row['publish'] = $this->formatDate($row['publish']);
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.360.272.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            $list[] = $row;
        }
        
        $this->addData([
            'list' => $list
        ]);
        
        $this->setTemplate('art/ssi/news.html.php');
    }
}