<?php
namespace Original\Route_people_D_reviews_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Logic\Person\Reviews;

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

                $item = ['list' => [], 'count' => 0];
                $key = 'person:' . $numList[0] . ':reviews:' . $numList[1];
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $item = unserialize($this->redis->get($key));
                } else {
                    $result = $this->mysql()->query("SELECT 1 FROM `person_review` WHERE `id` = {$numList[1]} LIMIT 1");
                    if (0 < $result->num_rows) {
                        $item = (new Reviews())->commentList($numList[1]);

                        if (!Wrap::$debugEnabled && [] != $item['list'] && $this->redisStatus) {
                            $this->redis->set($key, serialize($item), 120); // 2 min
                        }
                    }
                }
                
                $this->addData([
                    'id' => $numList[0],
                    'reviewId' => $numList[1],
                    'stat' => $this->getStat($numList[0]),
                    'min' => $min,
                    'item' => $item
                ]);
                $this->setTemplate('person/review/item.html.php');
            }
        }
    }
}