<?php
namespace Original\Route_list_year_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Film\Year;

class GET extends DefaultController
{
    public function index()
    {
        $numList = $this->getNumList();

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'year:' . $numList[0] . ':1';
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Year())->getList($numList[0]);

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 420); // 7 min
            }
        }
        
        $this->addData([
            'list' => $list,
            'year' => $numList[0]
        ]);
        $this->setTemplate('list/year.html.php');
    }
}