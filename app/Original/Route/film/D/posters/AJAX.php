<?php
namespace Original\Route_film_D_posters;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Logic\Film\Poster;
use Kinomania\Original\Controller\DefaultController;

class AJAX extends DefaultController
{
    public function getPhoto()
    {
        $numList = $this->getNumList();

        $list = [];

        $get = new GetBag();
        $page = $get->fetchInt('page');
        if (1 < $page) {
            $key = 'person:' . $numList[0] . ':photo:';
            $redis = null;
            $redisStatus = false;
            if (5 > $page) {
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                $key .= $page;
            }

            if (!Wrap::$debugEnabled && 5 > $page && $redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list = (new Poster())->get($numList[0], $page);

                if (5 > $page && [] != $list && !Wrap::$debugEnabled && $redisStatus) {
                    $redis->set($key, serialize($list), 540); // 9 min
                }
            }
        }

        $this->setContent(json_encode($list));
    }
}