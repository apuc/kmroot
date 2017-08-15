<?php
namespace Kinomania\Original\Controller;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Comment\Comment;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class NewsController
 * @package Kinomania\Original\Controller
 */
class NewsController extends DefaultController
{
    use TRepository;
    use TDate;

    /**
     * @param $newsId
     * @return array
     */
    protected function getComment($newsId)
    {
        $newsId = intval($newsId);
        
        $comment = ['count' => 0, 'list' => []];
        
        $key = 'news:comment:' . $newsId;
        if ($this->redisStatus && $this->redis->exists($key)) {
            $comment = unserialize($this->redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`parent`, t1.`userId`, t1.`name`, t1.`date`, t1.`text`, t3.`like`, t3.`dislike`, t2.`s`, t2.`image`, t2.`login` 
                                                FROM `comment` as `t1` JOIN (SELECT `id` FROM `comment` WHERE `relatedId` = {$newsId} AND `type` = 'news' ORDER BY `date`) as `t` ON t1.`id` = t.`id` 
                                                LEFT JOIN `comment_stat` as `t3` ON t1.`id` = t3.`commentId` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id`
                                              ");
            $comment['count'] = $result->num_rows;
            $commentList = [];
            if($result){
                while ($row = $result->fetch_assoc()) {
                    if (!empty($row['login'])) {
                        $row['name'] = $row['login'];
                    }

                    if (empty($row['like'])) {
                        $row['like'] = 0;
                    }

                    if (empty($row['dislike'])) {
                        $row['dislike'] = 0;
                    }

                    if ('' != $row['image']) {
                        $imageName = md5($row['userId']);
                        $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['image'];
                    } else {
                        $row['image'] = Server::STATIC[0] . '/app/img/content/no-avatar-m.jpg';
                    }

                    $commentList[$row['id']] = [
                        Comment::ID => $row['id'],
                        Comment::PARENT => $row['parent'],
                        Comment::IMAGE => $row['image'],
                        Comment::LOGIN => $row['login'],
                        Comment::NAME => $row['name'],
                        Comment::TEXT => $row['text'],
                        Comment::DATE => $this->formatDate($row['date'], true, ', '),
                        Comment::LIKE => $row['like'],
                        Comment::DISLIKE => $row['dislike'],
                        Comment::CHILD => [],
                    ];
                }
            }

            foreach ($commentList as $k => &$v) {
                if ($v[Comment::PARENT] != 0) {
                    $commentList[$v[Comment::PARENT]][Comment::CHILD][] =& $v;
                }
            }
            unset($v);
            foreach ($commentList as $k => $v) {
                if ($v[Comment::PARENT] != 0) {
                    unset($commentList[$k]);
                }
            }
            $comment['list'] = $commentList;

            if (!Wrap::$debugEnabled && $this->redisStatus) {
                $this->redis->set($key, serialize($comment), 120); // 2 min
            }
        }

        return $comment;
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