<?php
namespace Original\Route_casting;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Casting\Casting;

class AJAX extends DefaultController
{

    public function getMale()
    {
        $get = new GetBag();
        $date = $get->fetch('date');
        $list = (new Casting())->getMale($date);

        $this->setContent(json_encode($list));
    }

    public function getFemale()
    {
        $get = new GetBag();
        $date = $get->fetch('date');
        $list = (new Casting())->getFemale($date);

        $this->setContent(json_encode($list));
    }

    public function getChild()
    {
        $get = new GetBag();
        $sex = $get->fetch('sex');
        $list = (new Casting())->getChild($sex);

        $this->setContent(json_encode($list));
    }
}