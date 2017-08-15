<?php
namespace Original\Route_film_D_reviews;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Reviews;

class GET extends FilmController
{
    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $min = $this->getMin($numList[0]);
            if ([] != $min) {
                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'film:' . $numList[0] . ':reviews';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $item = unserialize($this->redis->get($key));
                } else {
                    $item = (new Reviews())->getList($numList[0]);

                    if (!Wrap::$debugEnabled && [] != $item['list'] && $this->redisStatus) {
                        $this->redis->set($key, serialize($item), 600); // 10 min
                    }
                }

                $this->addData([
                    'id' => $numList[0],
                    'item' => $item,
                    'min' => $min,
                    'stat' => $this->getStat($numList[0])
                ]);
                $this->setTemplate('film/reviews/index.html.php');
            }
        }
    }
}