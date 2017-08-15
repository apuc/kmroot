<?php
namespace Control\Route_person_merge;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $this->addData([
            'toId' => $get->fetchInt('toId')
        ]);
        $this->setTemplate('person/merge.html.php');
    }
}