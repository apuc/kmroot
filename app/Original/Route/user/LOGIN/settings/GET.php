<?php
namespace Original\Route_user_LOGIN_settings;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Auth\User\Access;
use Kinomania\Original\Controller\UserController;
use Kinomania\Original\Key\User\User;
use Kinomania\Original\Logic\Users\Settings;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends UserController
{
    use TRepository;

    public function index()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $user = (new Access($this->mysql()))->getUser();
                $id = $user->id();
                if ($login != $user->data()) {
                    $id = 0;
                }

                if (0 < $id) {
                    $this->redis = new \Redis();
                    $this->redisStatus = $this->redis->connect('127.0.0.1');

                    $key = 'user:' . $login;
                    if ($this->redisStatus && $this->redis->exists($key)) {
                        $item = unserialize($this->redis->get($key));
                    } else {
                        $item = (new Settings())->get($login);

                        if (!Wrap::$debugEnabled && $this->redisStatus) {
                            $this->redis->set($key, serialize($item), 604800); // 7 days
                        }
                    }

                    if ([] != $item) {
                        /**
                         * Image.
                         */
                        $image = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
                        $image_small = Server::STATIC[0] . '/app/img/content/no-avatar-m.jpg';
                        if ('' != $item[User::IMAGE]) {
                            $imageName = md5($item[User::ID]);
                            $image = Server::STATIC[$item[User::S]] . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[User::IMAGE];
                            $image_raw = Server::STATIC[$item[User::S]] . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[User::IMAGE];
                            $image_small = Server::STATIC[$item[User::S]] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $item[User::IMAGE];
                            $image_small_raw = Server::STATIC[$item[User::S]] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $item[User::IMAGE];
                        } else {
                            $imageName = md5($item[User::ID]);
                            $image_raw = Server::STATIC[$item[User::S]] . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[User::IMAGE];
                            $image_small_raw = Server::STATIC[$item[User::S]] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $item[User::IMAGE];
                        }

                        $authProb = false;
                        if (isset($_COOKIE['__user__'])) {
                            $authProb = true;
                        }

                        $max = date('Y') - 5;

                        $this->addData([
                            'login' => $login,
                            'item' => $item,
                            'image' => $image,
                            'image_raw' => $image_raw,
                            'image_small' => $image_small,
                            'image_small_raw' => $image_small_raw,
                            'stat' => $this->getStat($item[User::ID]),
                            'authProb' => $authProb,
                            'max' => $max,
                            'min' => ($max - 90)
                        ]);
                        $this->setTemplate('user/settings.html.php');
                    }
                }
            }
        }
    }
}