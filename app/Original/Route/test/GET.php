<?php

namespace Original\Route_test;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\System\Debug\Debug;

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 22.08.2017
 * Time: 16:55
 */
class GET extends \Kinomania\System\Controller\DefaultController
{

    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        $key = 'poster';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
            Debug::prn($list);
        } else {
            Debug::prn('пусто');
        }
    }

}