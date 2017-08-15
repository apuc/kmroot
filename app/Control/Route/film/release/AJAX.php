<?php
namespace Control\Route_film_release;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Release;

class AJAX extends AdminController
{

    public function getList()
    {
        $this->setContent((new Release($this->mysql()))->renderTable());
    }

}