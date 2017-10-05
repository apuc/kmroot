<?php
namespace Original\Route_awards;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Award\Award;
use Kinomania\System\Options\Options;

/**
 * Class GET
 * @package Original\Route_awards
 */
class GET extends DefaultController
{
    public function index()
    {
        $key = 'awards';
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Award())->awards();
            if (!Wrap::$debugEnabled && ([] != $list['award'] || [] != $list['festival']) && $redisStatus) {
                $redis->set($key, serialize($list), 86400); // 1 day
            }
        }

        $this->addData([
            'list' => $list,
			'options' => new Options()
        ]);

        $this->setTemplate('awards/index.html.php');
    }
}