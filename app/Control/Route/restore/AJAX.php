<?php
namespace Control\Route_restore;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Auth\Auth;
use Kinomania\Control\Auth\Mail;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Email;
use Kinomania\System\Controller\DefaultController;

/**
 * Class AJAX
 * @package Control\Route_restore
 */
class AJAX extends DefaultController
{
    use TRepository;

    /**
     * Send recover email.
     */
    public function recover()
    {
        $restore = (new Auth($this->mysql()))->restore();
        $hash = $restore->getHash();
        $data['error'] = $restore->error();
        if (empty($restore->error())) {
            if (!(new Mail(Email::NOREPLY, (new GetBag())->fetch('email')))->sendRecover($hash, 'Запрос на восстановление пароля')) {
                $data['error'] = 'CANT_SEND_EMAIL';
            }
        }
        $this->setContent(json_encode($data));
    }

    /**
     * Set new password.
     */
    public function reset()
    {
        $hash = (new GetBag())->fetch('h');
        $restore = (new Auth($this->mysql()))->restore();
        $data['error'] = '';
        if (!$restore->changePassword($hash, (new PostBag())->fetch('password'))) {
            $data['error'] = 'FAIL';
        }
        $this->setContent(json_encode($data));
    }
}