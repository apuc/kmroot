<?php
namespace Original\Route_logout;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Kinomania\Original\Auth\User\Logout;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $cookie = new CookieBag();
        if ($cookie->has('__user__')) {
            $logout = new Logout($this->mysql());
            $logout->quit();
            $this->setRedirect('/', 307);
        } else {
            $this->setRedirect('/', 307);
        }
    }
}