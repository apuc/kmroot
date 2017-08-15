<?php
namespace Original\Route_soundtracks;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Soundtrack\Soundtrack;
use Kinomania\System\Data\Genre;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'soundtrack';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Soundtrack())->getList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }
        
        $key = 'popular:soundtrack';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $popular = unserialize($redis->get($key));
        } else {
            $popular = (new Soundtrack())->getPopular();

            if (!Wrap::$debugEnabled && [] != $popular && $redisStatus) {
                $redis->set($key, serialize($popular), 900); // 15 min
            }
        }

        $this->addData([
            'list' => $list,
            'popular' => $popular,
            'genre' => Genre::RU,
        ]);

        $this->setTemplate('soundtrack/index.html.php');
    }
}