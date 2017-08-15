<?php
namespace Control\Route_news;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class POST extends AdminController
{
    /**
     * Create article.
     */
    public function add()
    {
        $news = new News($this->mysql());

        if ($news->add($this->admin()->id())) {
            $this->successMessage('Статья добавлена');
            $this->setRedirect($this->request->makeUrl('news/edit?id=' . $news->getInsertId()));
        } else {
            $this->setErrorComment($news->error());
            switch ($news->error()) {
                case News::TITLE_EXIST:
                    $this->failMessage('Такой заголовок уже есть у другой новости');
                    break;
                default:
                    $this->failMessage('Не удалось добавить новость');
            }
            $this->setRedirect();
        }
    }

    /**
     * Delete article.
     */
    public function delete()
    {
        $news = new News($this->mysql());

        if ($news->delete()) {
            $this->successMessage('Новость удалена');
        } else {
            $this->setErrorComment($news->error());
            $this->failMessage('Не удалось удалить новость');
        }

        $this->setRedirect();
    }
}