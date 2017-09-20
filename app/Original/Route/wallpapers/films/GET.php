<?php
namespace Original\Route_wallpapers_films;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Wallpaper\Film;
use Kinomania\System\Data\Genre;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'wallpaper:film';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Film())->getList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }
        
        $key = 'popular:wallpaper_film';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $popular = unserialize($redis->get($key));
        } else {
            $popular = (new Film())->getPopular();

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

        $this->setTemplate('wallpaper/film.html.php');
    }
}