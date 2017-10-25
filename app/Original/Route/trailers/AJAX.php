<?php
namespace Original\Route_trailers;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Trailer\Trailer;
use Kinomania\System\Debug;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Trailer())->ajaxList()));
    }
    
    public function upToView (){
    	Debug\Debug::prn($_GET);
    }
}