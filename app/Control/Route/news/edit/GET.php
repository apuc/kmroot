<?php
namespace Control\Route_news_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Admin;
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
            $awardList = [];
            if ('Фестивали и премии' == $item->category()) {
                $awardList = $news->awardsList();
            }
            
            $this->addData([
                'item' => $item,
                'list' => $news->getList($item->id()),
                'categoryList' => \Kinomania\System\Data\News::CATEGORY,
                'awardList' => $awardList,
                'adminList' => (new Admin($this->mysql()))->getUserList()
            ]);
            $this->setTitle('Редактировать статью');
            $this->setTemplate('news/edit.html.php');
        }
    }
}