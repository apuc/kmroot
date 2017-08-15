<?php
namespace Control\Route_film_sound_track;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

class POST extends AdminController
{
    public function edit()
    {
        $film = new Soundtrack($this->mysql());

        if ($film->editTrack()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}