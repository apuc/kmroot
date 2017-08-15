<?php
namespace Control\Route_moderation_feedback;

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
        $this->setTitle('Модерация отзывов');
        $this->setTemplate('comment/feedback/index.html.php');
    }
}