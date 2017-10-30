<?php
namespace Original\Route_trailers;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Trailer\Trailer;
use Kinomania\System\Debug;
use Kinomania\System\Data\TrailerView;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Trailer())->ajaxList()));
    }
    
    public function upToView (){
    	$trailer = new TrailerView();
    	if(isset($_POST['id'])){
		    $trailer->saveView($_POST['id']);
	    }
	    return false;
    }
}