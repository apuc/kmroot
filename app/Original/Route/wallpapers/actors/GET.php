<?php
namespace Original\Route_wallpapers_actors;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Wallpaper\Actor;
use Kinomania\System\Data\Genre;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'wallpaper:actor';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Actor())->getList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }
        
        $key = 'popular:wallpaper_actor';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $popular = unserialize($redis->get($key));
        } else {
            $popular = (new Actor())->getPopular();

            if (!Wrap::$debugEnabled && [] != $popular && $redisStatus) {
                $redis->set($key, serialize($popular), 900); // 15 min
            }
        }

        $this->addData([
            'list' => $list,
            'popular' => $popular,
            'genre' => Genre::RU,
        ]);

        $this->setTemplate('wallpaper/actor.html.php');
    }
}