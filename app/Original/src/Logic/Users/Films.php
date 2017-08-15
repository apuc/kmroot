<?php
namespace Kinomania\Original\Logic\Users;

use Dspbee\Bundle\Debug\Wrap;
use Dspbee\Core\Request;
use Kinomania\Original\Key\User\User;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Auth\User\Access;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Text\TText;

/**
 * Class Films
 * @package Kinomania\Original\Users
 */
class Films
{
    use TRepository;
    use TDate;
    use TText;

    public function rate()
    {
        $rate = 0;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $filmId = $post->fetchInt('id');
                $rate = $post->fetchInt('rate');

                if (0 < $filmId && 0 < $rate && 11 > $rate) {
                    $result = $this->mysql()->query("SELECT `id` FROM `user_film_vote` WHERE `userId` = {$user->id()} AND `filmId` = {$filmId} LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $this->mysql()->query("UPDATE `user_film_vote` SET `rate` = {$rate} WHERE `id` = {$row['id']} LIMIT 1");
                    } else {
                        $date = strtotime('now');
                        $this->mysql()->query("INSERT INTO `user_film_vote` SET `userId` = {$user->id()}, `filmId` = {$filmId}, `rate` = {$rate}, `date` = FROM_UNIXTIME('{$date}')");
                        $this->mysql()->query("UPDATE `user` SET `count_rate` = `count_rate` + 1 WHERE `id` = {$user->id()} LIMIT 1");
                    }

                    /**
                     * Update rate.
                     */
                    $result = $this->mysql()->query("SELECT SUM(`rate`) as `rate`, COUNT(`rate`) as `count` FROM `user_film_vote` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
                    if ($row = $result->fetch_assoc()) {
                        $count = intval($row['count']);
                        if (0 < $count) {
                            $rate = round($row['rate'] / $count, 1);

                            $this->mysql()->query("UPDATE `film_stat` SET `rate` = {$rate}, `rate_count` = {$count} WHERE `filmId` = {$filmId} LIMIT 1");

                            /**
                             * Reset ratings page cache.
                             */
                            $redis = new \Redis();
                            $redisStatus = $redis->connect('127.0.0.1');
                            if ($redisStatus) {
                                $redis->delete('user:' . $user->data() . ':rate');
                            }
                        }
                    }


                }
            }
        }

        return $rate;
    }

    public function getRate()
    {
        $rate = 0;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $filmId = $post->fetchInt('id');

                if (0 < $filmId) {
                    $result = $this->mysql()->query("SELECT `rate` FROM `user_film_vote` WHERE `userId` = {$user->id()} AND `filmId` = {$filmId} LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $rate = intval($row['rate']);
                    }
                }
            }
        }

        return $rate;
    }
    
    public function addFilm()
    {
        $error = 1;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $folderId = $post->fetchInt('folderId');
                $filmId = $post->fetchInt('filmId');

                if (0 < $folderId && 0 < $filmId) {
                    $result = $this->mysql()->query("SELECT `userId` FROM `user_folder` WHERE `id` = {$folderId} AND `type` = 'film' LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        if ($user->id() == $row['userId']) {
                            $result = $this->mysql()->query("SELECT 1 FROM `film` WHERE `id` = {$filmId} LIMIT 1");
                            if (0 < $result->num_rows) {
                                $result = $this->mysql()->query("SELECT 1 FROM `user_folder_film` WHERE `folderId` = {$folderId} AND `filmId` = {$filmId} LIMIT 1");
                                if (0 < $result->num_rows) {
                                    $error = 2;
                                } else {
                                    $order = 1;
                                    $result = $this->mysql()->query("SELECT `order` FROM `user_folder_film` WHERE `folderId` = {$folderId} ORDER BY `order` DESC LIMIT 1");
                                    if ($row = $result->fetch_assoc()) {
                                        $order = $row['order'] + 1;
                                    }
                                    $this->mysql()->query("INSERT INTO `user_folder_film` SET `folderId` = {$folderId}, `order` = {$order}, `filmId` = {$filmId}");
                                    if (empty($this->mysql()->error)) {
                                        $error = 0;

                                        /**
                                         * Reset folder film content.
                                         */
                                        $redis = new \Redis();
                                        $redisStatus = $redis->connect('127.0.0.1');
                                        if ($redisStatus) {
                                            $redis->delete('user:' . $user->data() . ':film:' . $folderId . ':content');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $error;
    }
    
    public function deleteFolder()
    {
        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $id = $post->fetchInt('id');

                $result = $this->mysql()->query("SELECT `userId`, `status` FROM `user_folder` WHERE `id` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    if ($row['userId'] == $user->id()) {
                        $this->mysql()->query("DELETE FROM `user_folder` WHERE `id` = {$id} LIMIT 1");
                        $this->mysql()->query("DELETE FROM `user_folder_film` WHERE `folderId` = {$id}");

                        /**
                         * Stat.
                         */
                        $this->mysql()->query("UPDATE `user` SET `count_film` = `count_film` - 1 WHERE `id` = {$user->id()} LIMIT 1");
                        if ('public' == $row['status']) {
                            $this->mysql()->query("UPDATE `user` SET `count_film_pub` = `count_film_pub` - 1 WHERE `id` = {$user->id()} LIMIT 1");
                        }

                        /**
                         * Cache.
                         */
                        $this->clearFolderCache($user->data());
                    }
                }
            }
        }
    }

    public function editFolder()
    {
        $error = 2;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $name = $this->clearText($post->fetch('name'));

                if (!empty($name)) {
                    $id = $post->fetchInt('id');
                    $status = 'private';
                    if ('public' == $post->fetch('scope')) {
                        $status = 'public';
                    }
                    $name = $this->mysql()->real_escape_string($name);

                    $default = '';
                    if (0 == strcasecmp($name, 'Избранное')) {
                        $default = 'Избранное';
                    }
                    if (0 == strcasecmp($name, 'Смотреть в кино')) {
                        $default = 'Смотреть в кино';
                    }
                    if (0 == strcasecmp($name, 'Найти в интернете')) {
                        $default = 'Найти в интернете';
                    }
                    if (0 == strcasecmp($name, 'Купить на DVD')) {
                        $default = 'Купить на DVD';
                    }
                    if (0 == strcasecmp($name, 'Актеры')) {
                        $default = 'Актеры';
                    }
                    if (0 == strcasecmp($name, 'Актрисы')) {
                        $default = 'Актрисы';
                    }
                    if (0 == strcasecmp($name, 'Режиссеры')) {
                        $default = 'Режиссеры';
                    }

                    /**
                     * Check on unique.
                     */
                    if ('' != $default) {
                        $name = '';
                        $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' AND `default` = '{$default}' AND `id` != {$id} LIMIT 1");
                        if ($result->num_rows) {
                            $error = 1;
                        }
                    } else {
                        $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' AND `name` = '{$name}' AND `id` != {$id} LIMIT 1");
                        if ($result->num_rows) {
                            $error = 1;
                        }
                    }

                    if (2 == $error) {
                        $this->mysql()->query("UPDATE `user_folder` SET `status` = '{$status}', `name` = '{$name}', `default` = '{$default}' WHERE `id` = {$id} AND `userID` = {$user->id()} LIMIT 1");
                        if (!empty($this->mysql()->error)) {
                            $error = 2;
                        } else {
                            $error = 0;
                            $this->clearFolderCache($user->data());

                            $pub = 0;
                            $private = 0;
                            $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' AND `status` = 'public'");
                            if ($row = $result->fetch_assoc()) {
                                $pub = intval($row['count']);
                            }
                            $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film'");
                            if ($row = $result->fetch_assoc()) {
                                $private = intval($row['count']);
                            }
                            $this->mysql()->query("UPDATE `user` SET `count_film` = {$private}, `count_film_pub` = {$pub} WHERE `id` = {$user->id()} LIMIT 1");
                        }
                    }

                }
            }
        }

        return $error;
    }

    public function addFolder()
    {
        $error = 0;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();

                $name = $this->clearText($post->fetch('name'));

                if (!empty($name)) {
                    $type = 'film';
                    $order = 1;
                    $status = 'private';
                    if ('public' == $post->fetch('scope')) {
                        $status = 'public';
                    }
                    $name = $this->mysql()->real_escape_string($name);
                    $default = '';
                    if (0 == strcasecmp($name, 'Избранное')) {
                        $default = 'Избранное';
                    }
                    if (0 == strcasecmp($name, 'Смотреть в кино')) {
                        $default = 'Смотреть в кино';
                    }
                    if (0 == strcasecmp($name, 'Найти в интернете')) {
                        $default = 'Найти в интернете';
                    }
                    if (0 == strcasecmp($name, 'Купить на DVD')) {
                        $default = 'Купить на DVD';
                    }
                    if (0 == strcasecmp($name, 'Актеры')) {
                        $default = 'Актеры';
                    }
                    if (0 == strcasecmp($name, 'Актрисы')) {
                        $default = 'Актрисы';
                    }
                    if (0 == strcasecmp($name, 'Режиссеры')) {
                        $default = 'Режиссеры';
                    }

                    /**
                     * Check on unique.
                     */
                    if ('' != $default) {
                        $name = '';
                        $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' AND `default` = '{$default}' LIMIT 1");
                        if ($result->num_rows) {
                            $error = 1;
                        }
                    } else {
                        $result = $this->mysql()->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' AND `name` = '{$name}' LIMIT 1");
                        if ($result->num_rows) {
                            $error = 1;
                        }
                    }

                    if (1 > $error) {
                        $result = $this->mysql()->query("SELECT `order` FROM `user_folder` WHERE `userId` = {$user->id()} AND `type` = 'film' ORDER BY `order` DESC LIMIT 1");
                        if ($row = $result->fetch_assoc()) {
                            $order = $row['order'] + 1;
                        }

                        $this->mysql()->query("INSERT INTO `user_folder` SET `userId` = {$user->id()}, `type` = '{$type}', `order` = {$order}, `status` = '{$status}', `name` = '{$name}', `default` = '{$default}'");
                        if (empty($this->mysql()->error)) {
                            $error = $this->mysql()->insert_id;

                            /**
                             * Stat.
                             */
                            $this->mysql()->query("UPDATE `user` SET `count_film` = `count_film` + 1 WHERE `id` = {$user->id()} LIMIT 1");
                            if ('public' == $status) {
                                $this->mysql()->query("UPDATE `user` SET `count_film_pub` = `count_film_pub` + 1 WHERE `id` = {$user->id()} LIMIT 1");
                            }

                            /**
                             * Cache.
                             */
                            $this->clearFolderCache($user->data());
                        }
                    } else {
                        $error = 0;
                    }
                }
            }
        }

        return $error;
    }


    public function order()
    {
        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $data = json_decode($post->fetch('data'), true);

                $order = 1;
                foreach ($data as $id) {
                    $id = intval($id);
                    if (0 < $id) {
                        $this->mysql()->query("UPDATE `user_folder` SET `order` = {$order} WHERE `id` = {$id} LIMIT 1");
                        $order++;
                    }
                }

                $this->clearFolderCache($user->data());
            }
        }
    }
    
    public function orderItem()
    {
        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $data = json_decode($post->fetch('data'), true);
                $data = array_reverse($data);

                $idList = [];
                foreach ($data as $id) {
                    $id = intval($id);
                    if (0 < $id) {
                        $idList[] = $id;
                    }
                }
                $idList = implode(',', $idList);
                $result = $this->mysql()->query("SELECT MIN(`order`) as `order`, ANY_VALUE(`folderId`) as `folderId` FROM `user_folder_film` WHERE `id` IN ({$idList})");
                if ($row = $result->fetch_assoc()) {
                    $order = $row['order'];

                    /**
                     * Reset folder film content.
                     */
                    $folderId = intval($row['folderId']);
                    $redis = new \Redis();
                    $redisStatus = $redis->connect('127.0.0.1');
                    if ($redisStatus) {
                        $redis->delete('user:' . $user->data() . ':film:' . $folderId . ':content');
                    }
                } else {
                    $order = 1;
                }

                foreach ($data as $id) {
                    $id = intval($id);
                    if (0 < $id) {
                        $this->mysql()->query("UPDATE `user_folder_film` SET `order` = {$order} WHERE `id` = {$id} LIMIT 1");
                        $order++;
                    }
                }
            }
        }
    }

    public function moveItem()
    {
        $error = 1;

        if (isset($_COOKIE['__user__'])) {
            $user = (new Access($this->mysql()))->getUser();
            if (0 < $user->id()) {
                $post = new PostBag();
                $folderId = $post->fetchInt('folderId');
                $id = $post->fetchInt('id');

                if (0 == $folderId) {
                    /**
                     * Delete item.
                     */
                    $result = $this->mysql()->query("SELECT `folderId` FROM `user_folder_film` WHERE `id` = {$id} LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $folderId = intval($row['folderId']);
                        $result = $this->mysql()->query("SELECT `userId` FROM `user_folder` WHERE `id` = {$folderId} AND `type` = 'film' LIMIT 1");
                        if ($row = $result->fetch_assoc()) {
                            if ($user->id() == $row['userId']) {
                                $this->mysql()->query("DELETE FROM `user_folder_film` WHERE `id` = {$id} LIMIT 1");
                                if (empty($this->mysql()->error)) {
                                    $error = 0;

                                    /**
                                     * Reset folder film content.
                                     */
                                    $redis = new \Redis();
                                    $redisStatus = $redis->connect('127.0.0.1');
                                    if ($redisStatus) {
                                        $redis->delete('user:' . $user->data() . ':film:' . $folderId . ':content');
                                    }
                                }
                            }
                        }
                    }
                } else {
                    /**
                     * Move item.
                     */
                    if (0 < $folderId && 0 < $id) {
                        $result = $this->mysql()->query("SELECT `userId` FROM `user_folder` WHERE `id` = {$folderId} AND `type` = 'film' LIMIT 1");
                        if ($row = $result->fetch_assoc()) {
                            if ($user->id() == $row['userId']) {
                                $result = $this->mysql()->query("SELECT `folderId`, `filmId` FROM `user_folder_film` WHERE `id` = {$id} LIMIT 1");
                                if ($row = $result->fetch_assoc()) {
                                    /**
                                     * Reset folder film content.
                                     */
                                    $redis = new \Redis();
                                    $redisStatus = $redis->connect('127.0.0.1');
                                    if ($redisStatus) {
                                        $redis->delete('user:' . $user->data() . ':film:' . $row['folderId'] . ':content');
                                    }

                                    $filmId = $row['filmId'];
                                    $result = $this->mysql()->query("SELECT 1 FROM `user_folder_film` WHERE `folderId` = {$folderId} AND `filmId` = {$filmId} LIMIT 1");
                                    if (0 < $result->num_rows) {
                                        $error = 2;
                                    } else {
                                        $order = 1;
                                        $result = $this->mysql()->query("SELECT `order` FROM `user_folder_film` WHERE `folderId` = {$folderId} ORDER BY `order` DESC LIMIT 1");
                                        if ($row = $result->fetch_assoc()) {
                                            $order = $row['order'] + 1;
                                        }

                                        $this->mysql()->query("UPDATE `user_folder_film` SET `folderId` = {$folderId}, `order` = {$order} WHERE `id` = {$id}");
                                        if (empty($this->mysql()->error)) {
                                            $error = 0;

                                            /**
                                             * Reset folder film content.
                                             */
                                            $redis = new \Redis();
                                            $redisStatus = $redis->connect('127.0.0.1');
                                            if ($redisStatus) {
                                                $redis->delete('user:' . $user->data() . ':film:' . $folderId . ':content');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $error;
    }

    public function folderContent(Request $request)
    {
        $list = [];

        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $get = new GetBag();
                $post = new PostBag();
                $folderId = $post->fetchInt('id');
                $page = $get->fetchInt('page');
                if (0 < $folderId && 0 < $page) {
                    if (!isset($_COOKIE['__user__']) && 1 == $page) {
                        $redis = new \Redis();
                        $redisStatus = $redis->connect('127.0.0.1');

                        $key = 'user:' . $login . ':film:' . $folderId . ':content';
                        if ($redisStatus && $redis->exists($key)) {
                            $list = unserialize($redis->get($key));
                        } else {
                            $offset = ($page - 1) * 50;
                            $result = $this->mysql()->query("SELECT t1.`id` as `item`, t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t3.`rate`, t3.`rate_count`
                                                     FROM (SELECT `id` FROM `user_folder_film` WHERE `folderId` = {$folderId} ORDER BY `order` DESC LIMIT {$offset}, 50) as `t`
                                                     JOIN `user_folder_film` as `t1` ON t1.`id` = t.`id`
                                                     JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                                     LEFT JOIN `film_stat` as `t3` ON t1.`filmId` = t3.`filmId`
                                                     WHERE t2.`status` = 'show' ORDER BY t1.`order` DESC LIMIT {$offset}, 50");
                            while ($row = $result->fetch_assoc()) {
                                if (10 > $row['rate_count']) {
                                    $row['rate'] = 0;
                                }
                                $list[] = [$row['id'], Server::STATIC[$row['s']], $row['image'], $row['name_origin'], $row['name_ru'], $row['item'], $row['rate']];
                            }

                            if ([] != $list) {
                                if (!Wrap::$debugEnabled && $redisStatus) {
                                    $redis->set($key, serialize($list), 720); // 12 min
                                }
                            }
                        }
                    } else {
                        $offset = ($page - 1) * 50;
                        $result = $this->mysql()->query("SELECT t1.`id` as `item`, t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t3.`rate`, t3.`rate_count`
                                                     FROM `user_folder_film` as `t1` JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                                     LEFT JOIN `film_stat` as `t3` ON t1.`filmId` = t3.`filmId`
                                                     WHERE t1.`folderId` = {$folderId} AND t2.`status` = 'show' ORDER BY t1.`order` DESC LIMIT {$offset}, 50");
                        while ($row = $result->fetch_assoc()) {
                            if (10 > $row['rate_count']) {
                                $row['rate'] = 0;
                            }
                            $list[] = [$row['id'], Server::STATIC[$row['s']], $row['image'], $row['name_origin'], $row['name_ru'], $row['item'], $row['rate']];
                        }
                    }
                }
            }
        }

        return $list;
    }

    public function folderList(Request $request)
    {
        $list = [];

        preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches);
        $login = $matches[2];

        if (!empty($login)) {
            if (preg_match('/^[A-Za-z0-9_-]{2,64}$/u', $login)) {
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');

                $key = 'user:' . $login . ':film:folder';
                if ($redisStatus && $redis->exists($key)) {
                    $list = unserialize($redis->get($key));
                } else {
                    $id = 0;
                    if (isset($_COOKIE['__user__'])) {
                        $user = (new Access($this->mysql()))->getUser();
                        $id = $user->id();
                        if ($login != $user->data()) {
                            $id = 0;
                        }
                    }

                    if (0 < $id) {
                        $result = $this->mysql()->query("SELECT `id`, `status` ,`name`, `default` FROM `user_folder` WHERE `userId` = {$id} AND `type` = 'film' AND `status` IN ('public','private') ORDER BY `order`");
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            if (empty($name)) {
                                $name = $row['default'];
                            }
                            $list[] = [$row['id'], $name, $row['status']];
                        }
                    } else {
                        $login = $this->mysql()->real_escape_string($login);
                        $result = $this->mysql()->query("SELECT t2.`id` ,t2.`name`, t2.`default` FROM `user` as `t1` JOIN `user_folder` as `t2` ON t1.`id` = t2.`userId`
                                                    WHERE t1.`login` = '{$login}' AND t2.`type` = 'film' AND t2.`status` = 'public' ORDER BY t2.`order`");
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            if (empty($name)) {
                                $name = $row['default'];
                            }
                            $list[] = [$row['id'], $name];
                        }
                    }

                    if ([] != $list) {
                        if (!Wrap::$debugEnabled && $redisStatus) {
                            $redis->set($key, serialize($list), 172800); // 2 days
                        }
                    }
                }
            }
        }

        return $list;
    }
    
    private function clearFolderCache($login)
    {
        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('user:' . $login . ':film:folder')) {
            $redis->delete('user:' . $login . ':film:folder');
        }
    }
}