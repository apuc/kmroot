<?php
namespace Original\Route_film_D_frames;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Logic\Film\Frames;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;

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

                $key = 'film:' . $numList[0] . ':frame';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    $list = (new Frames())->get($numList[0]);

                    if (!Wrap::$debugEnabled && [] != $list['list'] && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 1200); // 20 min
                    }
                }

                if ([] != $list['list']) {
                    /**
                     * Film cast.
                     */
                    $cast = [];
                    $result = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_cast` WHERE `filmId` = {$numList[0]} ORDER BY `order` LIMIT 15) as `t` 
                                         JOIN `film_cast` as `t1` ON t.`id` = t1.`id` 
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t2.`status` = 'show' LIMIT 5");
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name_ru'];
                        if (empty($name)) {
                            $name = $row['name_origin'];
                        }

                        $cast[] = [$row['id'], $name];
                    }

                    /**
                     * Film director.
                     */
                    $crew = [];
                    $result = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                     FROM (SELECT `id` FROM `film_crew` WHERE `filmId` = {$numList[0]} ORDER BY `order` LIMIT 9) as `t` 
                                     JOIN `film_crew` as `t1` ON t.`id` = t1.`id`
                                     JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                     WHERE t1.`type` = 'Режиссер' AND t2.`status` = 'show' LIMIT 3");
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name_ru'];
                        if (empty($name)) {
                            $name = $row['name_origin'];
                        }

                        $crew[] = [$row['id'], $name];
                    }
                    
                    
                    $this->addData([
                        'id' => $numList[0],
                        'min' => $min,
                        'list' => $list,
                        'stat' => $this->getStat($numList[0]),
                        'filmCast' => $cast,
                        'filmCrew' => $crew,
                    ]);
                    $this->setTemplate('film/frame/index.html.php');
                }
            }
        }
    }
}