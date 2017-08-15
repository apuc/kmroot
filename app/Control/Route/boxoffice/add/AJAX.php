<?php
namespace Control\Route_boxoffice_add;

use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $this->setTemplate('boxoffice/add.html.php');
    }
}