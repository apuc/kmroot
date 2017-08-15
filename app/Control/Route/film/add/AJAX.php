<?php
namespace Control\Route_film_add;

use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $this->setTemplate('film/add.html.php');
    }
}