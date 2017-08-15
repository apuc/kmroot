<?php
namespace Control\Route_person;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;

class POST extends AdminController
{
    public function delete()
    {
        $person = new Person($this->mysql());
        if ($person->delete()) {
            $this->successMessage('Персона удалена');
        } else {
            $this->setErrorComment($person->error());
            $this->failMessage('Не удалось удалить персону');
        }

        $this->setRedirect();
    }
}