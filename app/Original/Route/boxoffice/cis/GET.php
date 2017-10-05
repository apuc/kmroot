<?php
namespace Original\Route_boxoffice_cis;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Boxoffice\Boxoffice;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    use TRepository;
    use TDate;

    public function index()
    {
        $key = 'boxoffice:cis';
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new Boxoffice())->cis();

            if (!Wrap::$debugEnabled && [] != $list['table'] && $redisStatus) {
                $redis->set($key, serialize($list), 43200); // 12 hours
            }
        }

        $this->addData([
            'list' => $list,
			'options' => new Options()
        ]);

        $this->setTemplate('boxoffice/cis.html.php');
    }
}