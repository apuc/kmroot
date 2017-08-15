<?php
namespace Original\Route_index_ssi_poster;

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
        header('Cache-Control: public, max-age=1200');
        
        $list = [];
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t3.`name_origin`, t3.`name_ru`, t4.`poster`
                                            FROM `film_poster` AS `t1` 
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` 
                                            LEFT JOIN `film_stat` as `t4` ON t1.`filmId` = t4.`filmId`
                                            WHERE t1.`popular` = 'yes' ORDER BY t1.`id` DESC LIMIT 1
                                        ");
        if ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.268.397.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }
            $list = [
                'id' => $row['id'],
                'filmId' => $row['filmId'],
                'image' => $image,
            ];
        }
        $this->addData([
            'list' => $list
        ]);
        $this->setTemplate('index/ssi/poster.html.php');
    }
}