<?php
namespace Original\Route_film_D_awards;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Awards;

class GET extends FilmController
{
    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $key = 'film:' . $numList[0] . ':awards';
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $list = unserialize($this->redis->get($key));
            } else {
                $list = (new Awards())->get($numList[0]);

                if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                    $this->redis->set($key, serialize($list), 900); // 15 min
                }
            }

            if ([] != $list) {
                $this->addData([
                    'id' => $numList[0],
                    'list' => $list,
                    'min' => $this->getMin($numList[0]),
                    'stat' => $this->getStat($numList[0])
                ]);
                $this->setTemplate('film/awards/index.html.php');
            }
        }
    }
}