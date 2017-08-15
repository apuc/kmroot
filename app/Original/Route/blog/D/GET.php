<?php
namespace Original\Route_blog_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $numList = $this->getNumList();
        $authorId = $numList[0];

        if (0 < $authorId) {
            $list = [];

            $key = 'blog:' . $authorId . ':list:1';
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $result = $this->mysql()->query("SELECT `login`, `name`, `surname` FROM `user` WHERE `id` = {$authorId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if (empty($row['name']) && empty($row['surname'])) {
                        $name = $row['login'];
                    } else {
                        $name = $row['name'] . ' ' . $row['surname'];
                    }
                    $list['user'] = ['id' => $authorId, 'login' => $row['login'], 'name' => $name];

                    $list['blog'] = (new News())->getList('Блог USER', 1, $authorId);

                    if (!Wrap::$debugEnabled && [] != $list['blog'] && $redisStatus) {
                        $redis->set($key, serialize($list), 420); // 7 min
                    }
                }
            }

            if (isset($list['blog'])) {
                $this->addData([
                    'list' => $list
                ]);

                $this->setTemplate('news/blog/user.html.php');
            }
        }
    }
}