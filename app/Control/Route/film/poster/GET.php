<?php
namespace Control\Route_film_poster;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Poster\Poster;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
        } else {
            $poster = new Poster($this->mysql());
     
            $this->addData([
                'item' => $item,
                'list' => $poster->getPhoto($item->id()),
            ]);
            $this->setTitle('Постеры');
            $this->setTemplate('film/poster/index.html.php');
        }
    }
}