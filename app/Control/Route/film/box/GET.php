<?php
namespace Control\Route_film_box;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Boxoffice\Boxoffice;
use Kinomania\Control\Film\Film;

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
            $boxoffice = new Boxoffice($this->mysql());
     
            $this->addData([
                'item' => $item,
                'gross' => $boxoffice->getByFilmId($item->id())
            ]);
            $this->setTitle('Сборы фильма');
            $this->setTemplate('film/boxoffice/index.html.php');
        }
    }
}