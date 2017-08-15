<?php
namespace Original\Route_releases_russia;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Releases\Releases;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'releases:ru';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Releases())->getRuList();

            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $this->addData([
            'list' => $list,
            'genre' => Genre::RU,
            'country' => Country::RU,
            'month' => date('n'),
            'year' => date('Y')
        ]);

        $this->setTemplate('releases/russia/index.html.php');
    }
}