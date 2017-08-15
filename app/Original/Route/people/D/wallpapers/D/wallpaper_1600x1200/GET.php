<?php
namespace Original\Route_people_D_wallpapers_D_wallpaper_1600x1200;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Key\Person\Wallpaper;
use Kinomania\Original\Logic\Person\Wallpapers;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;

class GET extends PersonController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0] && 0 < $numList[1]) {
            $min = $this->getMin($numList[0]);

            if ([] != $min) {
                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'person:' . $numList[0] . ':wallpaper:item:' . $numList[1];
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    $list = (new Wallpapers())->getById($numList[0], $numList[1]);

                    if (isset($list['item'])) {
                        $result = $this->mysql()->query("SELECT `id` FROM `person_wallpaper` WHERE `personId` = {$numList[0]} AND `image` != '' ORDER BY `id` DESC");
                        while ($row = $result->fetch_assoc()) {
                            $list['list'][] = $row['id'];
                        }


                        if (!Wrap::$debugEnabled && $this->redisStatus) {
                            $this->redis->set($key, serialize($list), 300); // 5 min
                        }
                    }
                }

                if ([] != $list) {
                    $list['item'][Wallpaper::IMAGE] = $list['item'][Wallpaper::R_1600x1200];
                    $this->addData([
                        'id' => $numList[0],
                        'wallpaperId' => $numList[1],
                        'min' => $min,
                        'list' => $list,
                        'stat' => $this->getStat($numList[0]),
                        'width' => 1600,
                        'height' => 1200
                    ]);
                    $this->setTemplate('person/wallpaper/item.html.php');
                }
            }
        }
    }
}