<?php
namespace Control\Route_person_crop;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $person = new Person($this->mysql());
        $item = $person->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('person/crop/main.photo.html.php');
    }
}