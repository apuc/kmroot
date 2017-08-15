<?php
namespace Original\Route_people_D_photos_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Logic\Person\Photos;

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

                $key = 'person:' . $numList[0] . ':photo:item:' . $numList[1];
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    $list = (new Photos())->getById($numList[0], $numList[1]);

                    if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 300); // 5 min
                    }
                }

                if (isset($list['item'])) {
                    $this->addData([
                        'id' => $numList[0],
                        'photoId' => $numList[1],
                        'stat' => $this->getStat($numList[0]),
                        'min' => $min,
                        'photo' => $list
                    ]);
                    $this->setTemplate('person/photo.item.html.php');
                }
            }
        }
    }
}