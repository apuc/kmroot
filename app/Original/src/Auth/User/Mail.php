<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Common\Bag\ServerBag;
use Dspbee\Bundle\Template\Native;
use Kinomania\System\Common\TRepository;

/**
 * Class Mail
 * @package Kinomania\Control\Auth\Mail
 */
class Mail
{
    use TRepository;

    /**
     * Mail constructor.
     * @param string $emailFrom
     * @param string $emailTo
     */
    public function __construct($emailFrom, $emailTo)
    {
        $this->emailFrom = $emailFrom;
        $this->emailTo = $emailTo;
    }

    /**
     * @param $login
     * @param $hash
     * @param $subject
     * @return int
     */
    public function sendConfirm($login, $hash, $subject)
    {
        $template = new Native(dirname(dirname(dirname(__DIR__))), null, false);
        $text = $template->getContent('auth/mail/registration.html.php', ['login' => $login, 'host' => (new ServerBag())->fetch('SERVER_NAME'), 'hash' => $hash]);
        return $this->sendEmail($this->emailFrom, $this->emailTo, $subject, $text);
    }

    /**
     * @param $login
     * @param $hash
     * @param $subject
     * @return int
     */
    public function sendRecover($login, $hash, $subject)
    {
        $template = new Native(dirname(dirname(dirname(__DIR__))), null, false);
        $text = $template->getContent('auth/mail/restore.html.php', ['login' => $login, 'host' => (new ServerBag())->fetch('SERVER_NAME'), 'hash' => $hash]);
        return $this->sendEmail($this->emailFrom, $this->emailTo, $subject, $text);
    }

    protected $emailFrom;
    protected $emailTo;
}