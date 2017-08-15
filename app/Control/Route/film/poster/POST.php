<?php
namespace Control\Route_film_poster;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Poster\Poster;

class POST extends AdminController
{
    public function edit()
    {
        $frame = new Poster($this->mysql());
        if ($frame->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($frame->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}