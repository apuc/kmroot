<?php
namespace Original\Route_user_LOGIN_people;

use Kinomania\Original\Controller\UserController;
use Kinomania\Original\Key\User\User;
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
                $min = $this->getMin($login);
                $id = $min[User::ID];

                if (0 < $id) {
                    $authProb = false;
                    if (isset($_COOKIE['__user__'])) {
                        $authProb = true;
                    }

                    $this->addData([
                        'login' => $login,
                        'stat' => $this->getStat($id),
                        'authProb' => $authProb
                    ]);
                    $this->setTemplate('user/person.html.php');
                }
            }
        }
    }
}