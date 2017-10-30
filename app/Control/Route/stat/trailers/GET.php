<?php
namespace Control\Route_stat_trailers;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Stat\Stat;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Pagination;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Трейлеры');
        $trailers = new Stat();
        $page = (isset($_GET['page'])) ? $_GET['page'] : '1';
	    $offset = $page * 10 - 10;
	    $count = $trailers->countTrailers();
	    $pagination = new Pagination\Pagination($count['count'], $page);
	    $this->addData([
		    'trailers'=> $trailers->selectTrailersViewByDate(date('Y-m-d H:m:s'), $offset),
		    'page' => (isset($_GET['page'])) ? $_GET['page'] : '1',
		    'itemCount' => $count['count'],
		    'pagination' => $pagination,
	    ]);
	
	    $this->setTemplate('stat/trailers/trailers.html.php');
    }
}