<?php
namespace Control\Route_news_gallery;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class POST extends AdminController
{
    public function add()
    {
        $id = (new GetBag())->fetchInt('id');
        $news = new News($this->mysql());
        $item = $news->getById($id);

        if (0 == $item->id()) {
            $this->failMessage('Неизвестный ID новости');
        } else {
            if ($news->addGallery()) {
                $this->successMessage('Галерея создана');
            } else {
                $this->setErrorComment($news->error());
                $this->failMessage('Не удалось добавить');
            }
        }
        
        $this->setRedirect();
    }
    
    public function trailer()
    {
        $news = new News($this->mysql());

        if ($news->trailer()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($news->error());
            $this->failMessage('Не удалось сохранить');
        }

        $this->setRedirect();
    }

    public function delete()
    {
        $news = new News($this->mysql());

        if ($news->deleteGallery()) {
            $this->successMessage('Галерея удалена');
        } else {
            $this->setErrorComment($news->error());
            $this->failMessage('Не удалось удалить гадерею');
        }

        $this->setRedirect();
    }
}