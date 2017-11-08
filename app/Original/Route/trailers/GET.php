<?php
namespace Original\Route_trailers;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Trailer\Trailer;
use Kinomania\System\Data\Genre;
use Kinomania\System\Data\Player;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        $player = new Player();

        $key = 'trailer';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Trailer())->getList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $this->addData([
            'list' => $list,
            'genre' => Genre::RU,
            'yearFrom' => 1888,
			'options' => new Options(),
	        'player' => $player->selectPlayer(),
        ]);

        $this->setTemplate('trailer/index.html.php');
    }
}