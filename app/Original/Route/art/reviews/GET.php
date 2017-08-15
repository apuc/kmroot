<?php
namespace Original\Route_art_reviews;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;

class GET extends DefaultController
{
    public function index()
    {
        $key = 'art_reviews:list:1';
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new News())->getList('Рецензии ART', 1);

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 720); // 12 min
            }
        }
        
        $this->addData([
            'list' => $list
        ]);

        $this->setTemplate('art/reviews/index.html.php');
    }
}