<?php
namespace Control\Route_quit;

use Kinomania\Control\Auth\Auth;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $admin = new Auth($this->mysql());
        $logout = $admin->logout();
        $logout->quit();
        $this->setRedirect($this->request->makeUrl('/login'));
    }
}