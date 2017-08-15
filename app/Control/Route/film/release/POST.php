<?php
namespace Control\Route_film_release;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Release;

class POST extends AdminController
{

    public function editRelease()
    {
        $film = new Release($this->mysql());

        if ($film->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось сохранить изменения');
        }


        $this->setRedirect();
    }

}