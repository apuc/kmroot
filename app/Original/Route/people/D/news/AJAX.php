<?php
namespace Original\Route_people_D_news;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Person\News;

class AJAX extends DefaultController
{
    public function get()
    {
        $list = [];
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $get = new GetBag();
            $page = $get->fetchInt('page');
            if (1 < $page) {
                $key = 'person:' . $numList[0] . ':news:' . $page;
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
                    $list = (new News())->get($numList[0], $page);

                    if (5 > $page && !Wrap::$debugEnabled && $redisStatus) {
                        $redis->set($key, serialize($list), 540); // 9 min
                    }
                }
            }
        }

        $this->setContent(json_encode($list));
    }
}