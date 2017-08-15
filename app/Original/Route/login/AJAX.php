<?php
namespace Original\Route_login;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Kinomania\Original\Auth\User\Check;
use Kinomania\Original\Auth\User\Login;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Controller\DefaultController;

class AJAX extends DefaultController
{
    use TRepository;

    public function login()
    {
        $data = [];
        $data['error'] = '';

        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $login = new Login($this->mysql());
            if (!$login->enter() || !empty($login->error())) {
                $data['error'] = $login->error();
                switch ($login->error()) {
                    case Login::NOT_ACTIVE:
                        $data['error'] = 'NOT_ACTIVE';
                        break;
                    case Login::BANNED:
                        $data['error'] = 'BANNED';
                        break;
                    default:
                        $data['error'] = 'ERROR';
                }
            }
        }
        
        $this->setContent(json_encode($data));
    }
    
    public function checkLogin()
    {
        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $check = new Check($this->mysql());
            if (!$check->loginExist()) {
                $this->setContent('false');
            } else {
                $this->setContent('true');
            }
        }
    }
}