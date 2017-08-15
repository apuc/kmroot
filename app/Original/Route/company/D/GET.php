<?php
namespace Original\Route_company_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Company\Company;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $numList = $this->getNumList();
        
        if (0 < $numList[0]) {
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');

            $key = 'company:' . $numList[0];
            if ($redisStatus && $redis->exists($key)) {
                $item = unserialize($redis->get($key));
            } else {
                $item = (new Company())->get($numList[0]);
    
                if (!Wrap::$debugEnabled && [] != $item && $redisStatus) {
                    $redis->set($key, serialize($item), 259200); // 3 days
                }
            }

            if ([] != $item) {
                $type = 0; // films
                if ('Кастинг-агентство' == $item[\Kinomania\Original\Key\Company\Company::TYPE]) {
                    $type = 1;
                } else if ('Фонд' == $item[\Kinomania\Original\Key\Company\Company::TYPE]) {
                    $type = 2;
                }

                $this->addData([
                    'item' => $item,
                    'type' => $type
                ]);

                $this->setTemplate('company/index.html.php');
            }
        }
    }
}