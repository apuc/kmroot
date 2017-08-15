<?php
namespace Control\Route_person_casting;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Casting\Casting;
use Kinomania\Control\Person\Person;

class POST extends AdminController
{
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

    /**
     * Change casting data.
     */
    public function edit()
    {
        $casting = new Casting($this->mysql());

        if ($casting->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($casting->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}