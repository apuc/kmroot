<?php
namespace Original\Route_genres_films;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Options\Options;
use Kinomania\System\Buttons;
use Kinomania\System\Pagination;

class GET extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
	{
		$list = [];

		$redis = New \Redis();
		$redisStatus = $redis->connect('127.0.0.1');
		$genre = (isset($_GET['genre'])) ? $_GET['genre'] : 0;
        $key = $genre.':0:0:list:1';


		if(!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
			$list = unserialize($redis->get($key));
			$count['count'] = $redis->get($key.':count');
		}else {
		    $query = "SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
										FROM `film` as `t1`
										JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId`
										WHERE t1.`status` = 'show' ";
		    if($genre){
		        $query .= "AND t1.`genre` LIKE '%".$genre."%' ";
            }

            $count = $this->mysql()
                ->query("SELECT COUNT(*) as count ". substr($query, strrpos($query, 'FROM')) )
                ->fetch_assoc();

            $query .= "ORDER BY t2.`rate_count` DESC LIMIT 20";

			$result = $this->mysql()->query($query);

			while($row = $result->fetch_assoc()) {
				$list[] = $row;
			}

			if(!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key.':count', $count['count'], 300);
				$redis->set($key,serialize($list),300); // 5 min
			}
		}


		$this->addData([
			'list' => $list,
			'genre' => Genre::RU,
			'country' => Country::RU,
			'options' => new Options(),
            'genreSelected' => (isset($_GET['genre'])) ? $_GET['genre'] : '',
            'count' => $count['count'],
		]);
	
		$this->setTemplate('genres/films.html.php');
	}

}