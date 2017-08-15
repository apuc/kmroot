<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;

class Check extends Base
{
    /**
     * Return true if email exist.
     * @return bool
     */
    public function emailExist()
    {
        $this->error = '';
        $exist = false;

        $post = new PostBag();
        if ($post->has('email')) {
            $email = $post->fetch('email');
        } else {
            $get = new GetBag();
            $email = $get->fetch('email');
        }

        $email = $this->clearText($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && 1 < strlen($email) && 256 > strlen($email)) {
            $email = $this->db->real_escape_string($email);
            $result = $this->db->query("SELECT 1 FROM `user` WHERE `email` = '{$email}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $exist = true;
            }
        } else {
            $this->error = self::BAD_EMAIL_INPUT;
        }

        return $exist;
    }

    /**
     * Return true if login exist.
     * @return bool
     */
    public function loginExist()
    {
        $this->error = '';
        $exist = false;

        $post = new PostBag();
        if ($post->has('login')) {
            $login = $post->fetch('login');
        } else {
            $get = new GetBag();
            $login = $get->fetch('login');
        }

        $login = $this->clearText($login);
        if (preg_match("/^[A-Za-z0-9_-]+$/u", $login) && 1 < strlen($login) && 65 > strlen($login)) {
            $login = $this->db->real_escape_string($login);
            $result = $this->db->query("SELECT 1 FROM `user` WHERE `login` = '{$login}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $exist = true;
            }
        } else {
            $this->error = self::BAD_LOGIN_INPUT;
        }

        return $exist;
    }

    const BAD_LOGIN_INPUT = 1;
    const BAD_EMAIL_INPUT = 2;
}