<?php
namespace Control\Route_news_gallery;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class GET extends AdminController
{
    public function index()
    {
        $id = (new GetBag())->fetchInt('id');
        $news = new News($this->mysql());
        $item = $news->getById($id);

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('news'));
        } else {
            $this->addData([
                'item' => $item,
                'list' => $news->getList($item->id())
            ]);
            $this->setTitle('Галереи статьи');
            $this->setTemplate('news/gallery/index.html.php');
        }
    }
}