<?php
namespace Control\Route_film_crop;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('film/crop/main.photo.html.php');
    }
}