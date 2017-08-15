<?php
namespace Original\Route_film_D_frames_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Frames;

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

                if (0 < $numList[1]) {
                    $key = 'film:' . $numList[0] . ':frame:item:' . $numList[1];
                    if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                        $list = unserialize($this->redis->get($key));
                    } else {
                        $list = (new Frames())->getById($numList[0], $numList[1]);

                        if (!Wrap::$debugEnabled && isset($list['item']) && $this->redisStatus) {
                            $this->redis->set($key, serialize($list), 300); // 5 min
                        }
                    }

                    if (isset($list['item'])) {
                        $this->addData([
                            'id' => $numList[0],
                            'frameId' => $numList[1],
                            'min' => $min,
                            'list' => $list,
                            'stat' => $this->getStat($numList[0])
                        ]);
                        $this->setTemplate('film/frame/item.html.php');
                    }
                }
            }
        }
    }
}