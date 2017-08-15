<?php
namespace Original\Route_login;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Kinomania\Original\Controller\DefaultController;

class GET extends DefaultController
{
    public function index()
    {
        $cookie = new CookieBag();
        if ($cookie->has('__user__')) {
            $this->setRedirect('/', 307);
        } else {
            $this->setTemplate('auth/login.html.php');
        }
    }
}