<?php
namespace Control\Route_extra_design;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Design\Design;

class POST extends AdminController
{
    public function delete()
    {
        $design = new Design($this->mysql());

        if ($design->delete()) {
            $this->successMessage('Удалено');
        } else {
            $this->setErrorComment($design->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}