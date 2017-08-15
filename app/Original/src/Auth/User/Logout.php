<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Auth\Token\Token;
use Dspbee\Bundle\Common\Bag\CookieBag;

class Logout extends Base
{
    public function quit($hash = '', $setCookie = true)
    {
        if (empty($hash)) {
            $cookie = new CookieBag();
            if ($cookie->has('__user__')) {
                $hash = $cookie->fetch('__user__');
                $hash = explode('.', $hash);
                $hash = $hash[1] ?? '';
            }
        }

        if (!empty($hash)) {
            $token = new Token($this->db, 'user_token');
            $token->delete($hash);
            if ($setCookie) {
                if (!headers_sent()) {
                    setcookie('__user__', '', time() - 3600 * 24 * 30, '/');
                }
            }
            return true;
        }

        return false;
    }
}