<?php
namespace Original\Route_article_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\NewsController;
use Kinomania\Original\Logic\News\News;

class GET extends NewsController
{
    public function index()
    {
        $numList = $this->getNumList();

        $item = [];
        $news = null;
	    $views = new News();
	    $views->saveView($numList[0]);

        if (0 < $numList[0]) {
            $key = 'news:' . $numList[0];

            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $item = unserialize($this->redis->get($key));
            } else {
                $news = new News();
                $item = $news->getArticleItem($numList[0]);

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 604800); // 7 days
                }
            }
        }

        if ([] != $item) {
            $moreList = [];
            if (null !== $news) {
                $moreList = $news->getMore($item[\Kinomania\Original\Key\News\News::CATEGORY], $numList[0]);
            }

            $this->addData([
                'newsId' => $numList[0],
                'item' => $item,
                'comment' => $this->getComment($numList[0]),
                'moreList' => $moreList
            ]);
            $this->setTemplate('news/article/item.html.php');
        }
    }
}