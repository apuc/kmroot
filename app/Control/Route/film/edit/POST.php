<?php
namespace Control\Route_film_edit;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;

class POST extends AdminController
{
    public function edit()
    {
        $film = new Film($this->mysql());

        if ($film->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }

    public function editSys()
    {
        $film = new Film($this->mysql());

        if ($film->editSys()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }

    public function merge()
    {
        $film = new Film($this->mysql());

        if ($film->merge()) {
            $this->successMessage('Данные перенесены');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Film::ID_NOT_FOUND:
                    $this->failMessage('ID не найден');
                    break;
                default:
                    $this->failMessage('Не удалось перенести данные');
            }
        }

        $this->setRedirect();
    }
}