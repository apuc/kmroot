<?php
namespace Control\Route_film_merge;

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
        $this->setTemplate('film/merge.html.php');
    }
}