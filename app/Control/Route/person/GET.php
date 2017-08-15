<?php
namespace Control\Route_person;

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
        $this->setTitle('Персоналии');
        $this->setTemplate('person/index.html.php');
    }
}