<?php
namespace Original\Route_user_LOGIN;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\UserController;
use Kinomania\Original\Key\User\User;
use Kinomania\Original\Logic\Users\Users;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends UserController
{
    public function index()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {

                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'user:' . $login;
                if ($this->redisStatus && $this->redis->exists($key)) {
                    $item = unserialize($this->redis->get($key));
                } else {
                    $item = (new Users())->get($login);

                    if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                        $this->redis->set($key, serialize($item), 604800); // 7 days

                        $min[User::ID] = $item[User::ID];
                        $min[User::NAME] = $item[User::NAME];
                        $min[User::SURNAME] = $item[User::SURNAME];
                        $this->redis->set($key . ':min', serialize($min), 604800); // 7 days
                    }
                }


                if ([] != $item) {
                    /**
                     * Image.
                     */
                    if ('' != $item[User::IMAGE]) {
                        $imageName = md5($item[User::ID]);
                        $item[User::IMAGE] = Server::STATIC[$item[User::S]] . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[User::IMAGE];
                    } else {
                        $item[User::IMAGE] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
                    }

                    $authProb = false;
                    if (isset($_COOKIE['__user__'])) {
                        $authProb = true;
                    }

                    $this->addData([
                        'login' => $login,
                        'item' => $item,
                        'stat' => $this->getStat($item[User::ID]),
                        'authProb' => $authProb
                    ]);
                    $this->setTemplate('user/index.html.php');
                }
            }
        }
    }
}