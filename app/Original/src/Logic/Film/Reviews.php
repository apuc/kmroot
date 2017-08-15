<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\Original\Key\Comment\Comment;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\Original\Key\Person\Frame;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Reviews
 * @package Kinomania\Original\Film
 */
class Reviews
{
    use TRepository;
    use TDate;
    
    public function getList($filmId)
    {
        $this->item['list'] = [];
        $filmId = intval($filmId);

        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`date`, t1.`userId`, t1.`name` as `nick`, t1.`text`, t2.`vote`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` 
                                        FROM `film_review` AS `t1`
                                        LEFT JOIN `film_review_stat` AS `t2` ON t1.`id` = t2.`reviewId`
                                        LEFT JOIN `user` AS `t3` ON t1.`userId` = t3.`id`
                                        WHERE 
                                        t1.`filmId` = '{$filmId}' AND t1.`status` = 'show'
                                        ORDER BY t1.`date` DESC");
        if($result){
            while ($row = $result->fetch_assoc()) {
                $row['date'] = $this->formatDate($row['date'], true, '</span>, <span class="date__hour">');

                if ('' != $row['user_image']) {
                    $imageName = md5($row['userId']);
                    $row['avatar'] = Server::STATIC[$row['user_s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['user_image'];
                } else {
                    $row['avatar'] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
                }

                $row['name'] = $row['name'] . ' ' . $row['surname'];
                if (empty(trim($row['name']))) {
                    $row['name'] = $row['login'];
                }
                if (empty($row['name'])) {
                    $row['name'] = $row['nick'];
                }

                $row['vote'] = intval($row['vote']);
                if (0 == $row['comment']) {
                    $row['comment'] = '';
                }

                $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
                $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote><p>$2</p></blockquote>', $row['text']);
                $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
                $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);

                $this->item['list'][] = $row;
            }
        }

        
        return $this->item;
    }
    
    public function getMain($filmId)
    {
        $list = [];
        $filmId = intval($filmId);

        $list['count'] = 0;
        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`publish`, t1.`authorId`, t1.`title`, t1.`text`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` FROM `news` AS `t1`
                                        LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                                        LEFT JOIN `user` AS `t3` ON t1.`authorId` = t3.`id`
                                        WHERE 
                                        t1.`status` = 'show' AND t1.`filmId` = {$filmId}
                                        ORDER BY t1.`publish` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $row['publish'] = $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">');

            if ('' != $row['user_image']) {
                $imageName = md5($row['authorId']);
                $row['avatar'] = Server::STATIC[$row['user_s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['user_image'];
            } else {
                $row['avatar'] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
            }

            $row['name'] = $row['name'] . ' ' . $row['surname'];
            if (empty(trim($row['name']))) {
                $row['name'] = $row['login'];
            }

            if (0 == $row['comment']) {
                $row['comment'] = '';
            }

            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote><p>$2</p></blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);

            $list['main'] = $row;
            $list['count'] = 1;
            $list['user'] = [];
        }
        
        return $list;
    }

    public function getReviewById($reviewId)
    {
        $list = [];

        $reviewId = intval($reviewId);

        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`date`, t1.`userId`, t1.`name` as `nick`, t1.`text`, t2.`vote`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` 
                                        FROM `film_review` AS `t1`
                                        LEFT JOIN `film_review_stat` AS `t2` ON t1.`id` = t2.`reviewId`
                                        LEFT JOIN `user` AS `t3` ON t1.`userId` = t3.`id`
                                        WHERE 
                                        t1.`id` = '{$reviewId}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $row['date'] = $this->formatDate($row['date'], true, '</span>, <span class="date__hour">');

            if ('' != $row['user_image']) {
                $imageName = md5($row['userId']);
                $row['avatar'] = Server::STATIC[$row['user_s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['user_image'];
            } else {
                $row['avatar'] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
            }

            $row['name'] = $row['name'] . ' ' . $row['surname'];
            if (empty(trim($row['name']))) {
                $row['name'] = $row['login'];
            }
            if (empty($row['name'])) {
                $row['name'] = $row['nick'];
            }

            if (0 == $row['comment']) {
                $row['comment'] = '';
            }

            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote><p>$2</p></blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);

            $list[] = $row;
        }

        return $list;
    }

    public function commentList($reviewId)
    {
        $this->item = ['count' => 0, 'list' => [], 'show' => false];

        $reviewId = intval($reviewId);

        $result = $this->mysql()->query("SELECT 1 FROM `film_review` WHERE `id` = {$reviewId} LIMIT 1");
        if (0 < $result->num_rows) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`parent`, t1.`userId`, t1.`name`, t1.`date`, t1.`text`, t3.`like`, t3.`dislike`, t2.`s`, t2.`image`, t2.`login` 
                                                FROM `comment` as `t1` JOIN (SELECT `id` FROM `comment` WHERE `relatedId` = {$reviewId} AND `type` = 'film' ORDER BY `date`) as `t` ON t1.`id` = t.`id` 
                                                LEFT JOIN `comment_stat` as `t3` ON t1.`id` = t3.`commentId` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id`
                                              ");
            $this->item['count'] = $result->num_rows;
            $commentList = [];
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
                $row['date'] = $this->formatDate($row['date'], true, ', ');
                $row['child'] = [];
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

            $this->item['list'] = $commentList;
            $this->item['show'] = true;
        }

        return $this->item;
    }
    
    protected $item;
}
