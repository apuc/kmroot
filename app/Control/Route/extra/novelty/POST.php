<?php
namespace Control\Route_extra_novelty;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Popular\Popular;

class POST extends AdminController
{
    public function edit()
    {
        $popular = new Popular($this->mysql());
		
        if ($popular->save()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($popular->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}