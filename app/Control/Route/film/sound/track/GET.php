<?php
namespace Control\Route_film_sound_track;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $sound = new Soundtrack($this->mysql());
        $item = $sound->getDir($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
        } else {
            $this->addData([
                'item' => $item,
                'list' => $sound->getTrackList($id)
            ]);
            $this->setTitle('Саундтреки коллекции');
            $this->setTemplate('film/sound/track.html.php');
        }
    }
}