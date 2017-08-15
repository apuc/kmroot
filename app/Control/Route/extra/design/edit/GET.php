<?php
namespace Control\Route_extra_design_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Design\Design;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $design = new Design($this->mysql());
        $item = $design->getById($id);
        $this->addData([
            'item' => $item,
            'post' => new PostBag()
        ]);
        $this->setTitle('Редактировать редизайн');
        $this->setTemplate('design/edit.html.php');
    }
}