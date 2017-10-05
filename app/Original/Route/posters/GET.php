<?php
namespace Original\Route_posters;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Poster\Poster;
use Kinomania\System\Data\Genre;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'poster';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Poster())->getList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $key = 'popular:poster';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $popular = unserialize($redis->get($key));
        } else {
            $popular = (new Poster())->getPopular();

            if (!Wrap::$debugEnabled && [] != $popular && $redisStatus) {
                $redis->set($key, serialize($popular), 900); // 15 min
            }
        }

        $this->addData([
            'list' => $list,
            'popular' => $popular,
            'genre' => Genre::RU,
			'options' => new Options()
        ]);

        $this->setTemplate('poster/index.html.php');
    }
}