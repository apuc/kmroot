<?php
namespace Control\Route_person_wallpaper;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;
use Kinomania\Control\Person\Wallpaper\Wallpaper;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $person = new Person($this->mysql());
        $item = $person->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect('person');
        } else {
            $this->addData([
                'item' => $item,
                'list' => (new Wallpaper($this->mysql()))->getPhoto($item->id())
            ]);
            $this->setTitle('Обои');
            $this->setTemplate('person/wallpaper/index.html.php');
        }
    }
}