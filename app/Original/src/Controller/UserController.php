<?php
namespace Kinomania\Original\Controller;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\User\Stat;
use Kinomania\Original\Key\User\User;
use Kinomania\System\Common\TRepository;

/**
 * Class UserController
 * @package Kinomania\Original\Controller
 */
class UserController extends DefaultController
{
    use TRepository;

    /**
     * @param int $userId
     * @return array
     */
    protected function getStat($userId)
    {
        $item  = [];
        
        $key = 'user:' . $userId;

        if ($this->redisStatus && $this->redis->exists($key . ':stat')) {
            $item = unserialize($this->redis->get($key . ':stat'));
        } else {
            $result = $this->mysql()->query("SELECT `count_review`, `count_feedback`, `count_comment`, `count_rate`, `count_film`, `count_person`, `count_film_pub`, `count_person_pub`
                                             FROM `user` WHERE `id` = {$userId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                foreach ($row as $k => $v) {
                    if (0 == $v) {
                        $row[$k] = '';
                    }
                }
                $item[Stat::REVIEW] = $row['count_review'];
                $item[Stat::FEEDBACK] = $row['count_feedback'];
                $item[Stat::COMMENT] = $row['count_comment'];
                $item[Stat::RATE] = $row['count_rate'];
                $item[Stat::FILM] = $row['count_film'];
                $item[Stat::PERSON] = $row['count_person'];
                $item[Stat::FILM_PUB] = $row['count_film_pub'];
                $item[Stat::PERSON_PUB] = $row['count_person_pub'];

                if (!Wrap::$debugEnabled && $this->redisStatus) {
                    $this->redis->set($key . ':stat', serialize($item), 900); // 15 min
                }
            }
        }

        return $item;
    }

    /**
     * Get user name by login.
     * @param string $login
     * @return array|mixed
     */
    protected function getMin($login)
    {
        $item = [];

        $key = 'user:' . $login . ':min';
        if ($this->redisStatus && $this->redis->exists($key)) {
            $item = unserialize($this->redis->get($key));
        } else {
            $login = $this->mysql()->real_escape_string($login);
            $result = $this->mysql()->query("SELECT `id`, `name`, `surname` FROM `user` WHERE `login` = '{$login}' LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $item[User::ID] = $row['id'];
                $item[User::NAME] = $row['name'];
                $item[User::SURNAME] = $row['surname'];
                
                if (!Wrap::$debugEnabled && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 432000); // 5 days
                }
            }
        }

        return $item;
    }

    /**
     * @var \Redis
     */
    protected $redis;
    /**
     * @var bool
     */
    protected $redisStatus;
}