<?php
namespace Control\Route_news_gallery_crop;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;
use Kinomania\Control\News\News;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $news = new News($this->mysql());
        list($image, $extension) = $news->getPhoto($id);
        if (!empty($image)) {
            $this->addData([
                'id' => $id,
                'image' => $image,
                'extension' => $extension,
            ]);
            $this->setTemplate('news/gallery/crop.html.php');
        }
    }
}