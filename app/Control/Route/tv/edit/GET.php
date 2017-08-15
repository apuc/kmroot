<?php
namespace Control\Route_tv_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Tv\Tv;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $tv = new Tv($this->mysql());
        $item = $tv->getProgram($get->fetch('id'));

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('tv'));
        } else {
            $this->addData([
                'item' => $item,
                'list' => $tv->getProgramList($item->id())
            ]);
            $this->setTitle('TV программа');
            $this->setTemplate('tv/edit.html.php');
        }
    }
}