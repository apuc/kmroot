<?php
namespace Original\Route_awards_AWARD_YEAR;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Award\Award;

class GET extends DefaultController
{
    public function index()
    {
        preg_match('#^awards/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $code = $matches[2];
        $year = intval(trim($matches[3], '/'));

        if (!empty($code) && 1850 < $year && 2100 > $year) {
            $key = 'awards:' . $code . ':' . $year;
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list = (new Award())->getList($code, $year);

                if (!Wrap::$debugEnabled && [] != $list['item'] && $redisStatus) {
                    $redis->set($key, serialize($list), 3600); // 1 hour
                }
            }
			
            if ([] != $list['item']) {
                $this->addData([
                    'list' => $list
                ]);

                $this->setTemplate('awards/year.html.php');
            }
        }
    }
}