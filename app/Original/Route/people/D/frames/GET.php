<?php
namespace Original\Route_people_D_frames;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Logic\Person\Frames;

class GET extends PersonController
{

    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $min = $this->getMin($numList[0]);

            if ([] != $min) {
         
                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'person:' . $numList[0] . ':frames';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    $list = (new Frames())->get($numList[0]);

                    if (!Wrap::$debugEnabled && [] != $list['list'] && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 1200); // 20 min
                    }
                }

                if ([] != $list['list']) {
                    $this->addData([
                        'id' => $numList[0],
                        'stat' => $this->getStat($numList[0]),
                        'min' => $min,
                        'list' => $list
                    ]);
                    $this->setTemplate('person/frame/index.html.php');
                }
            }
        }
    }
}