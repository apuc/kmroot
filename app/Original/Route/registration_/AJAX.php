<?php
namespace Original\Route_registration_;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Kinomania\Original\Auth\User\Check;
use Kinomania\Original\Auth\User\Mail;
use Kinomania\Original\Auth\User\Registration;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Email;
use Kinomania\System\Controller\DefaultController;

class AJAX extends DefaultController
{
    use TRepository;

    public function register()
    {
        $data = [];
        $data['error'] = '';

        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $registration = new Registration($this->mysql());
            $hash = $registration->register();
            if (!empty($registration->error())) {
                $data['error'] = $registration->error();
                switch ($registration->error()) {
                    case Registration::EMAIL_EXIST:
                        $data['error'] = 'EMAIL_EXIST';
                        break;
                    case Registration::WRONG_EMAIL:
                        $data['error'] = 'WRONG_EMAIL';
                        break;
                    case Registration::LOGIN_EXIST:
                        $data['error'] = 'LOGIN_EXIST';
                        break;
                    case Registration::WRONG_LOGIN:
                        $data['error'] = 'WRONG_LOGIN';
                        break;
                    case Registration::EMPTY_PASSWORD:
                        $data['error'] = 'EMPTY_PASSWORD';
                        break;
                    default:
                        $data['error'] = 'ERROR';
                }
            } else {
                $mail = new Mail(Email::NOREPLY, $registration->email());
                if ($mail->sendConfirm($registration->login(), $hash, 'KINOMANIA: подтверждение регистрации')) {
                    $host = explode('@', $registration->email());
                    $data['host'] = $host[1];
                } else {
                    $data['error'] = 'ERROR_SEND_MAIL';
                }
            }
        }
        
        $this->setContent(json_encode($data));
    }

    public function checkEmail()
    {
        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $check = new Check($this->mysql());
            if ($check->emailExist()) {
                $this->setContent('false');
            } else {
                $this->setContent('true');
            }
        }
    } 
    
    public function checkLogin()
    {
        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $check = new Check($this->mysql());
            if ($check->loginExist()) {
                $this->setContent('false');
            } else {
                $this->setContent('true');
            }
        }
    }
}