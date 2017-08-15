<?php
namespace Original\Route_reviews;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'reviews:list:1';
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new News())->getList('Рецензии', 1);

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 720); // 12 min
            }
        }
        
        $this->addData([
            'list' => $list
        ]);

        $this->setTemplate('news/reviews/index.html.php');
    }
}