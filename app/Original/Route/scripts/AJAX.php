<?php
namespace Original\Route_scripts;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Script\Script;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Script())->ajaxList()));
    }
}