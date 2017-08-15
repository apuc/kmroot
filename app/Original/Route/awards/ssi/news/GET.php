<?php
namespace Original\Route_awards_ssi_news;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class GET
 * @package Original\Route_awards_ssi_news
 */
class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=600');
        
        $list = [];
        $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `title`, `title_short`, `anons` 
                                         FROM `news` 
                                         WHERE `status` = 'show' AND `category` = 'Фестивали и премии'
                                         ORDER BY `publish` DESC LIMIT 4");
        $cnt = 0;
        while ($row = $result->fetch_assoc()) {
            $cnt++;
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
        
        $this->setTemplate('awards/ssi/news.html.php');
    }
}