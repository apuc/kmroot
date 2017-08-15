<?php
namespace Original\Route_people_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\TV\TV;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\Original\Auth\User\Access;
use Kinomania\System\Text\TText;
use Dspbee\Bundle\Common\Bag\PostBag;

class AJAX extends DefaultController
{
    use TRepository;
    use TDate;
    use TText;

    public function addExtra()
    {
        $data = 'auth';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $data = 'fail';
                $post = new PostBag();

                $type = $post->fetchEscape('type', $this->mysql());
                $relatedId = $post->fetchInt('relatedId');
                $info = $post->fetch('info');
                $source = $post->fetch('source');
                $form = $post->fetchEscape('form', $this->mysql());

                $info = $this->clearText($info);
                if (!empty($info)) {
                    $info = $this->mysql()->real_escape_string($info);
                    $source = $this->clearText($source);
                    $source = $this->mysql()->real_escape_string($source);
                    $this->mysql()->query("INSERT INTO `moderate` SET 
                                        `type` = '{$type}',
                                        `relatedId` = {$relatedId},
                                        `userId` = {$user->id()},
                                        `info` = '{$info}',
                                        `source` = '{$source}',
                                        `file` = '',
                                        `form` = '{$form}',
                                        `new` = 'true'
                                      ");
                    if (empty($this->mysql()->error)) {
                        $data = 'ok';
                    }
                } else {
                    $data = 'empty';
                }
            }
        }

        $this->setContent($data);
    }

    public function addError()
    {
        $data = 'auth';

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $data = 'fail';
                $post = new PostBag();

                $type = $post->fetchEscape('type', $this->mysql());
                $relatedId = $post->fetchInt('relatedId');
                $info = $post->fetch('info');
                $source = $post->fetch('source');
                $form = $post->fetchEscape('form', $this->mysql());

                $info = $this->clearText($info);
                if (!empty($info)) {
                    $info = $this->mysql()->real_escape_string($info);
                    $source = $this->clearText($source);
                    $source = $this->mysql()->real_escape_string($source);
                    $this->mysql()->query("INSERT INTO `moderate` SET 
                                        `type` = '{$type}',
                                        `relatedId` = {$relatedId},
                                        `userId` = {$user->id()},
                                        `info` = '{$info}',
                                        `source` = '{$source}',
                                        `file` = '',
                                        `form` = '{$form}',
                                        `new` = 'true'
                                      ");
                    if (empty($this->mysql()->error)) {
                        $data = 'ok';
                    }
                } else {
                    $data = 'empty';
                }
            }
        }

        $this->setContent($data);
    }

    /**
     * Person reviews.
     */
    public function getReview()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $list = [];

            $key = 'person:review:' . $numList[0];
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
                $list = unserialize($redis->get($key));
            } else {
                $list['count'] = 0;

                $result = $this->mysql()->query("SELECT 
                                        COUNT(*) as `count` 
                                        FROM `person_review` AS `t1` WHERE
                                        t1.`personId` = {$numList[0]} AND t1.`status` = 'show' ");
                if ($row = $result->fetch_assoc()) {
                    $list['count'] += $row['count'];
                }

                $result = $this->mysql()->query("SELECT 
                                        t1.`id`, t1.`date`, t1.`userId`, t1.`name` as `nick`, t1.`text`, t2.`vote`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` 
                                        FROM `person_review` AS `t1`
                                        LEFT JOIN `person_review_stat` AS `t2` ON t1.`id` = t2.`reviewId`
                                        LEFT JOIN `user` AS `t3` ON t1.`userId` = t3.`id`
                                        WHERE 
                                        t1.`personId` = {$numList[0]} AND t1.`status` = 'show'
                                        ORDER BY t1.`date` DESC LIMIT 5");
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

                    $list['user'][] = $row;
                }

                if (!Wrap::$debugEnabled && [] != $list && $redisStatus) {
                    $redis->set($key, serialize($list), 660); // 11 min
                }
            }

            if ([] != $list) {
                $this->setContent(json_encode($list));
            }
        }
    }

    public function getTv()
    {
        $post = new PostBag();
        $personId = $post->fetchInt('personId');

        $tv = new TV();

        $this->setContent(json_encode($tv->personData($personId)));
    }
}