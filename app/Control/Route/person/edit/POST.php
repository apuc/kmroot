<?php
namespace Control\Route_person_edit;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;

class POST extends AdminController
{
    public function edit()
    {
        $person = new Person($this->mysql());

        if ($person->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($person->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }

    /**
     * Edit id's.
     */
    public function editSys()
    {
        $person = new Person($this->mysql());

        if ($person->editSys()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($person->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
    
    public function updatePhotoId()
    {
        $person = new Person($this->mysql());

        if ($person->updatePhotoId()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($person->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }

    public function merge()
    {
        $film = new Person($this->mysql());

        if ($film->merge()) {
            $this->successMessage('Данные перенесены');
        } else {
            $this->setErrorComment($film->error());
            switch ($film->error()) {
                case Person::ID_NOT_FOUND:
                    $this->failMessage('ID не найден');
                    break;
                default:
                    $this->failMessage('Не удалось перенести данные');
            }
        }

        $this->setRedirect();
    }
}