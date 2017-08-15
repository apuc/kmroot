<?php
namespace Kinomania\Original\Auth\User;

use Dspbee\Auth\Token\Token;
use Dspbee\Bundle\Common\Bag\CookieBag;

class Access extends Base
{
    /**
     * @return User
     * @throws \ErrorException
     */
    public function getUser(): User
    {
        $user = new User();
        $user->setStatus(User::ERROR_LOGIN);

        $hash = (new CookieBag())->fetch('__user__');
        $hash = explode('.', $hash);
        $hash = $hash[1] ?? '';
        if (!empty($hash)) {
            $token = new Token($this->db, 'user_token');
            if ($token->verify($hash)) {
                $user->initFromArray(
                    [
                        'id' => $token->userId(),
                        'groupId' => $token->groupId(),
                        'data' => $token->data()
                    ]
                );
                $user->setStatus(User::AUTHORIZED);
            }
        }

        return $user;
    }
}