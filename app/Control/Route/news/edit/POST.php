<?php
namespace Control\Route_news_edit;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class POST extends AdminController
{
    public function edit()
    {
        $news = new News($this->mysql());
        if ($news->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($news->error());
            $this->failMessage('Не удалось внести изменения');
        }
        $this->setRedirect();
    }
    public function changeCategory()
    {
        $news = new News($this->mysql());
        if ($news->changeCategory()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($news->error());
            $this->failMessage('Не удалось внести изменения');
        }
        $this->setRedirect();
    }
}