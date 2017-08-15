<?php
namespace Control\Route_film_frame;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Frame\Frame;

class POST extends AdminController
{
    public function edit()
    {
        $frame = new Frame($this->mysql());
        if ($frame->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($frame->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }

    public function person()
    {
        $frame = new Frame($this->mysql());
        if ($frame->person()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($frame->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}