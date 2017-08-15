<?php
namespace Control\Route_film_box;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Boxoffice\Boxoffice;

class POST extends AdminController
{
    public function edit()
    {
        $boxoffice = new Boxoffice($this->mysql());
        if ($boxoffice->save()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($boxoffice->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}