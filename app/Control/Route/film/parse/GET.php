<?php
namespace Control\Route_film_parse;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Boxoffice\Boxoffice;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Parse\Parse;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        $this->addData([
            'item' => $item,
        ]);
        $this->setTitle('Парсинг');
        $this->setTemplate('film/parse/index.html.php');
    }
}