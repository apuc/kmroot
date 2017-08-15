<?php
namespace Kinomania\Control\Auth;

use Dspbee\Bundle\Common\Bag\ServerBag;
use Dspbee\Bundle\Template\Native;
use Kinomania\System\Common\TRepository;

/**
 * Class Mail
 * @package Kinomania\Control\Auth\Mail
 */
class Mail extends \Dspbee\Auth\Mail
{
    use TRepository;

    /**
     * @param $hash
     * @param $subject
     * @return int
     */
    public function sendConfirm($hash, $subject)
    {
        return null;
    }

    /**
     * @param $hash
     * @param $subject
     * @return int
     */
    public function sendRecover($hash, $subject)
    {
        $template = new Native(dirname(dirname(__DIR__)), null, false);
        $text = $template->getContent('admin/auth/mail/restore.html.php', ['host' => (new ServerBag())->fetch('SERVER_NAME'), 'hash' => $hash]);
        return $this->sendEmail($this->emailFrom, $this->emailTo, $subject, $text);
    }
}