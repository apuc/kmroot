<?php
namespace Control\Route_person_add;

use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $this->setTemplate('person/add.html.php');
    }
}