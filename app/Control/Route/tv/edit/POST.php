<?php
namespace Control\Route_tv_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Tv\Tv;

class POST extends AdminController
{
    public function editFilmId()
    {
        $tv = new Tv($this->mysql());
        
        if ($tv->editFilmId()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($tv->error());
            $this->failMessage('Не удалось');
        }

        $this->setRedirect();
    }
}