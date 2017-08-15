<?php
namespace Original\Route_casting;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Casting\Casting;

class GET extends DefaultController
{

    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'casting';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Casting())->mainData();
            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 72000); // 20 hours
            }
        }

        $this->addData([
            'list' => $list,
        ]);

        $this->setTemplate('casting/index.html.php');
    }
}