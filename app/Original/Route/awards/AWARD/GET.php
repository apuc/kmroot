<?php
namespace Original\Route_awards_AWARD;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Award\Award;

class GET extends DefaultController
{
    public function index()
    {
        preg_match('#^awards/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $code = $matches[2];

        if (!empty($code)) {
            $key = 'awards:' . $code;
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists($key)) {
                $item = unserialize($redis->get($key));
            } else {
                $item = (new Award())->getByCode($code);
                if (!Wrap::$debugEnabled && [] != $item && $redisStatus) {
                    $redis->set($key, serialize($item), 3600); // 1 hour
                }
            }

            if ([] != $item) {
                $this->addData([
                    'item' => $item
                ]);

                $this->setTemplate('awards/item.html.php');
            }
        }
    }
}