<?php
namespace Original\Route_top_films;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $list = [];

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'top:films';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
                                            FROM `film` as `t1`
                                            JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId` 
                                            WHERE t1.`status` = 'show' AND t2.`rate_count` > 10 ORDER BY t2.`rate` DESC LIMIT 100
                                            ");
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $this->addData([
            'list' => $list,
            'genre' => Genre::RU,
            'country' => Country::RU,
            'options' => new Options()
        ]);

        $this->setTemplate('top/films.html.php');
    }
}