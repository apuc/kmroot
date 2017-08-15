<?php
namespace Original\Route_news_rus_serials;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'rus_series:list:1';
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new News())->getList('Российские сериалы', 1);

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 420); // 7 min
            }
        }
        
        $this->addData([
            'list' => $list
        ]);

        $this->setTemplate('news/rus_serials/index.html.php');
    }
}