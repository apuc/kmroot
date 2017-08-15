<?php
namespace Original\Route_tag_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\Tag;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $numList = $this->getNumList();

        $result = $this->mysql()->query("SELECT `tag` FROM `news_tag_value` WHERE `id` = {$numList[0]} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');

            $key = 'tag:list:1';
            if ($redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list = (new Tag())->getList($numList[0], 1);

                if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                    $redis->set($key, serialize($list), 720); // 12 min
                }
            }

            $this->addData([
                'tagId' => $numList[0],
                'tag' => $row['tag'],
                'list' => $list,
                'socTitle' => urlencode('KINOMANIA.RU :: Новости по тегу `' . $row['tag'] . '`')
            ]);

            $this->setTemplate('news/tag/index.html.php');
        }
    }
}