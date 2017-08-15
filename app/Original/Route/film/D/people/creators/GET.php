<?php
namespace Original\Route_film_D_people_creators;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Logic\Film\People;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends FilmController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $numList = $this->getNumList();
        
        if (0 < $numList[0]) {
            $min = $this->getMin($numList[0]);
            if ([] != $min) {
                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'film:' . $numList[0] . ':people:creators';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $item = unserialize($this->redis->get($key));
                } else {
                    $item = (new People())->crew($numList[0]);

                    if (!Wrap::$debugEnabled && $this->redisStatus) {
                        if ([] == $item['list']) {
                            $this->redis->set($key, serialize($item), 600); // 10 min
                        } else {
                            $this->redis->set($key, serialize($item), 3600); // 1 hour
                        }
                    }
                }

                $this->addData([
                    'id' => $numList[0],
                    'item' => $item,
                    'min' => $min,
                    'stat' => $this->getStat($numList[0])
                ]);
                $this->setTemplate('film/people/crew.html.php');
            }
        }
    }
}