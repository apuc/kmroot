<?php
namespace Control\Route_person_parse;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Person($this->mysql());
        $item = $film->getById($id);
        $this->addData([
            'item' => $item,
        ]);
        $this->setTitle('Парсинг');
        $this->setTemplate('person/parse/index.html.php');
    }
}