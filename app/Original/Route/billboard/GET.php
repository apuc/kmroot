<?php
namespace Original\Route_billboard;

use Kinomania\Original\Controller\DefaultController;

class GET extends DefaultController
{

    public function index()
    {
        $this->setTemplate('billboard/index.html.php');
    }
}