<?php
namespace Original\Route_film_D_reviews;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Reviews;

class AJAX extends FilmController
{
    /**
     * Film review.
     */
    public function getReview()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $key = 'film:' . $numList[0] . ':review';
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list = (new Reviews())->getMain($numList[0]);

                if (!Wrap::$debugEnabled && 0 < $list['count'] && $this->redisStatus) {
                    $this->redis->set($key, serialize($list), 660); // 11 min
                }
            }


            $this->setContent(json_encode($list));
        }
    }
}