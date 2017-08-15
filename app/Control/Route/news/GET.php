<?php
namespace Control\Route_news;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Data\News;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();

        $from = $get->fetch('from');
        $to = $get->fetch('to');
        $category = $get->fetchInt('category');

        $getParameter = '';
        if ('' != $category) {
            $getParameter .= '&category=' . $category;
        } else {
            $category = '';
        }
        if (!empty($from)) {
            $getParameter .= '&from=' . $from;
        }
        if (!empty($to)) {
            $getParameter .= '&to=' . $to;
        }

        $this->addData([
            'getParameter' => $getParameter,
            'from' => $from,
            'to' => $to,
            'categoryList' => News::CATEGORY,
            'category' => (new GetBag())->fetch('category')
        ]);
        $this->setTitle('Статьи');
        $this->setTemplate('news/index.html.php');
    }
}