<?php
namespace Control\Route_person_photo;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Photo\Photo;

class POST extends AdminController
{
    public function description()
    {
        $photo = new Photo($this->mysql());
        if ($photo->saveDescription()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($photo->error());
            $this->failMessage('Не удалось сохранить изменения');
        }
        $this->setRedirect();
    }
}