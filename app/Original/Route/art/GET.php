<?php
namespace Original\Route_art;

use Kinomania\Original\Controller\DefaultController;

class GET extends DefaultController
{
    public function index()
    {
        $this->setTemplate('art/index.html.php');
    }
}