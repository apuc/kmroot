<?php
namespace Control\Route_tv;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Tv\Tv;

class POST extends AdminController
{
    public function parse()
    {
        $tv = new Tv($this->mysql());
        if ($tv->parse()) {
            $this->successMessage('Завершено');
        } else {
            $this->setErrorComment($tv->error());
            $this->failMessage('Не удалось');
        }

        $this->setRedirect();
    }
    
    public function reset()
    {
        $tv = new Tv($this->mysql());
        if ($tv->reset()) {
            $this->successMessage('ТВ программа удалена');
        } else {
            $this->setErrorComment($tv->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}