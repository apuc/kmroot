<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\Control\Server\StaticS;
use Kinomania\Original\Key\User\User;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Social\Filter;
use Kinomania\System\Text\TText;
use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Auth\User\Access;
use Kinomania\System\Config\Server;

/**
 * Class Settings
 * @package Kinomania\Original\Users
 */
class Settings
{
    use TRepository;
    use TDate;
    use TText;

    public function get($login)
    {
        $this->item = [];
        
        $login = $this->mysql()->real_escape_string($login);

        $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `email`, `status`, `name`, `surname`, `sex`, `city`,
                                                      `about`, `interest`, `registration`, `birthday`, `vk`, `fb`, `ok`, `twitter`, `googlePlus`,
                                                      `liveJournal`, `tg`, `myMail`, `instagram`, `skype`, `icq`
                                                     FROM `user` WHERE `login` = '{$login}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('active' == $row['status']) {
                $this->item[User::ID] = $row['id'];
                $this->item[User::S] = $row['s'];
                $this->item[User::IMAGE] = $row['image'];
                $this->item[User::EMAIL] = $row['email'];
                $this->item[User::NAME] = $row['name'];
                $this->item[User::SURNAME] = $row['surname'];
                $this->item[User::SEX] = $row['sex'];
                $this->item[User::CITY] = $row['city'];
                $this->item[User::ABOUT] = $row['about'];
                $this->item[User::INTEREST] = $row['interest'];
                $this->item[User::BIRTHDAY] = $row['birthday'];
                $this->item[User::VK] = $row['vk'];
                $this->item[User::FB] = $row['fb'];
                $this->item[User::OK] = $row['ok'];
                $this->item[User::TWITTER] = $row['twitter'];
                $this->item[User::GOOGLE_PLUS] = $row['googlePlus'];
                $this->item[User::LIVE_JOURNAL] = $row['liveJournal'];
                $this->item[User::TG] = $row['tg'];
                $this->item[User::MY_MAIL] = $row['myMail'];
                $this->item[User::INSTAGRAM] = $row['instagram'];
                $this->item[User::SKYPE] = $row['skype'];
                $this->item[User::ICQ] = $row['icq'];
                $this->item[User::REGISTRATION] = $row['registration'];

                $date = explode('-', $row['birthday']);
                $this->item[User::DAY] = $date[2] ?? '';
                $this->item[User::MONTH] = $date[1] ?? '';
                $this->item[User::YEAR] = $date[0] ?? '';

                /**
                 * Date proceed.
                 */
                $this->birthday();
                $this->registration();

                $this->item[User::IS_SOCIAL] = false;
                if (!empty($this->item[User::VK]) || !empty($this->item[User::FB]) || !empty($this->item[User::OK]) || !empty($this->item[User::TWITTER]) || !empty($this->item[User::GOOGLE_PLUS]) || !empty($this->item[User::LIVE_JOURNAL]) || !empty($this->item[User::TG]) || !empty($this->item[User::MY_MAIL]) || !empty($this->item[User::SKYPE]) || !empty($this->item[User::ICQ]) || !empty($this->item[User::INSTAGRAM])) {
                    $this->item[User::IS_SOCIAL] = true;
                }
            }
        }

        return $this->item;
    }

    public function editData()
    {
        $data['error'] = '';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $filter = new Filter();

                $name = $this->clearText($post->fetch('name'));
                $surname = $this->clearText($post->fetch('surname'));
                $sex = '';
                if ('male' == $post->fetch('sex')) {
                    $sex = 'male';
                } else if ('female' == $post->fetch('sex')) {
                    $sex = 'female';
                }

                $birthday = 'null';
                $day = $post->fetchInt('day');
                $month = $post->fetchInt('month');
                $year = $post->fetchInt('year');
                if (checkdate($month, $day, $year)) {
                    $birthday = "'{$year}-{$month}-{$day}'";
                }

                $city = $this->clearText($post->fetch('city'));
                $about = $this->clearText($post->fetch('about'));
                $interest = $this->clearText($post->fetch('interest'));

                $vk = $this->clearText($post->fetch('vk'));
                $fb = $this->clearText($post->fetch('fb'));
                $ok = $this->clearText($post->fetch('ok'));
                $twitter = $this->clearText($post->fetch('twitter'));
                $googlePlus = $this->clearText($post->fetch('google_plus'));
                $liveJournal = $this->clearText($post->fetch('live_journal'));
                $tg = $this->clearText($post->fetch('tg'));
                $myMail = $this->clearText($post->fetch('my_mail'));
                $instagram = $this->clearText($post->fetch('instagram'));
                $skype = $this->clearText($post->fetch('skype'));
                $icq = $this->clearText($post->fetch('icq'));

                $vk = $filter->vk($vk);
                $fb = $filter->fb($fb);
                $ok = $filter->ok($ok);
                $twitter = $filter->tw($twitter);
                $googlePlus = $filter->gp($googlePlus);
                $liveJournal = $filter->lj($liveJournal);
                $instagram = $filter->instagram($instagram);

                $name = $this->mysql()->real_escape_string($name);
                $surname = $this->mysql()->real_escape_string($surname);
                $city = $this->mysql()->real_escape_string($city);
                $about = $this->mysql()->real_escape_string($about);
                $interest = $this->mysql()->real_escape_string($interest);
                $vk = $this->mysql()->real_escape_string($vk);
                $fb = $this->mysql()->real_escape_string($fb);
                $ok = $this->mysql()->real_escape_string($ok);
                $twitter = $this->mysql()->real_escape_string($twitter);
                $googlePlus = $this->mysql()->real_escape_string($googlePlus);
                $liveJournal = $this->mysql()->real_escape_string($liveJournal);
                $tg = $this->mysql()->real_escape_string($tg);
                $myMail = $this->mysql()->real_escape_string($myMail);
                $skype = $this->mysql()->real_escape_string($skype);
                $icq = $this->mysql()->real_escape_string($icq);

                $this->mysql()->query("UPDATE `user` SET 
                                        `name` = '{$name}',
                                        `surname` = '{$surname}',
                                        `sex` = '{$sex}',
                                        `city` = '{$city}',
                                        `about` = '{$about}',
                                        `interest` = '{$interest}',
                                        `birthday` = {$birthday},
                                        `vk` = '{$vk}',
                                        `fb` = '{$fb}',
                                        `ok` = '{$ok}',
                                        `twitter` = '{$twitter}',
                                        `googlePlus` = '{$googlePlus}',
                                        `liveJournal` = '{$liveJournal}',
                                        `tg` = '{$tg}',
                                        `myMail` = '{$myMail}',
                                        `instagram` = '{$instagram}',
                                        `skype` = '{$skype}',
                                        `icq` = '{$icq}'
                                        WHERE `id` = {$user->id()} LIMIT 1");
                if (!empty($this->mysql()->error)) {
                    $data['error'] = '1';
                } else {
                    $redis = new \Redis();
                    $redisStatus = $redis->connect('127.0.0.1');
                    if ($redisStatus) {
                        $redis->delete('user:' . $user->data());
                        $redis->delete('user:' . $user->data() . ':min');
                    }
                }
            }
        }

        return $data;
    }

    public function editMain()
    {
        $data['error'] = '1';
        $data['login'] = '';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                /**
                 * Login.
                 */
                $login = $post->fetch('login');
                $login = $this->clearText($login);
                if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                    $login = $this->mysql()->real_escape_string($login);
                    $result = $this->mysql()->query("SELECT 1 FROM `user` WHERE `login` = '{$login}' AND `id` != {$user->id()} LIMIT 1");
                    if (0 == $result->num_rows) {
                        $data['login'] = $login;
                        /**
                         * Email.
                         */
                        $email = $post->fetch('email');
                        $email = $this->clearText($email);
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $email = $this->mysql()->real_escape_string($email);
                            $result = $this->mysql()->query("SELECT 1 FROM `user` WHERE `email` = '{$email}' AND `id` != {$user->id()} LIMIT 1");
                            if (0 == $result->num_rows) {
                                $password = $post->fetch('password');
                                if (3 < mb_strlen($password, 'UTF-8')) {
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $password = $this->mysql()->real_escape_string($password);
                                    $this->mysql()->query("UPDATE `user` SET `login` = '{$login}', `email` = '{$email}', `password` = '{$password}' WHERE `id` = {$user->id()} LIMIT 1");
                                } else {
                                    $this->mysql()->query("UPDATE `user` SET `login` = '{$login}', `email` = '{$email}' WHERE `id` = {$user->id()} LIMIT 1");
                                }
                                if (empty($this->mysql()->error)) {
                                    $data['error'] = '';

                                    $redis = new \Redis();
                                    $redisStatus = $redis->connect('127.0.0.1');
                                    if ($redisStatus) {
                                        $redis->delete('user:' . $user->data());
                                        $redis->delete('user:' . $user->data() . ':min');
                                    }
                                }
                            } else {
                                $data['error'] = 'EMAIL_EXIST';
                            }
                        } else {
                            $data['error'] = 'WRONG_EMAIL';
                        }
                    } else {
                        $data['error'] = 'LOGIN_EXIST';
                    }
                } else {
                    $data['error'] = 'WRONG_LOGIN';
                }
            }
        }

        return $data;
    }
    
    public function checkLogin()
    {
        $ret = 'false';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $get = new GetBag();
                $login = $get->fetchEscape('login', $this->mysql());
                $result = $this->mysql()->query("SELECT 1 FROM `user` WHERE `login` = '{$login}' AND `id` != {$user->id()} LIMIT 1");
                if (0 == $result->num_rows) {
                    $ret = 'true';
                }
            }
        }

        return $ret;
    }
    
    public function checkEmail()
    {
        $ret = 'false';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $get = new GetBag();
                $email = $get->fetchEscape('email', $this->mysql());
                $result = $this->mysql()->query("SELECT 1 FROM `user` WHERE `email` = '{$email}' AND `id` != {$user->id()} LIMIT 1");
                if (0 == $result->num_rows) {
                    $ret = 'true';
                }
            }
        }

        return $ret;
    }
    
    public function checkPassword()
    {
        $ret = 'false';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $get = new GetBag();
                $password = $get->fetch('current_password');
                $result = $this->mysql()->query("SELECT `password` FROM `user` WHERE `id` = {$user->id()} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if (empty($row['password'])) {
                        $ret = 'true';
                    } else {
                        if (password_verify($password, $row['password'])) {
                            $ret = 'true';
                        }
                    }
                }
            }
        }

        return $ret;
    }


    public function avatar($userId, $login)
    {
        $userId = intval($userId);
        
        $static = new StaticS();
        $data = json_decode($static->avatar($userId), true);

        if (isset($data['ex'])) {
            switch ($data['ex']) {
                case 'png':
                case 'jpeg':
                case 'gif':
                    break;
                default:
                    $data['ex'] = '';
            }
            if (!empty($data['ex'])) {
                $s = intval(Server::STATIC_CURRENT);
                $this->mysql()->query("UPDATE `user` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$userId} LIMIT 1");

                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus) {
                    $redis->delete('user:' . $login);
                }
            }
        }

        return $data;
    }
    
    /**
     * Birthday data.
     */
    private function birthday()
    {
        if (!empty($this->item[User::BIRTHDAY])) {
            $year = date_diff(date_create($this->item[User::BIRTHDAY]), date_create('today'))->y;
            $this->item[User::BIRTHDAY] = $this->formatDate($this->item[User::BIRTHDAY]);
            if (0 < $year) {
                $num = $year % 100;
                if ($num > 19) {
                    $num = $num % 10;
                }
                switch ($num) {
                    case 1:
                        $year .= ' год';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $year .= ' года';
                        break;
                    default:
                        $year .= ' лет';
                }

                if (!empty($year)) {
                    $this->item[User::BIRTHDAY] .= ' (' . $year . ')';
                }
            }
        }
    }

    /**
     * Registration data.
     */
    private function registration()
    {
        if (!empty($this->item[User::REGISTRATION])) {
            $this->item[User::REGISTRATION] = $this->formatDate($this->item[User::REGISTRATION]);
        }
    }

    private $item;

}