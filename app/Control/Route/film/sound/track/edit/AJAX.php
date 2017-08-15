<?php
namespace Control\Route_film_sound_track_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $sound = new Soundtrack($this->mysql());
        $this->addData([
            'item' => $sound->getTrack($get->fetchInt('id'))
        ]);
        $this->setTemplate('film/sound/track.edit.html.php');
    }
}