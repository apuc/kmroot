<?php
namespace Original\Route_social_login_ok;

use Dspbee\Auth\Token\Token;
use Kinomania\Original\Auth\Social\Ok;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;
    
    public function index()
    {
        $ok = new Ok();
        $userInfo = $ok->authorize();
        if (!$ok->error()) {
            $now = strtotime('now');

            $login = $this->mysql()->real_escape_string($userInfo['uid'] ?? '');
            $email = $this->mysql()->real_escape_string($userInfo['email'] ?? '');

            if (!empty($login) && !empty($email)) {
                $name = $userInfo['name'] ?? '';
                $name = $this->mysql()->real_escape_string($name);
                
                $this->mysql()->query("INSERT INTO `user` SET
                                                `s` = 0,
                                                `image` = '',
                                                `login` = '{$login}',
                                                `email` = '{$email}',
                                                `password` = '',
                                                `status` = 'active',
                                                `name` = '{$name}',
                                                `surname` = '',
                                                `sex` = '',
                                                `city` = '',
                                                `about` = '',
                                                `interest` = '',
                                                `hash` = UNHEX('00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000'),
                                                `hashChange` = FROM_UNIXTIME(0),
                                                `registration` = FROM_UNIXTIME('{$now}'),
                                                `birthday` = null,
                                                `vk` = '',
                                                `fb` = '',
                                                `ok` = '{$login}',
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
                $userId = $this->mysql()->insert_id;
                if (0 < $userId) {
                    /**
                     * Create favorite directories for new user.
                     */
                    $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'film' AND `default` = 'Избранное' LIMIT 1");
                    if (!$row = $result->fetch_assoc()) {
                        $this->mysql()->query("INSERT INTO `user_folder` SET `userId` = {$userId}, `type` = 'film', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
                    }

                    $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'people' AND `default` = 'Избранное' LIMIT 1");
                    if (!$row = $result->fetch_assoc()) {
                        $this->mysql()->query("INSERT INTO `user_folder` SET `userId` = {$userId}, `type` = 'people', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
                    }

                    /**
                     * Login.
                     */
                    $token = new Token($this->mysql(), 'user_token');
                    $hash = $token->create($userId, 0);
                    if (!empty($hash)) {
                        if (headers_sent()) {
                            throw new \ErrorException("Can't set cookie, headers already sent.");
                        } else {
                            setcookie('__user__', $login . '.' . $hash, time() + 3600 * 24 * 30, '/');
                        }
                    }
                    $this->setRedirect('http://demo.km/user/' . $login);
                } else {
                    $this->setTemplate('auth/soc.fail.confirm.html.php');
                }
            } else {
                $this->setTemplate('auth/soc.fail.confirm.html.php');
            }
        } else {
            $this->setTemplate('auth/soc.fail.confirm.html.php');
        }
    }
}