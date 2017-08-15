<?php
namespace Control\Route_boxoffice;

use Kinomania\Control\Boxoffice\Boxoffice;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    /**
     * Parse new week.
     */
    public function add()
    {
        $boxoffice = new Boxoffice($this->mysql());

        if ($boxoffice->add()) {
            $this->successMessage('Неделя добавлена');
        } else {
            $this->setErrorComment($boxoffice->error());
            switch ($boxoffice->error()) {
                case Boxoffice::WEEKEND_EXIST:
                    $this->failMessage('Такая дата уже добавлена');
                    break;
                default:
                    $this->failMessage('Не удалось добавить');
            }
        }

        $this->setRedirect();
    }
    
    /**
     * Delete week.
     */
    public function delete()
    {
        $boxoffice = new Boxoffice($this->mysql());

        if ($boxoffice->delete()) {
            $this->successMessage('Неделя удалена');
        } else {
            $this->setErrorComment($boxoffice->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}