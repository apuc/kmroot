<?php
namespace Original\Route_index_ssi_center;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Debug\Debug;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=300');
        
        $list = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`category`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM `news` as `t1` 
                                        LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                        WHERE t1.`status` = 'show' AND t1.`center` = 'yes' ORDER BY t1.`publish` DESC LIMIT 7");
        while ($row = $result->fetch_assoc()) {
            switch ($row['category']) {
                case 'Новости кино':
                    $row['category'] = 'news';
                    break;
                case 'Зарубежные сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Российские сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Арткиномания':
                    $row['category'] = 'news';
                    break;
                case 'Фестивали и премии':
                    $row['category'] = 'news';
                    break;
                default:
                    $row['category'] = 'article';
            }
            
            $row['publish'] = $this->formatDate($row['publish']);
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.750.371.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            $list[] = $row;
        }
        $this->addData([
            'list' => $list
        ]);
        $this->setTemplate('index/ssi/center.html.php');
    }
}