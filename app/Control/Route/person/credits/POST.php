<?php
namespace Control\Route_person_credits;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Filmography\Filmography;

class POST extends AdminController
{
    public function addCast()
    {
        $film = new Filmography($this->mysql());

        if ($film->addCast()) {
            $this->successMessage('Фильм добавлен');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Фильм уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось добавить фильм');
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
                    $this->failMessage('Фильм уже есть в списе');
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
            $this->successMessage('Фильм добавлен');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Filmography::EXIST_PERSON:
                    $this->failMessage('Фильм уже есть в списе');
                    break;
                default:
                    $this->failMessage('Не удалось добавить фильм');
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
                    $this->failMessage('Фильм уже есть в списе');
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
            $this->successMessage('Фильм удален из списка');
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
            $this->successMessage('Фильм удален из списка');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}