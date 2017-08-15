<?php
namespace Original\Route_film_D_soundtracks;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Soundtrack;

class GET extends FilmController
{
    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $soundtrack = null;

            $key = 'film:' . $numList[0] . ':soundtrack';
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $list = unserialize($this->redis->get($key));
            } else {
                $soundtrack = new Soundtrack();
                $list = $soundtrack->get($numList[0]);

                if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                    $this->redis->set($key, serialize($list), 900); // 15 min
                }
            }

            if ([] != $list) {
                $key = 'popular:soundtrack';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $popular = unserialize($this->redis->get($key));
                } else {
                    if (is_null($soundtrack)) {
                        $soundtrack = new Soundtrack();
                    }
                    $popular = $soundtrack->popular();

                    if (!Wrap::$debugEnabled && [] != $popular && $this->redisStatus) {
                        $this->redis->set($key, serialize($popular), 900); // 15 min
                    }
                }

                $this->addData([
                    'id' => $numList[0],
                    'list' => $list,
                    'popular' => $popular,
                    'min' => $this->getMin($numList[0]),
                    'stat' => $this->getStat($numList[0])
                ]);
                $this->setTemplate('film/soundtrack/index.html.php');
            }
        }
    }
}