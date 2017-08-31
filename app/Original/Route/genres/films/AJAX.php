<?php
namespace Original\Route_genres_films;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Debug\Debug;

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

    public function get()
    {
        $list =[];
        $redis = New \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        $country = ('0' != $_POST['country']) ? $_POST['country'] : 0;
        $genre = ('0' != $_POST['genre']) ? $_POST['genre'] : 0;
        $year = ('0' != $_POST['years']) ? $_POST['years'] : 0;
        $page = ($_POST['page']) ? $_POST['page'] : 1;
        $offset = $page * 20 - 20;
        $key = "$genre:$country:$year:list:$page";

        if($redisStatus && $redis->exists($key)){
            $list = unserialize($redis->get($key));
            $count['count'] = $redis->get($key.':count');
        }else{
            $query =  "SELECT film.`id`, film.`name_ru`, film.`name_origin`, t2.`rate`, t2.`rate_count` FROM `film`
                        JOIN `film_stat` as `t2` ON film.`id` = t2.`filmId`
                        WHERE `status` = 'show' ";

            if($country) $query .= "AND `country` LIKE '%$country%' ";
            if($genre) $query .= "AND `genre` LIKE '%$genre%' ";
            if($year) $query .= "AND `year` BETWEEN $year AND $year + 10 ";

            $count = $this->mysql()
                ->query("SELECT COUNT(*) as count ". substr($query, strrpos($query, 'FROM')) )
                ->fetch_assoc();

            $query .= "ORDER BY t2.`rate_count` DESC ";
            $query .= "LIMIT 20 OFFSET $offset ";

            $result = $this->mysql()->query($query);

            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }

            if([] != $list && $redisStatus) {
                $redis->set($key.':count', $count['count'], 300);
                $redis->set($key,serialize($list),300); // 5 min
            }
        }

        $this->addData(['list' => $list,
            'itemCount' => $count['count'],
            'page' => $page,
            'offset' => $offset,
        ]);

        $this->setTemplate('genres/ajax.html.php');
        //Debug::prn($list);
        //var_dump($_POST);
    }
}