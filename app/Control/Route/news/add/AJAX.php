<?php
namespace Control\Route_news_add;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Data\News;

class AJAX extends AdminController
{
    public function index()
    {
        $this->addData([
            'categoryList' => News::CATEGORY
        ]);
        $this->setTemplate('news/add.html.php');
    }
}