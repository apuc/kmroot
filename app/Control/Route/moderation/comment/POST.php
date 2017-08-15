<?php
namespace Control\Route_moderation_comment;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    public function delete()
    {
        $video = new Comment($this->mysql());

        if ($video->delete()) {
            $this->successMessage('Комменатрий удалён');
        } else {
            $this->setErrorComment($video->error());
            $this->failMessage('Не удалось удалить');
        }

        $this->setRedirect();
    }
}