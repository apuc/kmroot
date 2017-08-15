<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Auth\Token\Token;
use Dspbee\Bundle\Common\Bag\PostBag;

class Registration extends Base
{
    public function __construct(\mysqli $db)
    {
        parent::__construct($db);
        $this->email = '';
        $this->login = '';
    }

    public function register()
    {
        $hash = '';
        $this->error = '';
        $post = new PostBag();

        $email = $post->fetch('email');
        $password = $post->fetch('password');

        /**
         * Email.
         */
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            /**
             * Password.
             */
            if (4 > mb_strlen($password, 'UTF-8')) {
                $this->error = self::EMPTY_PASSWORD;
            } else {
                $check = new Check($this->db);
                if (!$check->emailExist()) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    /**
                     * Login.
                     */
                    if (!$check->loginExist()) {
                        if (Check::BAD_LOGIN_INPUT == $check->error()) {
                            $this->error = self::WRONG_LOGIN;
                        } else {
                            $login = $post->fetchEscape('login', $this->db);
                            $email = $this->db->real_escape_string($email);
                            $password = $this->db->real_escape_string($password);
                            $hash = hash('sha512', mt_rand() . $email . $login . date(DATE_ATOM));
                            $hash = $this->db->real_escape_string($hash);
                            $now = strtotime('now');

                            $this->db->query("INSERT INTO `user` SET
                                                `s` = 0,
                                                `image` = '',
                                                `login` = '{$login}',
                                                `email` = '{$email}',
                                                `password` = '{$password}',
                                                `status` = 'new',
                                                `name` = '',
                                                `surname` = '',
                                                `sex` = '',
                                                `city` = '',
                                                `about` = '',
                                                `interest` = '',
                                                `hash` = UNHEX('{$hash}'),
                                                `hashChange` = FROM_UNIXTIME(0),
                                                `registration` = FROM_UNIXTIME('{$now}'),
                                                `birthday` = null,
                                                `vk` = '',
                                                `fb` = '',
                                                `ok` = '',
                                                `twitter` = '',
                                                `googlePlus` = '',
                                                `liveJournal` = '',
                                                `tg` = '',
                                                `myMail` = '',
                                                `instagram` = '',
                                                `skype` = '',
                                                `icq` = '',
                                                `count_review` = 0,
                                                `count_feedback` = 0,
                                                `count_comment` = 0,
                                                `count_rate` = 0,
                                                `count_film` = 0,
                                                `count_person` = 0,
                                                `count_film_pub` = 0,
                                                `count_person_pub` = 0,
                                                `last` = FROM_UNIXTIME('{$now}')
                                            ");
                            if (!empty($this->db->error)) {
                                $hash = '';
                                $this->error = self::FAIL_ADD_USER;
                            } else {
                                $this->email = $email;
                                $this->login = $login;
                                $id = $this->db->insert_id;
                                $hash .= $id;
                            }
                        }
                    } else {
                        $this->error = self::LOGIN_EXIST;
                    }
                } else {
                    $this->error = self::EMAIL_EXIST;
                }
            }
        } else {
            $this->error = self::WRONG_EMAIL;
        }

        return $hash;
    }

    /**
     * Activate user.
     *
     * @param string $hash
     * @return bool
     * @throws \ErrorException
     */
    public function confirmRegistration($hash)
    {
        if (!empty($hash)) {
            $userId = intval(substr($hash, 128));
            $hash = substr($hash, 0, 128);
            if (0 < $userId && '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000' != $hash) {
                $result = $this->db->query("SELECT `login`, `hash` FROM `user` WHERE `id` = {$userId} LIMIT 1");
                if (!empty($this->db->error)) {
                    throw new \ErrorException($this->db->error);
                }
                if ($row = $result->fetch_assoc()) {
                    if (bin2hex($row['hash']) == $hash) {
                        $login = $row['login'];
                        $this->db->query("UPDATE `user` SET `status` = 'active', `hash` = '' WHERE `id` = {$userId} LIMIT 1");
                        if (!empty($this->db->error)) {
                            throw new \ErrorException($this->db->error);
                        }

                        /**
                         * Create favorite directories for new user.
                         */
                        $result = $this->db->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'film' AND `default` = 'Избранное' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `user_folder` SET `userId` = {$userId}, `type` = 'film', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
                        }

                        $result = $this->db->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'people' AND `default` = 'Избранное' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `user_folder` SET `userId` = {$userId}, `type` = 'people', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
                        }

                        /**
                         * Login.
                         */
                        $token = new Token($this->db, 'user_token');
                        $hash = $token->create($userId, 0);
                        if (!empty($hash)) {
                            if (headers_sent()) {
                                throw new \ErrorException("Can't set cookie, headers already sent.");
                            } else {
                                setcookie('__user__', $login . '.' . $hash, time() + 3600 * 24 * 30, '/');
                            }
                        }

                        return true;
                    }
                }
            }
        }

        return false;
    }
    
    public function email()
    {
        return $this->email;
    }
    
    public function login()
    {
        return $this->login;
    }
    
    protected $email;
    protected $login;

    const WRONG_EMAIL = 1;
    const EMAIL_EXIST = 2;
    const FAIL_ADD_USER = 3;
    const WRONG_LOGIN = 4;
    const LOGIN_EXIST = 5;
    const EMPTY_PASSWORD = 6;
}