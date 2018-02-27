<?php
namespace Control\Route_stat_new;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Stat\Stat;
use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\System\Debug\Debug;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Публикации');
	    $new = new Stat();
	    if(isset($_GET['category'])) {
		    if(is_numeric($_GET['category'])){
			    $id = $_GET['category'];
		    } else {
			    $category = $_GET['category'];
		    }
		    $this->addData([
			    'new'=> $new->selectNewView( (isset($category)) ? $category : '', (isset($id)) ? $id : ''),
			    'categoryList' => ['Новости кино', 'Рецензии', 'Был бы повод', 'Подборки', 'Пресс-обзор'],
			    'category' => (new GetBag())->fetch('category'),
		    ]);
		    $this->setTemplate('stat/news/item.html.php');
	    }
    }
}