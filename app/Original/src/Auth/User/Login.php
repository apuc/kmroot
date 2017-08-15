<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Auth\Token\Token;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Common\TTextTransform;

class Login extends Base
{
    use TTextTransform;

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function enter()
    {
        $this->error = self::WRONG_LOGIN_OR_PASSWORD;
        
        $post = new PostBag();
        $login = $post->fetch('login');
        $password = $post->fetch('password');

        if (!empty($login) && !empty($password)) {
            $login = $this->clearText($login);
            if (preg_match("/^[A-Za-z0-9_-]+$/u", $login) && 1 < strlen($login) && 65 > strlen($login)) {
                $result = $this->db->query("SELECT `id`, `password`, `status` FROM `user` WHERE `login` = '{$login}' LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row['password'])) {
                        if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $this->db->query("UPDATE `user` SET `password` = '{$hash}' WHERE `id` = {$row['id']} LIMIT 1");
                            if (!empty($this->db->error)) {
                                throw new \ErrorException($this->db->error);
                            }
                        }

                        switch ($row['status']) {
                            case 'new':
                                $this->error = self::NOT_ACTIVE;
                                break;
                            case 'banned':
                                $this->error = self::BANNED;
                                break;
                            default:
                                $token = new Token($this->db, 'user_token');
                                $hash = $token->create($row['id'], 0, $login);
                                if (!empty($hash)) {
                                    if (headers_sent()) {
                                        throw new \ErrorException("Can't set cookie, headers already sent.");
                                    } else {
                                        setcookie('__user__', $login . '.' . $hash, time() + 3600 * 24 * 30, '/');
                                    }
                                    $this->error = '';
                                    return true;
                                }
                        }
                    }
                }
            } else {
                $this->error = self::WRONG_LOGIN;
            }
        } else {
            $this->error = self::EMPTY_LOGIN_OR_PASSWORD;
        }

        return false;
    }

    const EMPTY_LOGIN_OR_PASSWORD = '1';
    const WRONG_LOGIN_OR_PASSWORD = '2';
    const WRONG_LOGIN = '3';
    const NOT_ACTIVE = '4';
    const BANNED = '5';
}