<?php
namespace Original\Route_list_year_D;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Film\Year;

class AJAX extends DefaultController
{
    public function getMore()
    {
        $list = [];
        $numList = $this->getNumList();

        $get = new GetBag();
        $page = $get->fetchInt('page');
        if (1 < $page) {
            $key = 'year:' . $numList[0] . ':' . $page;
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
                $list = (new Year())->getList($numList[0], $page);

                if (5 > $page && !Wrap::$debugEnabled && [] != $list && $redisStatus) {
                    $redis->set($key, serialize($list), 360); // 6 min
                }
            }
        }

        $this->setContent(json_encode($list));
    }
}