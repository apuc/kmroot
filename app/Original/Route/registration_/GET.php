<?php
namespace Original\Route_registration_;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Auth\User\Registration;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $cookie = new CookieBag();
        if ($cookie->has('__user__')) {
            $this->setRedirect('/', 307);
        } else {
            $this->setTemplate('auth/registration.html.php');
        }
    }

    public function activate()
    {
        $cookie = new CookieBag();
        if ($cookie->has('__user__')) {
            $this->setRedirect('/', 307);
        } else {
            $get = new GetBag();
            $registration = new Registration($this->mysql());

            if ($get->has('h') && $registration->confirmRegistration($get->fetch('h'))) {
                $this->mysql()->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'user' LIMIT 1");
                $this->setTemplate('auth/registration.confirm.html.php');
            } else {
                $this->setTemplate('auth/registration.fail.confirm.html.php');
            }
        }
    }
}