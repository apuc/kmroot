<?php
namespace Original\Route_boxoffice_usa_DATE;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Boxoffice\Boxoffice;

class GET extends DefaultController
{
    public function index()
    {
        preg_match('#^boxoffice/usa/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $date = $matches[2];

        if (!empty($date)) {
            if (preg_match('/^[0-9_]{2,64}$/u', $date)) {
                $temp = explode('_', $date);
                $date = $temp[2] ?? '';
                $date .= '-';
                $date .= $temp[1] ?? '';
                $date .= '-' . $temp[0];
                
                $key = 'boxoffice:usa:' . $date;
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists($key)) {
                    $list = unserialize($redis->get($key));
                } else {
                    $list = (new Boxoffice())->usa($date);

                    if (!Wrap::$debugEnabled && [] != $list['table'] && $redisStatus) {
                        $redis->set($key, serialize($list), 21600); // 6 hours
                    }
                }

                $this->addData([
                    'list' => $list
                ]);

                $this->setTemplate('boxoffice/usa.html.php');
            }
        }
    }
}