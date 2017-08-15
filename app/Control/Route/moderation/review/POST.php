<?php
namespace Control\Route_moderation_review;

use Kinomania\Control\Comment\Review;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    /**
     * Print review on site.
     */
    public function approve()
    {
        $review = new Review($this->mysql());
        if ($review->approve()) {
            $this->successMessage('Рецензия опубликована');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось опубликовать рецензию');
        }
        $this->setRedirect();
    }

    /**
     * Print review on site.
     */
    public function delete()
    {
        $review = new Review($this->mysql());
        if ($review->delete()) {
            $this->successMessage('Рецензия удалена');
        } else {
            $this->setErrorComment($review->error());
            $this->failMessage('Не удалось удалить рецензию');
        }
        $this->setRedirect();
    }
}