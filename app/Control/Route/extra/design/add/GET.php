<?php
namespace Control\Route_extra_design_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $this->addData([
            'post' => new PostBag()
        ]);
        $this->setTitle('Добавить редизайн');
        $this->setTemplate('design/add.html.php');
    }
}