<?php
namespace Original\Route_casting_search;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Casting\Casting;

class GET extends DefaultController
{
    public function index()
    {
        $casting = new Casting();
        
        $this->addData([
            'list' => $casting->getCompany()
        ]);
        $this->setTemplate('casting/search.html.php');
    }
}