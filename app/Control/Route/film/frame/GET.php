<?php
namespace Control\Route_film_frame;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Company\Company;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Filmography\Filmography;
use Kinomania\Control\Film\Frame\Frame;
use Kinomania\Control\Film\Soundtrack\MP3\MP3;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

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
            $frame = new Frame($this->mysql());
     
            $this->addData([
                'item' => $item,
                'list' => $frame->getPhoto($item->id()),
                'personList' => $frame->personList($item->id())
            ]);
            $this->setTitle('Кадры');
            $this->setTemplate('film/frame/index.html.php');
        }
    }
}