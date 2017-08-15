<?php
namespace Control\Route_company_add;

use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $this->setTemplate('company/add.html.php');
    }
}