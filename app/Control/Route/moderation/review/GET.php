<?php
namespace Control\Route_moderation_review;

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
        $this->setTitle('Модерация рецензий');
        $this->setTemplate('comment/review/index.html.php');
    }
}