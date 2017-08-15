<?php
namespace Original\Route_top_films;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;

class AJAX extends DefaultController
{
    use TRepository;
    use TDate;

    public function search()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        $genre = $filter['genre'];
        $temp = Genre::RU;
        if (!isset($temp[$genre])) {
            $genre = '';
        }

        $country = $filter['country'];
        $temp = Country::RU;
        if (!isset($temp[$country])) {
            $country = '';
        }
        $year = intval($filter['year']);
        if (1900 > $year || 2010 < $year) {
            $year = 0;
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'top:films';
        if (false && !Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $query = "SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
                                            FROM `film` as `t1`
                                            JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId` 
                                            ";
            if ('' != $genre) {
                $query .= " JOIN `film_genre` as `t3` ON t1.`id` = t3.`filmId` ";
            }
            if ('' != $country) {
                $query .= " JOIN `film_country` as `t4` ON t1.`id` = t4.`filmId` ";
            }
            $query .= "WHERE t1.`status` = 'show' ";


            if (0 < $year) {
                $year_b = $year + 10;
                $query .= " AND t1.`year` >= {$year} AND t1.`year` < {$year_b}";
            }

            if ('' != $country) {
                $query .= " AND t4.`country` = '{$country}' ";
            }

            if ('' != $genre) {
                $query .= " AND t3.`genre` = '{$genre}' ";
            }

            $query .= " AND t2.`rate_count` > 10 ORDER BY t2.`rate` DESC LIMIT 100 ";

            $result = $this->mysql()->query($query);
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
            if (false && !Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $this->setContent(json_encode($list));
    }
}