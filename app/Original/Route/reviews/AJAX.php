<?php
namespace Original\Route_reviews;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;

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
}