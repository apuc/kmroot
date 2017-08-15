<?php
namespace Control\Route_moderation_feedback;

use Kinomania\Control\Comment\Feedback;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    /**
     * Print review on site.
     */
    public function approve()
    {
        $review = new Feedback($this->mysql());
        if ($review->approve()) {
            $this->successMessage('Отзыв опубликован');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось опубликовать отзыв');
        }
        $this->setRedirect();
    }

    /**
     * Print review on site.
     */
    public function delete()
    {
        $review = new Feedback($this->mysql());
        if ($review->delete()) {
            $this->successMessage('Отзыв удален');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось удалить отзыв');
        }
        $this->setRedirect();
    }
}