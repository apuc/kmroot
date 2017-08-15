<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Auth\Token\Token;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Common\TTextTransform;

class Restore extends Base
{
    const PENDING_TIME_IN_SEC = 43200; // 12 hours

    /**
     * @param string $email
     * @return string
     */
    public function getHash($email = '')
    {
        $this->error = '';
        if (empty($email)) {
            $post = new PostBag();
            $email = $post->fetchEscape('email', $this->db);
        } else {
            $email = $this->db->real_escape_string($email);
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = $this->db->query("SELECT `id`, `login`, `status`, `hashChange` FROM `user` WHERE `email` = '{$email}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if ('new' == $row['status'] || 'banned' == $row['status']) {
                    $this->error = self::USER_BAD_STATUS;
                } else {
                    $now = strtotime('now');
                    $last = strtotime($row['hashChange']);

                    /**
                     * Once at PENDING_TIME
                     */
                    if (self::PENDING_TIME_IN_SEC < $now - $last) {
                        $hash = hash('sha512', mt_rand() . $email . date(DATE_ATOM));
                        $this->login = $row['login'];
                        $this->db->query("UPDATE `user` SET `hash` = UNHEX('{$hash}'), `hashChange` = FROM_UNIXTIME('{$now}') WHERE `id` = {$row['id']} LIMIT 1");
                        return $hash . $row['id'];
                    } else {
                        $this->error = self::PENDING_TIME;
                    }
                }
            } else {
                $this->error = self::EMAIL_NOT_FOUND;
            }
        } else {
            $this->error = self::WRONG_EMAIL;
        }

        return '';
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function validateHash($hash)
    {
        $id = intval(substr($hash, 128));
        $hash = substr($hash, 0, 128);
        if (0 < $id && '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000' != $hash) {
            $result = $this->db->query("SELECT `hash` FROM `user` WHERE `id` = {$id} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if (bin2hex($row['hash']) == $hash) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     * @throws \ErrorException
     * @throws \HttpHeaderException
     */
    public function changePassword()
    {
        $post = new PostBag();
        $hash = $post->fetch('h');
        $password = $post->fetch('password');

        $id = intval(substr($hash, 128));
        $hash = substr($hash, 0, 128);

        if (0 < $id && '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000' != $hash) {
            $result = $this->db->query("SELECT `login`, `status`, `hash` FROM `user` WHERE `id` = {$id} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if ('new' == $row['status'] || 'banned' == $row['status']) {
                    $this->error = self::USER_BAD_STATUS;
                } else {
                    if (bin2hex($row['hash']) == $hash) {
                        if (!empty($password)) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $this->db->query("UPDATE `user` SET `password` = '{$password}', `hash` = '' WHERE `id` = {$id} LIMIT 1");

                            $token = new Token($this->db, 'user_token');
                            $hash = $token->create($id, 0);
                            if (!empty($hash)) {
                                if (headers_sent()) {
                                    throw new \HttpHeaderException("Can't set cookie, headers already sent.");
                                } else {
                                    setcookie('__user__', $row['login'] . '.' . $hash, time() + 3600 * 24 * 30, '/');
                                }
                                return true;
                            }
                        }
                    }
                }
            }
        }

        return false;
    }
    
    public function login()
    {
        return $this->login;
    }
    
    private $login;

    const WRONG_EMAIL = 1;
    const EMAIL_NOT_FOUND = 2;
    const PENDING_TIME = 3;
    const USER_BAD_STATUS = 4;
}