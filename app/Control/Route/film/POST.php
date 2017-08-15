<?php
namespace Control\Route_film;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;

class POST extends AdminController
{
    public function delete()
    {
        $person = new Film($this->mysql());
        if ($person->delete()) {
            $this->successMessage('Фильм удалён');
        } else {
            $this->setErrorComment($person->error());
            $this->failMessage('Не удалось удалить фильм');
        }

        $this->setRedirect();
    }
}