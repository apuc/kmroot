<?php
namespace Control\Route_boxoffice_edit;

use Kinomania\Control\Boxoffice\Boxoffice;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    public function editFilmId()
    {
        $boxoffice = new Boxoffice($this->mysql());

        if ($boxoffice->editFilmId()) {
            $this->successMessage('Сохранено');
        } else {
            $this->setErrorComment($boxoffice->error());
            $this->failMessage('Не удалось сохранить');
        }

        $this->setRedirect();
    }
}