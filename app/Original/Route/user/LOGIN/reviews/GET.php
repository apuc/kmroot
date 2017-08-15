<?php
namespace Original\Route_user_LOGIN_reviews;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\UserController;
use Kinomania\Original\Key\User\User;
use Kinomania\Original\Logic\Users\Reviews;
use Kinomania\System\Common\TRepository;

class GET extends UserController
{
    use TRepository;

    public function index()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $authProb = false;
                if (isset($_COOKIE['__user__'])) {
                    $authProb = true;
                }

                $min = $this->getMin($login);

                if (0 < $min[User::ID]) {
                    $this->redis = new \Redis();
                    $this->redisStatus = $this->redis->connect('127.0.0.1');

                    $key = 'user:' . $login . ':review';
                    if ($this->redisStatus && $this->redis->exists($key)) {
                        $list = unserialize($this->redis->get($key));
                    } else {
                        $list = (new Reviews())->getList($min[User::ID]);


                        if ([] != $list) {
                            if (!Wrap::$debugEnabled && $this->redisStatus) {
                                $this->redis->set($key, serialize($list), 66); // 1.1 min
                            }
                        }
                    }

                    if ([] != $list) {
                        $this->addData([
                            'login' => $login,
                            'min' => $this->getMin($login),
                            'stat' => $this->getStat($min[User::ID]),
                            'authProb' => $authProb,
                            'list' => $list
                        ]);
                        $this->setTemplate('user/review.html.php');
                    }
                }
            }
        }
    }
}