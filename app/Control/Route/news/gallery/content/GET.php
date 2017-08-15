<?php
namespace Control\Route_news_gallery_content;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $newsId = $get->fetchInt('newsId');
        $news = new News($this->mysql());
        $item = $news->getById($newsId);

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('news'));
        } else {
            $this->addData([
                'item' => $item,
                'id' => $id,
                'list' => $news->getGalleryPhoto($id)
            ]);
            $this->setTitle('Изображения галереи');
            $this->setTemplate('news/gallery/content.html.php');
        }
    }
}