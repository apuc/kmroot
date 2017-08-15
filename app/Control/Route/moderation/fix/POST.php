<?php
namespace Control\Route_moderation_fix;

use Kinomania\Control\Comment\Fix;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    /**
     * Print review on site.
     */
    public function approve()
    {
        $review = new Fix($this->mysql());
        if ($review->approve()) {
            $this->successMessage('Исправление обработано');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось изменить статус');
        }
        $this->setRedirect();
    }

    /**
     * Print review on site.
     */
    public function delete()
    {
        $review = new Fix($this->mysql());
        if ($review->delete()) {
            $this->successMessage('Исправление удалено');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось удалить исправление');
        }
        $this->setRedirect();
    }
}