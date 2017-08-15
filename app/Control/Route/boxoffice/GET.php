<?php
namespace Control\Route_boxoffice;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();

        $this->addData([
            'get' => $get
        ]);
        $this->setTitle('Сборы, бокс-офис');
        $this->setTemplate('boxoffice/index.html.php');
    }
}