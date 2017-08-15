<?php
namespace Kinomania\Original\Logic\Person;

use Kinomania\Original\Key\Comment\Comment;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Reviews
 * @package Kinomania\Original\Person
 */
class Reviews
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @return array
     */
    public function get($personId)
    {
        $list = [];

        $personId = intval($personId);

        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`date`, t1.`userId`, t1.`name` as `nick`, t1.`text`, t2.`vote`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` 
                                        FROM `person_review` AS `t1`
                                        LEFT JOIN `person_review_stat` AS `t2` ON t1.`id` = t2.`reviewId`
                                        LEFT JOIN `user` AS `t3` ON t1.`userId` = t3.`id`
                                        WHERE 
                                        t1.`personId` = {$personId} AND t1.`status` = 'show'
                                        ORDER BY t1.`date` DESC");
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
                $row['login'] = 0;
            }

            $row['vote'] = intval($row['vote']);
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

    /**
     * @param int $reviewId
     * @return array
     */
    public function commentList($reviewId)
    {
        $item = ['list' => [], 'count' => 0];

        $reviewId = intval($reviewId);

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`parent`, t1.`userId`, t1.`name`, t1.`date`, t1.`text`, t3.`like`, t3.`dislike`, t2.`s`, t2.`image`, t2.`login` 
                                                FROM `comment` as `t1` JOIN (SELECT `id` FROM `comment` WHERE `relatedId` = {$reviewId} AND `type` = 'person' ORDER BY `date`) as `t` ON t1.`id` = t.`id` 
                                                LEFT JOIN `comment_stat` as `t3` ON t1.`id` = t3.`commentId` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id`
                                              ");
        $item['count'] = $result->num_rows;
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
        
        $item['list'] = $commentList;

        return $item;
    }
    
    public function getReviewById($personId, $reviewId)
    {
        $list = [];
        
        $personId = intval($personId);
        $reviewId = intval($reviewId);
        
        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`date`, t1.`userId`, t1.`name` as `nick`, t1.`text`, t2.`vote`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` 
                                        FROM `person_review` AS `t1`
                                        LEFT JOIN `person_review_stat` AS `t2` ON t1.`id` = t2.`reviewId`
                                        LEFT JOIN `user` AS `t3` ON t1.`userId` = t3.`id`
                                        WHERE 
                                        t1.`id` = '{$reviewId}' AND t1.`personId` = {$personId} LIMIT 1");
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
}