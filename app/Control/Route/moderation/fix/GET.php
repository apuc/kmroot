<?php
namespace Control\Route_moderation_fix;

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
        $this->setTitle('Модерация исправлений');
        $this->setTemplate('comment/fix/index.html.php');
    }
}