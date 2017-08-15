<?php
namespace Original\Route_user_LOGIN;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Key\User\User;
use Kinomania\Original\Logic\Users\Users;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\Original\Auth\User\Access;

class AJAX extends DefaultController
{
    use TRepository;

    /**
     * Create new person feedback.
     */
    public function addFeedback()
    {
        $error = (new Users())->addFeedback();
        $this->setContent($error);
    }

    /**
     * Add vote to review.
     */
    public function voteFeedback()
    {
        $vote = (new Users())->voteFeedback();;
        $this->setContent($vote);
    }

    /**
     * Create new film review.
     */
    public function addReview()
    {
        $error = (new Users())->addReview();
        $this->setContent($error);
    }

    /**
     * Add vote to review.
     */
    public function voteReview()
    {
        $vote = (new Users())->voteReview();;
        $this->setContent($vote);
    }

    /**
     * Get last user blog pages.
     */
    public function getBlog()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $userId = 0;

                $key = 'user:' . $login;
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists($key)) {
                    $userId = unserialize($redis->get($key));
                    $userId = $userId[User::ID];
                } else {
                    $login = $this->mysql()->real_escape_string($login);
                    $result = $this->mysql()->query("SELECT `id` FROM `user` WHERE `login` = '{$login}' LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $userId = $row['id'];
                    }
                }

                if (0 < $userId) {
                    $list = (new Users())->getBlog($userId);
                    
                    $this->setContent(json_encode($list));
                }
            }
        }
    }

    /**
     * Get last user ratings.
     */
    public function getVote()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $userId = 0;

                $key = 'user:' . $login;
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists($key)) {
                    $userId = unserialize($redis->get($key));
                    $userId = $userId[User::ID];
                } else {
                    $login = $this->mysql()->real_escape_string($login);
                    $result = $this->mysql()->query("SELECT `id` FROM `user` WHERE `login` = '{$login}' LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $userId = $row['id'];
                    }
                }

                if (0 < $userId) {
                    $list = (new Users())->getVote($userId);

                    $this->setContent(json_encode($list));
                }
            }
        }
    }

    /**
     * Get last user comment's.
     */
    public function getComment()
    {
        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $this->request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $userId = 0;

                $key = 'user:' . $login;
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists($key)) {
                    $userId = unserialize($redis->get($key));
                    $userId = $userId[User::ID];
                } else {
                    $login = $this->mysql()->real_escape_string($login);
                    $result = $this->mysql()->query("SELECT `id` FROM `user` WHERE `login` = '{$login}' LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $userId = $row['id'];
                    }
                }

                if (0 < $userId) {
                    $list = (new Users())->getComment($userId);

                    $this->setContent(json_encode($list));
                }
            }
        }
    }

    /**
     * Create new comment.
     */
    public function addComment()
    {
        $error = (new Users())->addComment();
        $this->setContent($error);
    }

    public function getImage()
    {
        $image = '';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $result = $this->mysql()->query("SELECT `s`, `image` FROM `user` WHERE `id` = {$user->id()} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if ('' != $row['image']) {
                        $imageName = md5($user->id());
                        $image = Server::STATIC[$row['s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['image'];
                    }
                }
            } else {
                if (!headers_sent()) {
                    setcookie('__user__', '', time() - 3600 * 24 * 30, '/');
                }
            }
        } else {
            if (!headers_sent()) {
                setcookie('__user__', '', time() - 3600 * 24 * 30, '/');
            }
        }
        
        $this->setContent($image);
    }

    /**
     * Set comment like.
     */
    public function likeComment()
    {
        (new Users())->likeComment();
        $this->setContent('');
    }

    /**
     * Set comment dislike.
     */
    public function dislikeComment()
    {
        (new Users())->dislikeComment();
        $this->setContent('');
    }

    /**
     * Get voted comment's ID for news.
     */
    public function getNewsVote()
    {
        $data = (new Users())->getNewsVote();
        $this->setContent(json_encode($data));
    }

    /**
     * Get voted comment's ID for reviews.
     */
    public function getFilmVote()
    {
        $data = (new Users())->getFilmVote();
        $this->setContent(json_encode($data));
    }

    /**
     * Get voted comment's ID for feedback.
     */
    public function getPersonVote()
    {
        $data = (new Users())->getPersonVote();
        $this->setContent(json_encode($data));
    }

    /**
     * Get voted comment's ID for trailer.
     */
    public function getTrailerVote()
    {
        $data = (new Users())->getTrailerVote();
        $this->setContent(json_encode($data));
    }
}