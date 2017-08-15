<?php
namespace Control\Route_login;

use Dspbee\Auth\Bundle\LoginInput;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Auth\Auth;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Controller\DefaultController;

/**
 * Class AJAX
 * @package Control\Route_login
 */
class AJAX extends DefaultController
{
    use TRepository;

    /**
     * Authorize.
     */
    public function login()
    {
        $post = new PostBag();

        $input = new LoginInput($this->mysql());
        $input->setEmail($post->fetch('email'));
        $input->setPassword($post->fetch('password'));

        $login = (new Auth($this->mysql()))->login();
        if ($login->enter($input)) {
            $data['redirect'] = $this->request->makeUrl('');
        }
        $data['error'] = $login->error();

        $this->setContent(json_encode($data));
    }

    /**
     * Check user exist.
     */
    public function checkEmail()
    {
        //if ((new Auth($this->mysql()))->check()->isRegistered()) {
        //    $this->setContent('true');
        //} else {
        //    $this->setContent('false');
        //}
        $this->setContent('true');
    }
}