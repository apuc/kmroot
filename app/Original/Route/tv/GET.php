<?php
namespace Original\Route_tv;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\TV\TV;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'tv';
        if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $list = (new TV())->get(date('Y-m-d'));
            if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 1200); // 20 min
            }
        }

        $dowMap = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $dateList =[
            date('Y-m-d') => 'Сегодня',
            date('Y-m-d', strtotime('+1 days')) => 'Завтра',
            date('Y-m-d', strtotime('+2 days')) => date('d', strtotime('+2 days')) . ', ' . $dowMap[date('w', strtotime('+2 days'))],
            date('Y-m-d', strtotime('+3 days')) => date('d', strtotime('+3 days')) . ', ' . $dowMap[date('w', strtotime('+3 days'))],
            date('Y-m-d', strtotime('+4 days')) => date('d', strtotime('+4 days')) . ', ' . $dowMap[date('w', strtotime('+4 days'))],
            date('Y-m-d', strtotime('+5 days')) => date('d', strtotime('+5 days')) . ', ' . $dowMap[date('w', strtotime('+5 days'))],
            date('Y-m-d', strtotime('+6 days')) => date('d', strtotime('+6 days')) . ', ' . $dowMap[date('w', strtotime('+6 days'))],
        ];

        $this->addData([
            'list' => $list,
            'dateList' => $dateList,
			'options' => new Options()
        ]);

        $this->setTemplate('tv/index.html.php');
    }
}