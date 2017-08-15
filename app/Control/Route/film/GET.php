<?php
namespace Control\Route_film;

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
        $this->setTitle('Фильмы');
        $this->setTemplate('film/index.html.php');
    }
}