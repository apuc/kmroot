<?php
namespace Original\Route_boxoffice_russia;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Boxoffice\Boxoffice;

class GET extends DefaultController
{
    public function index()
    {
        $key = 'boxoffice:russia';
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Boxoffice())->russia();

            if (!Wrap::$debugEnabled && [] != $list['table'] && $redisStatus) {
                $redis->set($key, serialize($list), 43200); // 12 hours
            }
        }

        $this->addData([
            'list' => $list
        ]);

        $this->setTemplate('boxoffice/russia.html.php');
    }
}