<?php
namespace Original\Route_film_D_trailers;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Trailers;
use Kinomania\System\Data\Player;

class GET extends FilmController
{
    public function index()
    {
        $player = new Player();
    	$numList = $this->getNumList();
		
        if (0 < $numList[0]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $key = 'film:' . $numList[0] . ':trailers';
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $list = unserialize($this->redis->get($key));
            } else {
                $list = (new Trailers())->get($numList[0]);

                if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                    $this->redis->set($key, serialize($list), 900); // 15 min
                }
            }

            if ([] != $list) {
                $this->addData([
                    'id' => $numList[0],
                    'list' => $list,
                    'min' => $this->getMin($numList[0]),
                    'stat' => $this->getStat($numList[0]),
	                'player' => $player->selectPlayer(),
                ]);
                $this->setTemplate('film/trailer/index.html.php');
            }
        }
    }
}