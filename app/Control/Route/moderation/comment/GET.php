<?php
namespace Control\Route_moderation_comment;

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
        $this->setTitle('Комментарии');
        $this->setTemplate('comment/index.html.php');
    }
}