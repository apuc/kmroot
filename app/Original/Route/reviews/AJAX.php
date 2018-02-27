<?php
namespace Original\Route_reviews;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;
use Kinomania\System\Options\Options;
use Kinomania\System\Debug\Debug;

class AJAX extends DefaultController
{
    public function get()
    {
        $list = [];
	    
        $get = new GetBag();
        $page = $get->fetchInt('page');
        if (1 < $page) {
            $key = 'reviews:list:';
            $redis = null;
            $redisStatus = false;

            if (5 > $page) {
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                $key .= $page;
            }

            if (5 > $page && $redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list = (new News())->getList('Рецензии', $page);
                if (5 > $page && !Wrap::$debugEnabled && [] != $list && $redisStatus) {
                    $redis->set($key, serialize($list), 660); // 11 min
                }
            }
        }
	    

        $this->setContent(json_encode($list));
    }
	
    
    
    public function getSeries()
    {
    	
	    $redis = new \Redis();
	    $redisStatus = $redis->connect('127.0.0.1');
	
	    $key = 'reviews:list:1';
	    if ($redisStatus && $redis->exists($key)) {
		    $list = unserialize($redis->get($key));
	    } else {
		    $list = (new News())->getList('Рецензии к сериалам', 1);
		
		    if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
			    $redis->set($key, serialize($list), 720); // 12 min
		    }
	    }
	    
	    $this->addData([
		    'list' => $list,
		    'options' => new Options()
	    ]);
	
	    $this->setTemplate('news/reviews/series.html.php');
    }
	
	public function getFilms()
	{
		
		$redis = new \Redis();
		$redisStatus = $redis->connect('127.0.0.1');
		
		$key = 'reviews:list:1';
		if ($redisStatus && $redis->exists($key)) {
			$list = unserialize($redis->get($key));
		} else {
			$list = (new News())->getList('Рецензии', 1);
			
			if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
				$redis->set($key, serialize($list), 720); // 12 min
			}
		}
		
		$this->addData([
			'list' => $list,
			'options' => new Options()
		]);
		
		$this->setTemplate('news/reviews/series.html.php');
	}
 
 
	
	public function getPageSeries()
	{
		
		$list = [];
		
		$get = new GetBag();
		$page = $get->fetchInt('page');
		if (1 < $page) {
			$key = 'reviews:list:';
			$redis = null;
			$redisStatus = false;
			
			if (5 > $page) {
				$redis = new \Redis();
				$redisStatus = $redis->connect('127.0.0.1');
				$key .= $page;
			}
			
			if (5 > $page && $redisStatus && $redis->exists($key)) {
				$list = unserialize($redis->get($key));
			} else {
				$list = (new News())->getList('Рецензии к сериалам', $page);
				if (5 > $page && !Wrap::$debugEnabled && [] != $list && $redisStatus) {
					$redis->set($key, serialize($list), 660); // 11 min
				}
			}
		}
		
		$this->setContent(json_encode($list));
	}
 
}