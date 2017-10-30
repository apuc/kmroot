<?php
namespace Control\Route_stat_trailer;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Stat\Stat;
use Kinomania\System\Debug\Debug;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Трейлеры');
	    $trailer = new Stat();
	    if(isset($_GET['film'])) {
		    if(is_numeric($_GET['film'])){
			    $id = $_GET['film'];
		    } else {
			    $film = $_GET['film'];
		    }
		    $this->addData([
			    'trailer'=> $trailer->selectTrailerView( (isset($film)) ? $film : '', (isset($id)) ? $id : ''),
		    ]);
		    $this->setTemplate('stat/trailer/trailer.html.php');
	    }
    }
}