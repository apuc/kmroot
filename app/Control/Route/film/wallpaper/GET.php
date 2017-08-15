<?php
namespace Control\Route_film_wallpaper;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Wallpaper\Wallpaper;

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
            $wallpaper = new Wallpaper($this->mysql());
     
            $this->addData([
                'item' => $item,
                'list' => $wallpaper->getPhoto($item->id())
            ]);
            $this->setTitle('Обои фильма');
            $this->setTemplate('film/wallpaper/index.html.php');
        }
    }
}