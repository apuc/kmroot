<?php
namespace Original\Route_user_LOGIN_ratings;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\UserController;
use Kinomania\Original\Key\User\User;
use Kinomania\Original\Logic\Users\Ratings;
use Kinomania\System\Common\TRepository;

/**
 * Class AJAX
 * @package Original\Route_user_LOGIN_settings
 */
class AJAX extends UserController
{
    use TRepository;

    public function more()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $min = $this->getMin($login);

                if (0 < $min[User::ID]) {
                    $list = [];

                    $get = new GetBag();
                    $page = $get->fetchInt('page');
                    if (1 < $page) {
                        $key = 'user:' . $login . ':rate:';
                        $redis = null;
                        $redisStatus = false;
                        if (4 > $page) {
                            $redis = new \Redis();
                            $redisStatus = $redis->connect('127.0.0.1');
                            $key .= $page;
                        }

                        if (4 > $page && $redisStatus && $redis->exists($key)) {
                            $list = unserialize($redis->get($key));
                        } else {
                            $list = (new Ratings())->getList($min[User::ID], $page);

                            if (4 > $page && !Wrap::$debugEnabled && $redisStatus) {
                                $redis->set($key, serialize($list), 65); // ~1min
                            }
                        }
                    }

                    $this->setContent(json_encode($list));
                }
            }
        }
    }
}