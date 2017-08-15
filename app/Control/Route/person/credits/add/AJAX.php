<?php
namespace Control\Route_person_credits_add;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Photo\Photo;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $this->addData([
            'personId' => $get->fetchInt('personId')
        ]);
        $this->setTemplate('person/films/cast.add.html.php');
    }
}