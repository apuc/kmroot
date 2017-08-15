<?php
namespace Kinomania\Original\Logic\Users;

use Kinomania\Original\Key\User\User;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Auth\User\Access;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Users
 * @package Kinomania\Original\Users
 */
class Users
{
    use TRepository;
    use TDate;

    public function get($login)
    {
        $this->item = [];
        
        $login = $this->mysql()->real_escape_string($login);

        $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `status`, `name`, `surname`, `sex`, `city`,
                                                      `about`, `interest`, `registration`, `birthday`, `vk`, `fb`, `ok`, `twitter`, `googlePlus`,
                                                      `liveJournal`, `tg`, `myMail`, `instagram`, `skype`, `icq`
                                                     FROM `user` WHERE `login` = '{$login}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('active' == $row['status']) {
                $this->item[User::ID] = $row['id'];
                $this->item[User::S] = $row['s'];
                $this->item[User::IMAGE] = $row['image'];
                $this->item[User::NAME] = $row['name'];
                $this->item[User::SURNAME] = $row['surname'];
                $this->item[User::SEX] = $row['sex'];
                $this->item[User::CITY] = $row['city'];
                $this->item[User::ABOUT] = $row['about'];
                $this->item[User::INTEREST] = $row['interest'];
                $this->item[User::BIRTHDAY] = $row['birthday'];
                $this->item[User::VK] = $row['vk'];
                $this->item[User::FB] = $row['fb'];
                $this->item[User::OK] = $row['ok'];
                $this->item[User::TWITTER] = $row['twitter'];
                $this->item[User::GOOGLE_PLUS] = $row['googlePlus'];
                $this->item[User::LIVE_JOURNAL] = $row['liveJournal'];
                $this->item[User::TG] = $row['tg'];
                $this->item[User::MY_MAIL] = $row['myMail'];
                $this->item[User::INSTAGRAM] = $row['instagram'];
                $this->item[User::SKYPE] = $row['skype'];
                $this->item[User::ICQ] = $row['icq'];
                $this->item[User::REGISTRATION] = $row['registration'];

                /**
                 * Date proceed.
                 */
                $this->birthday();
                $this->registration();

                $this->item[User::IS_SOCIAL] = false;
                if (!empty($this->item[User::VK]) || !empty($this->item[User::FB]) || !empty($this->item[User::OK]) || !empty($this->item[User::TWITTER]) || !empty($this->item[User::GOOGLE_PLUS]) || !empty($this->item[User::LIVE_JOURNAL]) || !empty($this->item[User::TG]) || !empty($this->item[User::MY_MAIL]) || !empty($this->item[User::SKYPE]) || !empty($this->item[User::ICQ])|| !empty($this->item[User::INSTAGRAM])) {
                    $this->item[User::IS_SOCIAL] = true;
                }
            }
        }
        
        return $this->item;
    }

    public function addFeedback()
    {
        $error = 1;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $now = strtotime('now');
                $result = $this->mysql()->query("SELECT `last` FROM `user` WHERE `id` = {$user->id()} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $last = strtotime($row['last']);
                    if (100 < $now - $last) {
                        $this->mysql()->query("UPDATE `user` SET `last` = FROM_UNIXTIME('{$now}') WHERE `id` = {$user->id()} LIMIT 1");

                        $post = new PostBag();
                        $relatedId = $post->fetchInt('relatedId');

                        if (0 < $relatedId) {
                            $text = $post->fetch('text');
                            $checkText = $text;

                            $checkText = preg_replace('/\[spoiler(.*)\](.*)\[\/spoiler\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[quote(.*)\](.*)\[\/quote\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[b(.*)\](.*)\[\/b\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[i(.*)\](.*)\[\/i\]/is', '$2', $checkText);
                            $checkText = strip_tags($checkText, 'a');
                            $checkText = trim(preg_replace('/\s\s+/', ' ', $checkText));

                            if (1 < mb_strlen($checkText, 'UTF-8')) {
                                $text = preg_replace('/\[spoiler(.*)\]\[\/spoiler\]/is', '', $text);
                                $text = preg_replace('/\[quote(.*)\]\[\/quote\]/is', '', $text);
                                $text = preg_replace('/\[b(.*)\]\[\/b\]/is', '', $text);
                                $text = preg_replace('/\[i(.*)\]\[\/i\]/is', '', $text);
                                $text = trim(preg_replace('/\s\s+/', ' ', $text));
                                $text = strip_tags($text);
                                $text = htmlspecialchars($text);
                                $text = htmlentities($text);
                                $text = $this->mysql()->real_escape_string($text);
                                $date = strtotime('now');
                                $this->mysql()->query("INSERT INTO `person_review` SET `personId` = {$relatedId}, `userId` = {$user->id()}, `name` = '', `status` = 'hide', `text` = '{$text}', `date` = FROM_UNIXTIME('{$date}')");
                                if (empty($this->mysql()->error)) {
                                    $error = 0;
                                }
                            }
                        }
                    } else {
                        $error = 2;
                    }
                }
            }
        }

        return $error;
    }

    /**
     * Add vote to review.
     */
    public function voteFeedback()
    {
        $vote = 0;

        $get = new GetBag();
        $reviewId = $get->fetchInt('id');

        if (isset($_COOKIE['__user__']) && 0 < $reviewId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                /**
                 * Vote.
                 */
                $result = $this->mysql()->query("SELECT 1 FROM `person_review_vote` WHERE `reviewId` = {$reviewId} AND `userId` = {$user->id()} LIMIT 1");
                if (0 == $result->num_rows) {
                    $this->mysql()->query("INSERT INTO `person_review_vote` SET `reviewId` = {$reviewId}, `userId` = {$user->id()}");

                    /**
                     * Stat.
                     */
                    $result = $this->mysql()->query("SELECT `id`, `vote` FROM `person_review_stat` WHERE `reviewId` = {$reviewId} LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $vote = $row['vote'];
                        $this->mysql()->query("UPDATE `person_review_stat` SET `vote` = `vote` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                    } else {
                        $this->mysql()->query("INSERT INTO `person_review_stat` SET `reviewId` = {$reviewId}, `vote` = 1, `comment` = 0");
                    }
                    $vote++;
                }
            }
        }

        return $vote;
    }

    public function addReview()
    {
        $error = 1;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $now = strtotime('now');
                $result = $this->mysql()->query("SELECT `last` FROM `user` WHERE `id` = {$user->id()} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $last = strtotime($row['last']);
                    if (100 < $now - $last) {
                        $this->mysql()->query("UPDATE `user` SET `last` = FROM_UNIXTIME('{$now}') WHERE `id` = {$user->id()} LIMIT 1");

                        $post = new PostBag();
                        $relatedId = $post->fetchInt('relatedId');

                        if (0 < $relatedId) {
                            $text = $post->fetch('text');
                            $checkText = $text;

                            $checkText = preg_replace('/\[spoiler(.*)\](.*)\[\/spoiler\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[quote(.*)\](.*)\[\/quote\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[b(.*)\](.*)\[\/b\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[i(.*)\](.*)\[\/i\]/is', '$2', $checkText);
                            $checkText = strip_tags($checkText, 'a');
                            $checkText = trim(preg_replace('/\s\s+/', ' ', $checkText));

                            if (1 < mb_strlen($checkText, 'UTF-8')) {
                                $text = preg_replace('/\[spoiler(.*)\]\[\/spoiler\]/is', '', $text);
                                $text = preg_replace('/\[quote(.*)\]\[\/quote\]/is', '', $text);
                                $text = preg_replace('/\[b(.*)\]\[\/b\]/is', '', $text);
                                $text = preg_replace('/\[i(.*)\]\[\/i\]/is', '', $text);
                                $text = trim(preg_replace('/\s\s+/', ' ', $text));
                                $text = strip_tags($text);
                                $text = htmlspecialchars($text);
                                $text = htmlentities($text);
                                $text = $this->mysql()->real_escape_string($text);
                                $date = strtotime('now');
                                $this->mysql()->query("INSERT INTO `film_review` SET `filmId` = {$relatedId}, `userId` = {$user->id()}, `name` = '', `status` = 'hide', `text` = '{$text}', `date` = FROM_UNIXTIME('{$date}')");
                                if (empty($this->mysql()->error)) {
                                    $error = 0;
                                }
                            }
                        }
                    } else {
                        $error = 2;
                    }
                }
            }
        }

        return $error;
    }

    public function voteReview()
    {
        $vote = 0;

        $get = new GetBag();
        $reviewId = $get->fetchInt('id');

        if (isset($_COOKIE['__user__']) && 0 < $reviewId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                /**
                 * Vote.
                 */
                $result = $this->mysql()->query("SELECT 1 FROM `film_review_vote` WHERE `reviewId` = {$reviewId} AND `userId` = {$user->id()} LIMIT 1");
                if (0 == $result->num_rows) {
                    $this->mysql()->query("INSERT INTO `film_review_vote` SET `reviewId` = {$reviewId}, `userId` = {$user->id()}");

                    /**
                     * Stat.
                     */
                    $result = $this->mysql()->query("SELECT `id`, `vote` FROM `film_review_stat` WHERE `reviewId` = {$reviewId} LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $vote = $row['vote'];
                        $this->mysql()->query("UPDATE `film_review_stat` SET `vote` = `vote` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                    } else {
                        $this->mysql()->query("INSERT INTO `film_review_stat` SET `reviewId` = {$reviewId}, `vote` = 1, `comment` = 0");
                    }
                    $vote++;
                }
            }
        }

        return $vote;
    }
    
    public function getBlog($userId)
    {
        $list = [];
        
        $userId = intval($userId);

        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM `news` AS `t1`
                                        LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                                        WHERE 
                                        t1.`status` = 'show' AND t1.`category` = 'Блог' AND t1.`authorId` = {$userId}
                                        ORDER BY t1.`publish` DESC LIMIT 4");
        while ($row = $result->fetch_assoc()) {
            $row['authorId'] = $userId;
            $row['publish'] = $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">');
            $list[] = $row;
        }
        
        return $list;
    }
    
    public function getVote($userId)
    {
        $list = [];

        $userId = intval($userId);

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`date`, t3.`rate` as `average`
                                                 FROM `user_film_vote` as `t2`
                                                 JOIN `film` as `t1` ON t1.`id` = t2.`filmId` 
                                                 LEFT JOIN `film_stat` as `t3` ON t1.`id` = t3.`filmId`
                                                 WHERE t2.`userId` = {$userId} ORDER BY t2.`id` DESC LIMIT 4");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
            }

            $date = $this->formatDate($row['date'], true, ', &nbsp;');

            $item = [
                'id' => $row['id'],
                'image' => $image,
                'name_origin' => $row['name_origin'],
                'name_ru' => $row['name_ru'],
                'rate' => $row['rate'],
                'date' => $date,
                'average' => $row['average']
            ];
            $list[] = $item;
        }

        return $list;
    }
    
    public function getComment($userId)
    {
        $list = [];
        
        $userId = intval($userId);
        
        $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`relatedId`, t1.`type`, t1.`text`, t1.`date` FROM 
                                        (SELECT `id` FROM `comment` WHERE `userId` = {$userId} ORDER BY `date` DESC LIMIT 4) as `t`
                                        JOIN `comment` AS `t1` ON t1.`id` = t.`id`");
        while ($row = $result->fetch_assoc()) {
            $type = '';
            $image = '';
            $link = '';
            $title = '';

            switch ($row['type']) {
                case 'news':
                    $type = 'новости';

                    $result2 = $this->mysql()->query("SELECT `s`, `image`, `category`, `title` FROM `news` WHERE `id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nni.jpg';
                        }

                        switch ($row2['category']) {
                            case 'Новости кино':
                                $link = '/news/';
                                break;
                            case 'Зарубежные сериалы':
                                $link = '/news/';
                                break;
                            case 'Российские сериалы':
                                $link = '/news/';
                                break;
                            case 'Арткиномания':
                                $link = '/news/';
                                break;
                            case 'Фестивали и премии':
                                $link = '/news/';
                                break;
                            default:
                                $type = 'статье';
                                $link = '/article/';
                        }

                        $title = $row2['title'];
                    }

                    $link .= $row['relatedId'];

                    break;
                case 'film':
                    $type = 'фильму';

                    $result2 = $this->mysql()->query("SELECT `s`, `image`, `name_origin`, `name_ru` FROM `film` WHERE `id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }
                    }

                    $link = '/film/' . $row['relatedId'];
                    break;
                case 'trailer':
                    $type = 'трейлеру';

                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru` 
                                                                  FROM `film` as `t1`
                                                                  JOIN `trailer` as `t2` ON t1.`id` = t2.`filmId` 
                                                                  WHERE t2.`id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row2['id']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }
                        $link = '/film/' . $row2['id'] . '/trailers/';

                    }

                    $link .= $row['relatedId'];

                    break;
                case 'person':
                    $type = 'персоне';

                    $result2 = $this->mysql()->query("SELECT `s`, `image`, `name_origin`, `name_ru` FROM `person` WHERE `id` = {$row['relatedId']} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        if ('' != $row2['image']) {
                            $imageName = md5($row['relatedId']);
                            $image = Server::STATIC[$row2['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.94.51.' . $row2['image'];
                        } else {
                            //$image = Server::STATIC[0] . '/app/img/content/nop.jpg';
                        }

                        $title = $row2['name_ru'];
                        if (empty($title)) {
                            $title = $row2['name_origin'];
                        }
                    }

                    $link = '/people/' . $row['relatedId'];
                    break;
            }


            $row['type'] = $type;
            $row['image'] = $image;
            $row['link'] = $link;
            $row['title'] = $title;

            $row['date'] = $this->formatDate($row['date'], true, ', ');
            $row['text'] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $row['text']);
            $row['text'] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote>$2</blockquote>', $row['text']);
            $row['text'] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $row['text']);
            $row['text'] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $row['text']);
            $row['text'] = str_replace('&amp;quot;', '"', $row['text']);
            $row['text'] = str_replace('&amp;laquo;', '«', $row['text']);
            $row['text'] = str_replace('&amp;hellip;', '…', $row['text']);
            $row['text'] = str_replace('&amp;raquo;', '»', $row['text']);
            $list[] = $row;
        }
        
        return $list;
    }
    
    public function addComment()
    {
        $error = 1;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $now = strtotime('now');
                $result = $this->mysql()->query("SELECT `last` FROM `user` WHERE `id` = {$user->id()} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $last = strtotime($row['last']);
                    if (100 < $now - $last) {
                        $this->mysql()->query("UPDATE `user` SET `last` = FROM_UNIXTIME('{$now}') WHERE `id` = {$user->id()} LIMIT 1");

                        $post = new PostBag();
                        $relatedId = $post->fetchInt('relatedId');
                        $parent = $post->fetchInt('parent');
                        $type = $post->fetch('type');

                        switch ($type) {
                            case 'news':
                            case 'trailer':
                            case 'film':
                            case 'person':
                                break;
                            default:
                                $type = '';
                        }

                        if ('' != $type && 0 < $relatedId) {
                            $text = $post->fetch('text');
                            $checkText = $text;

                            $checkText = preg_replace('/\[spoiler(.*)\](.*)\[\/spoiler\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[quote(.*)\](.*)\[\/quote\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[b(.*)\](.*)\[\/b\]/is', '$2', $checkText);
                            $checkText = preg_replace('/\[i(.*)\](.*)\[\/i\]/is', '$2', $checkText);
                            $checkText = strip_tags($checkText, 'a');
                            $checkText = trim(preg_replace('/\s\s+/', ' ', $checkText));

                            if (1 < mb_strlen($checkText, 'UTF-8')) {
                                $text = preg_replace('/\[spoiler(.*)\]\[\/spoiler\]/is', '', $text);
                                $text = preg_replace('/\[quote(.*)\]\[\/quote\]/is', '', $text);
                                $text = preg_replace('/\[b(.*)\]\[\/b\]/is', '', $text);
                                $text = preg_replace('/\[i(.*)\]\[\/i\]/is', '', $text);
                                $text = trim(preg_replace('/\s\s+/', ' ', $text));
                                $text = strip_tags($text);
                                $text = htmlspecialchars($text);
                                $text = htmlentities($text);
                                $text = $this->mysql()->real_escape_string($text);
                                $this->mysql()->query("INSERT INTO `comment` SET `parent` = {$parent}, `status` = 'hide', `relatedId` = {$relatedId}, `type` = '{$type}', `userId` = {$user->id()}, `name` = '', `text` = '{$text}'");
                                if (empty($this->mysql()->error)) {
                                    $error = 0;
                                }

                                if (0 == $error) {
                                    if ('news' == $type) {
                                        $result = $this->mysql()->query("SELECT `id` FROM `news_stat` WHERE `newsId` = {$relatedId} LIMIT 1");
                                        if ($row = $result->fetch_assoc()) {
                                            $this->mysql()->query("UPDATE `news_stat` SET `comment` = `comment` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                                        } else {
                                            $this->mysql()->query("INSERT INTO `news_stat` SET `newsId` = {$relatedId}, `comment` = 1");
                                        }
                                    }
                                    if ('trailer' == $type) {
                                        $result = $this->mysql()->query("SELECT `id` FROM `trailer_stat` WHERE `trailerId` = {$relatedId} LIMIT 1");
                                        if ($row = $result->fetch_assoc()) {
                                            $this->mysql()->query("UPDATE `trailer_stat` SET `comment` = `comment` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                                        } else {
                                            $this->mysql()->query("INSERT INTO `trailer_stat` SET `trailerId` = {$relatedId}, `vote` = 0, `comment` = 1");
                                        }
                                    }
                                    if ('film' == $type) {
                                        $result = $this->mysql()->query("SELECT `id` FROM `film_review_stat` WHERE `reviewId` = {$relatedId} LIMIT 1");
                                        if ($row = $result->fetch_assoc()) {
                                            $this->mysql()->query("UPDATE `film_review_stat` SET `comment` = `comment` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                                        } else {
                                            $this->mysql()->query("INSERT INTO `film_review_stat` SET `reviewId` = {$relatedId}, `vote` = 0, `comment` = 1");
                                        }
                                    }
                                    if ('person' == $type) {
                                        $result = $this->mysql()->query("SELECT `id` FROM `person_review_stat` WHERE `reviewId` = {$relatedId} LIMIT 1");
                                        if ($row = $result->fetch_assoc()) {
                                            $this->mysql()->query("UPDATE `person_review_stat` SET `comment` = `comment` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                                        } else {
                                            $this->mysql()->query("INSERT INTO `person_review_stat` SET `reviewId` = {$relatedId}, `vote` = 0, `comment` = 1");
                                        }
                                    }

                                    $this->mysql()->query("UPDATE `user` SET `count_comment` = `count_comment` + 1 WHERE `id` = {$user->id()} LIMIT 1");
                                }
                            }
                        }
                    } else {
                        $error = 2;
                    }
                }
            }
        }
        
        return $error;
    }

    public function likeComment()
    {
        $get = new GetBag();
        $commentId = $get->fetchInt('id');

        if (isset($_COOKIE['__user__']) && 0 < $commentId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                /**
                 * Vote.
                 */
                $mode = 'none';
                $result = $this->mysql()->query("SELECT `id`, `vote` FROM `comment_vote` WHERE `userId` = {$user->id()} AND `commentId` = {$commentId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if (0 == $row['vote']) {
                        $mode = 'change';
                        $this->mysql()->query("UPDATE `comment_vote` SET `vote` = 1 WHERE `id` = {$row['id']} LIMIT 1");
                    }
                } else {
                    $this->mysql()->query("INSERT INTO `comment_vote` SET `userId` = {$user->id()}, `commentId` = {$commentId}, `vote` = 1");
                    $mode = 'add';
                }

                /**
                 * Stat.
                 */
                $result = $this->mysql()->query("SELECT `id` FROM `comment_stat` WHERE `commentId` = {$commentId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    switch ($mode) {
                        case 'change':
                            $this->mysql()->query("UPDATE `comment_stat` SET `like` = `like` + 1, `dislike` = `dislike` - 1 WHERE `id` = {$row['id']} LIMIT 1");
                            break;
                        case 'add':
                            $this->mysql()->query("UPDATE `comment_stat` SET `like` = `like` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                            break;
                    }
                } else {
                    $this->mysql()->query("INSERT INTO `comment_stat` SET `commentId` = {$commentId}, `like` = 1, `dislike` = 0");
                }
            }
        }
    }
    
    public function dislikeComment()
    {
        $get = new GetBag();
        $commentId = $get->fetchInt('id');

        if (isset($_COOKIE['__user__']) && 0 < $commentId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                /**
                 * Vote.
                 */
                $mode = 'none';
                $result = $this->mysql()->query("SELECT `id`, `vote` FROM `comment_vote` WHERE `userId` = {$user->id()} AND `commentId` = {$commentId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if (1 == $row['vote']) {
                        $mode = 'change';
                        $this->mysql()->query("UPDATE `comment_vote` SET `vote` = 0 WHERE `id` = {$row['id']} LIMIT 1");
                    }
                } else {
                    $this->mysql()->query("INSERT INTO `comment_vote` SET `userId` = {$user->id()}, `commentId` = {$commentId}, `vote` = 0");
                    $mode = 'add';
                }

                /**
                 * Stat.
                 */
                $result = $this->mysql()->query("SELECT `id` FROM `comment_stat` WHERE `commentId` = {$commentId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    switch ($mode) {
                        case 'change':
                            $this->mysql()->query("UPDATE `comment_stat` SET `like` = `like` - 1, `dislike` = `dislike` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                            break;
                        case 'add':
                            $this->mysql()->query("UPDATE `comment_stat` SET `dislike` = `dislike` + 1 WHERE `id` = {$row['id']} LIMIT 1");
                            break;
                    }
                } else {
                    $this->mysql()->query("INSERT INTO `comment_stat` SET `commentId` = {$commentId}, `like` = 0, `dislike` = 1");
                }
            }
        }
    }

    public function getNewsVote()
    {
        $data = ['like' => [], 'dislike' => []];

        $get = new GetBag();
        $relatedId = $get->fetchInt('relatedId');

        if (isset($_COOKIE['__user__']) && 0 < $relatedId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $result = $this->mysql()->query("SELECT t2.`commentId`, t2.`vote` 
                                                 FROM (SELECT `id` FROM `comment` WHERE `relatedId` = {$relatedId} AND `type` = 'news') as `t1` 
                                                 JOIN `comment_vote` as `t2` ON t1.`id` = t2.`commentId` 
                                                 WHERE t2.`userId` = {$user->id()}");
                while ($row = $result->fetch_assoc()) {
                    if (0 == $row['vote']) {
                        $data['dislike'][] = $row['commentId'];
                    } else {
                        $data['like'][] = $row['commentId'];
                    }
                }
            }
        }

        return $data;
    }

    public function getFilmVote()
    {
        $data = ['like' => [], 'dislike' => []];

        $get = new GetBag();
        $relatedId = $get->fetchInt('relatedId');

        if (isset($_COOKIE['__user__']) && 0 < $relatedId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $result = $this->mysql()->query("SELECT t2.`commentId`, t2.`vote` 
                                                 FROM (SELECT `id` FROM `comment` WHERE `relatedId` = {$relatedId} AND `type` = 'film') as `t1` 
                                                 JOIN `comment_vote` as `t2` ON t1.`id` = t2.`commentId` 
                                                 WHERE t2.`userId` = {$user->id()}");
                while ($row = $result->fetch_assoc()) {
                    if (0 == $row['vote']) {
                        $data['dislike'][] = $row['commentId'];
                    } else {
                        $data['like'][] = $row['commentId'];
                    }
                }
            }
        }

        return $data;
    }

    public function getPersonVote()
    {
        $data = ['like' => [], 'dislike' => []];

        $get = new GetBag();
        $relatedId = $get->fetchInt('relatedId');

        if (isset($_COOKIE['__user__']) && 0 < $relatedId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $result = $this->mysql()->query("SELECT t2.`commentId`, t2.`vote` 
                                                 FROM (SELECT `id` FROM `comment` WHERE `relatedId` = {$relatedId} AND `type` = 'person') as `t1` 
                                                 JOIN `comment_vote` as `t2` ON t1.`id` = t2.`commentId` 
                                                 WHERE t2.`userId` = {$user->id()}");
                while ($row = $result->fetch_assoc()) {
                    if (0 == $row['vote']) {
                        $data['dislike'][] = $row['commentId'];
                    } else {
                        $data['like'][] = $row['commentId'];
                    }
                }
            }
        }

        return $data;
    }

    public function getTrailerVote()
    {
        $data = ['like' => [], 'dislike' => []];

        $get = new GetBag();
        $relatedId = $get->fetchInt('relatedId');

        if (isset($_COOKIE['__user__']) && 0 < $relatedId) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $result = $this->mysql()->query("SELECT t2.`commentId`, t2.`vote` 
                                                 FROM (SELECT `id` FROM `comment` WHERE `relatedId` = {$relatedId} AND `type` = 'trailer') as `t1` 
                                                 JOIN `comment_vote` as `t2` ON t1.`id` = t2.`commentId` 
                                                 WHERE t2.`userId` = {$user->id()}");
                while ($row = $result->fetch_assoc()) {
                    if (0 == $row['vote']) {
                        $data['dislike'][] = $row['commentId'];
                    } else {
                        $data['like'][] = $row['commentId'];
                    }
                }
            }
        }

        return $data;
    }


    /**
     * Birthday data.
     */
    private function birthday()
    {
        if (!empty($this->item[User::BIRTHDAY])) {
            $year = date_diff(date_create($this->item[User::BIRTHDAY]), date_create('today'))->y;
            $this->item[User::BIRTHDAY] = $this->formatDate($this->item[User::BIRTHDAY]);
            if (0 < $year) {
                $num = $year % 100;
                if ($num > 19) {
                    $num = $num % 10;
                }
                switch ($num) {
                    case 1:
                        $year .= ' год';
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $year .= ' года';
                        break;
                    default:
                        $year .= ' лет';
                }

                if (!empty($year)) {
                    $this->item[User::BIRTHDAY] .= ' (' . $year . ')';
                }
            }
        }
    }

    /**
     * Registration data.
     */
    private function registration()
    {
        if (!empty($this->item[User::REGISTRATION])) {
            $this->item[User::REGISTRATION] = $this->formatDate($this->item[User::REGISTRATION]);
        }
    }
    
    private $item;
}