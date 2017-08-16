<?php
namespace Original\Route_boxoffice_usa;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Boxoffice\Boxoffice;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $key = 'boxoffice:usa';
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Boxoffice())->usa();

            if (!Wrap::$debugEnabled && [] != $list['table'] && $redisStatus) {
                $redis->set($key, serialize($list), 43200); // 12 hours
            }
        }

        $this->addData([
            'list' => $list,
			'options' => new Options()
        ]);

        $this->setTemplate('boxoffice/usa.html.php');
    }
}