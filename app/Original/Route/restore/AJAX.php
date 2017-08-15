<?php
namespace Original\Route_restore;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Auth\User\Check;
use Kinomania\Original\Auth\User\Mail;
use Kinomania\Original\Auth\User\Restore;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Controller\DefaultController;

class AJAX extends DefaultController
{
    use TRepository;

    /**
     * Send recover email.
     */
    public function recover()
    {
        $data = [];
        $data['error'] = '';
        $restore = new Restore($this->mysql());
        $hash = $restore->getHash();

        if (!empty($restore->error())) {
            $data['error'] = $restore->error();
            switch ($restore->error()) {
                case Restore::USER_BAD_STATUS:
                    $data['error'] = 'USER_BAD_STATUS';
                    break;
                case Restore::PENDING_TIME:
                    $data['error'] = 'PENDING_TIME';
                    break;
                default:
                    $data['error'] = 'ERROR';
            }
        } else {
            if (!(new Mail('noreply@kinomania.ru', (new PostBag())->fetch('email')))->sendRecover($restore->login(), $hash, 'KINOMANIA: восстановление пароля')) {
                $data['error'] = 'CANT_SEND_EMAIL';
            } else {
                $host = explode('@', (new PostBag())->fetch('email'));
                $data['host'] = $host[1];
            }
        }
        
        $this->setContent(json_encode($data));
    }

    /**
     * Set new password.
     */
    public function reset()
    {
        $restore = (new Restore($this->mysql()));
        $data['error'] = '';
        if (!$restore->changePassword()) {
            $data['error'] = 'FAIL';
        }
        $this->setContent(json_encode($data));
    }
    
    public function checkEmail()
    {
        $cookie = new CookieBag();
        if (!$cookie->has('__user__')) {
            $check = new Check($this->mysql());
            if (!$check->emailExist()) {
                $this->setContent('false');
            } else {
                $this->setContent('true');
            }
        }
    }
}