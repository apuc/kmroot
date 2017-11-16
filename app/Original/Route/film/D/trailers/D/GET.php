<?php
namespace Original\Route_film_D_trailers_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Trailers;
use Kinomania\System\Data\Player;

class GET extends FilmController
{
    public function index()
    {
        $numList = $this->getNumList();
        $player = new Player();

        if (0 < $numList[0] && 0 < $numList[1]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $key = 'film:' . $numList[0] . ':trailers:' . $numList[1];
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $list = unserialize($this->redis->get($key));
            } else {
                $list = (new Trailers())->getById($numList[0], $numList[1]);

                if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                    $this->redis->set($key, serialize($list), 120); // 2 min
                }
            }

            if ([] != $list) {
                $this->addData([
                    'id' => $numList[0],
                    'trailerId' => $numList[1],
                    'list' => $list,
                    'min' => $this->getMin($numList[0]),
                    'stat' => $this->getStat($numList[0]),
	                'player' => $player->selectPlayer(),
                ]);
                $this->setTemplate('film/trailer/item.html.php');
            }
        }
    }
}