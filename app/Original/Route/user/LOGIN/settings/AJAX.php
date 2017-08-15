<?php
namespace Original\Route_user_LOGIN_settings;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Server\StaticS;
use Kinomania\Original\Auth\User\Access;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Users\Settings;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Server;
use Kinomania\System\Social\Filter;
use Kinomania\System\Text\TText;

/**
 * Class AJAX
 * @package Original\Route_user_LOGIN_settings
 */
class AJAX extends DefaultController
{
    use TRepository;
    use TText;

    public function editData()
    {
        $data = (new Settings())->editData();
        $this->setContent(json_encode($data));
    }

    public function editMain()
    {
        $data = (new Settings())->editMain();
        $this->setContent(json_encode($data));
    }

    /**
     * Check free login.
     */
    public function checkLogin()
    {
        $ret = (new Settings())->checkLogin();
        $this->setContent($ret);
    }

    /**
     * Check free email.
     */
    public function checkEmail()
    {
        $ret = (new Settings())->checkEmail();
        $this->setContent($ret);
    }

    /**
     * Check user password.
     */
    public function checkPassword()
    {
        $ret = (new Settings())->checkPassword();
        $this->setContent($ret);
    }

    /**
     * Set new user avatar.
     */
    public function avatar()
    {
        $user = (new Access($this->mysql()))->getUser();
        if (0 < $user->id()) {
            $data = (new Settings())->avatar($user->id(), $user->data());
            $this->setContent(json_encode($data));
        }
    }
}