<?php
namespace Control\Route_news_crop;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $news = new News($this->mysql());
        $item = $news->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('news/crop/image.html.php');
    }
}