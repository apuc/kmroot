<?php
namespace Control\Route_stat_news;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Stat\Stat;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Pagination\Pagination;
use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\System\Data\News;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
    	$this->setTitle('Публикации');
    	$news = new Stat();
        $page = (isset($_GET['page'])) ? $_GET['page'] : '1';
	    $offset = $page * 10 - 10;
	    $count = $news->countNews();
	    $pagination = new Pagination($count['count'], $page);
	    $this->addData([
		    'news'=> (isset($_GET['category']))? $news->selectNewsViewByDate(date('Y-m-d H:m:s'), $offset, $_GET['category']) : $news->selectNewsViewByDate(date('Y-m-d H:m:s'), $offset),
		    'page' => (isset($_GET['page'])) ? $_GET['page'] : '1',
		    'itemCount' => $count['count'],
		    'pagination' => $pagination->printPag(false),
		    'categoryList' => ['Новости кино', 'Рецензии', 'Был бы повод', 'Подборки', 'Пресс-обзор'],
		    'category' => (new GetBag())->fetch('category'),
	    ]);
	
	    $this->setTemplate('stat/news/index.html.php');
    }
}