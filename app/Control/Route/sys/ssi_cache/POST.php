<?php
namespace Control\Route_sys_ssi_cache;

use Dspbee\Bundle\Common\TFileSystem;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    use TFileSystem;
    
    public  function resetSsiCache(){
        $this->removeFromDir("/tmp/ssi_cache" );
        $this->successMessage('Кеш сброшен');
	    $this->setRedirect();
        /*var_dump(dir('/tmp/ssi_cache'));*/
    }

}