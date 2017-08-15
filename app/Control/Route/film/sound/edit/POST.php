<?php
namespace Control\Route_film_sound_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

class POST extends AdminController
{
    public function edit()
    {
        $film = new Soundtrack($this->mysql());

        $item = $film->getDir((new PostBag())->fetchInt('id'));

        if ($film->edit()) {
            $this->successMessage('Изменения сохранены');
            $this->setRedirect($this->request->makeUrl('film/sound?id=' . $item->filmId()));
        } else {
            $this->setErrorComment($film->error());
            if (Soundtrack::BAD_YEAR == $film->error()) {
                $this->failMessage('Год вне допустимого диапазона');
            } else {
                $this->failMessage('Не удалось сохранить изменения');
            }
            $this->setRedirect();
        }
    }
}