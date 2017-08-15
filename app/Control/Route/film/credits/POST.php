<?php
namespace Control\Route_film_credits;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Filmography\Filmography;

class POST extends AdminController
{
    public function addCast()
    {
        $film = new Filmography($this->mysql());

        if ($film->addCast()) {
            $this->successMessage('Актёр добавлен');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Актёр уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось добавить актёра');
            }
        }

        $this->setRedirect();
    }
    
    public function editCast()
    {
        $film = new Filmography($this->mysql());

        if ($film->editCast()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Актёр уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось сохранить изменения');
            }
        }

        $this->setRedirect();
    }

    public function addCrew()
    {
        $film = new Filmography($this->mysql());

        if ($film->addCrew()) {
            $this->successMessage('Персона добавлена');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Персона уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось добавить персону');
            }
        }

        $this->setRedirect();
    }

    public function editCrew()
    {
        $film = new Filmography($this->mysql());

        if ($film->editCrew()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Персона уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось сохранить изменения');
            }
        }

        $this->setRedirect();
    }

    public function deleteCast()
    {
        $film = new Filmography($this->mysql());

        if ($film->deleteCast()) {
            $this->successMessage('Актёр удален из списка');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }

    public function deleteCrew()
    {
        $film = new Filmography($this->mysql());

        if ($film->deleteCrew()) {
            $this->successMessage('Персона удалена из списка');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}