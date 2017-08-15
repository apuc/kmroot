<?php
namespace Original\Route_tv;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\TV\TV;

class AJAX extends DefaultController
{
    public function get()
    {
        $get = new GetBag();
        $date = $get->fetch('date');
        $chanelId = $get->fetchInt('chanelId');

        $tv = new TV();
        $data = $tv->getAjax($date, $chanelId);

        $this->setContent(json_encode($data));
    }
}