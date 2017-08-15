<?php
namespace Kinomania\Control\User;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

class User extends DB
{
    /**
     * Block user by ID.
     * @param int $id
     */
    public function block($id)
    {
        $id = intval($id);

        $this->db->query("UPDATE `user` SET `status` = 'banned' WHERE `id` = {$id} LIMIT 1");

        /**
         * Delete token.
         */
        $this->db->query("DELETE FROM `user_token` WHERE `userId` = {$id}");
    }

    /**
     * Unblock user by ID.
     * @param int $id
     */
    public function unblock($id)
    {
        $id = intval($id);

        $this->db->query("UPDATE `user` SET `status` = 'active' WHERE `id` = {$id} LIMIT 1");
    }

    /**
     * Unblock user by ID.
     * @param int $id
     */
    public function activate($id)
    {
        $id = intval($id);

        $this->db->query("UPDATE `user` SET `status` = 'active' WHERE `id` = {$id} LIMIT 1");

        /**
         * Create favorite directories for new user.
         */
        $result = $this->db->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$id} AND `type` = 'film' AND `default` = 'Избранное' LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->db->query("INSERT INTO `user_folder` SET `userId` = {$id}, `type` = 'film', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
        }

        $result = $this->db->query("SELECT 1 FROM `user_folder` WHERE `userId` = {$id} AND `type` = 'people' AND `default` = 'Избранное' LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->db->query("INSERT INTO `user_folder` SET `userId` = {$id}, `type` = 'people', `order` = 1, `status` = 'public', `name` = '', `default` = 'Избранное'");
        }
    }

    /**
     * Update entity.
     * @return mixed
     */
    public function edit()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $email = $post->fetchEscape('email', $this->db);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password = $post->fetch('password');
            if (0 != strlen($password) && 3 > strlen($password)) {
                $this->error = self::EMPTY_PASSWORD;
            } else {
                $result = $this->db->query("SELECT 1 FROM `user` WHERE `id` != {$id} AND `email` = '{$email}' LIMIT 1");
                if (1 == $result->num_rows) {
                    $this->error = self::EMAIL_EXIST;
                } else {
                    $item = new Item();
                    $db = $this->db;
                    $item->initFromPost(function ($val) use ($db) {
                        $val = htmlspecialchars_decode($val);
                        $val = html_entity_decode($val);
                        $val = strip_tags($val);
                        return $db->real_escape_string($val);
                    });

                    if (empty($item->birthday())) {
                        $birthday = 'null';
                    } else {
                        $birthday = explode('.', $item->birthday());
                        $birthday = $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0];
                        $birthday = '\'' . $birthday . '\'';
                    }

                    $this->db->query("
                          UPDATE `user` SET
                          `email` = '{$item->email()}',
                          `name` = '{$item->name()}',
                          `surname` = '{$item->surname()}',
                          `sex` = '{$item->sex()}',
                          `city` = '{$item->city()}',
                          `about` = '{$item->about()}',
                          `interest` = '{$item->interest()}',
                          `birthday` = {$birthday},
                          `vk` = '{$item->vk()}',
                          `fb` = '{$item->fb()}',
                          `ok` = '{$item->ok()}',
                          `twitter` = '{$item->twitter()}',
                          `googlePlus` = '{$item->googlePlus()}',
                          `liveJournal` = '{$item->liveJournal()}',
                          `tg` = '{$item->tg()}',
                          `myMail` = '{$item->myMail()}',
                          `instagram` = '{$item->instagram()}',
                          `skype` = '{$item->skype()}',
                          `icq` = '{$item->icq()}'
                          WHERE `id` = {$id} LIMIT 1
                        ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }

                    if (!empty($password)) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $this->db->query("
                            UPDATE `user` SET
                            `password` = '{$password}'
                            WHERE `id` = {$id} LIMIT 1
                        ");
                    }

                    return true;
                }
            }
        } else {
            $this->error = self::WRONG_EMAIL;
        }

        return false;
    }

    /**
     * Delete entity.
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $id = intval($id);

        $result = $this->db->query("SELECT `image` FROM `user` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            /**
             * Avatar.
             */
            $extension = $row['image'];
            if (!empty($extension)) {
                
            }

            $this->db->query("DELETE FROM `user` WHERE `id` = {$id}");

            /**
             * Folders.
             */
            $result = $this->db->query("SELECT `id`, `type` FROM `user_folder` WHERE `userId` = {$id}");
            while ($row = $result->fetch_assoc()) {
                $folderId = intval($row['id']);
                if ('film' == $row['type']) {
                    $this->db->query("DELETE FROM `user_folder_film` WHERE `folderId` = {$folderId}");
                } else {
                    $this->db->query("DELETE FROM `user_folder_person` WHERE `folderId` = {$folderId}");
                }
            }
            $this->db->query("DELETE FROM `user_folder` WHERE `userId` = {$id}");
        }
        $this->db->query("DELETE FROM `moderate` WHERE `userId` = {$id}");


        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus) {
            if ($redis->exists('user:' . $id . ':min')) {
                $redis->delete('user:' . $id . ':min');
            }
            if ($redis->exists('user:' . $id . ':stat')) {
                $redis->delete('user:' . $id . ':stat');
            }
        }
    }

    /**
     * Get entity.
     * @param $id
     * @return mixed
     */
    public function getById($id): Item
    {
        $id = intval($id);

        $item = new Item();

        $result = $this->db->query("SELECT * FROM `user` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @return mixed
     */
    public function getXml()
    {
        $xml = new \SimpleXMLElement('<xml/>');

        $result = $this->db->query("SELECT `login`, `email`, `name`, `surname` FROM `user` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = $row['surname'] . ' ' . $row['name'];
            $user = $xml->addChild('user');
            $user->addChild('login', $row['login']);
            $user->addChild('email', $row['email']);
            $user->addChild('name', htmlspecialchars($name));
        }
        
        return $xml->asXML();
    }

    /**
     * Get json data for DataTable plugin.
     * @param null $type
     * @return mixed
     */
    public function renderTable($type = null)
    {
        $get = new GetBag();

        $text = false;
        $search = $get->fetch('search');
        if (!preg_match('/^[1-9][0-9]*$/', $search['value'])) {
            $search = trim($search['value']);
            if (!empty($search)) {
                $text = true;
            }
        } else {
            $search = intval($search['value']);
        }

        $total = 0;
        if ($text) {
            $search = $this->db->real_escape_string($search);
            $result = $this->db->query("SELECT COUNT(*) AS `count` FROM (
                                        SELECT `id` FROM `user` WHERE `login` LIKE '{$search}%' 
                                        UNION SELECT `id` FROM `user` WHERE `email` LIKE '{$search}%' 
                                        ) as T");
        } else {
            if (0 == $search) {
                $result = $this->db->query("SELECT COUNT(*) AS `count` FROM `user`");
            } else {
                $result = $this->db->query("SELECT COUNT(*) AS `count` FROM `user` WHERE `id` = {$search}");
            }
        }
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'id';
                break;
            default:
                $order = 'id';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        if ($text) {
            $query = "SELECT `id`, `login`, `email`, `status`, `count_review`, `count_feedback`, `count_comment` FROM (
                      SELECT `id`, `login`, `email`, `status`, `count_review`, `count_feedback`, `count_comment` FROM `user` WHERE `login` LIKE '{$search}%' 
                      UNION SELECT `id`, `login`, `email`, `status`, `count_review`, `count_feedback`, `count_comment` FROM `user` WHERE `email` LIKE '{$search}%' ";
            $query .= ") as `t` ORDER BY t.`{$order}` {$direction} LIMIT {$offset}, {$length}";
        } else {
            $query = "SELECT t1.`id`, t1.`login`, t1.`email`, t1.`status`, t1.`count_review`, t1.`count_feedback`, t1.`count_comment` FROM `user` AS `t1` ";
            if (0 != $search) {
                $query .= " WHERE `id` = {$search} ";
            }
            $query .= " ORDER BY t1.`{$order}` {$direction} LIMIT {$offset}, {$length}";
        }

        $filtered = $total;

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $item[0] = $row['id'];
            $item[1] = $row['login'];
            $item[2] = $row['email'];
            $item[3] = $row['count_review'];
            $item[4] = $row['count_feedback'];
            $item[5] = $row['count_comment'];
            $item[6] = $row['status'];

            $data[] = $item;
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data
        ];

        return json_encode($data);
    }

    const WRONG_EMAIL = '1';
    const EMPTY_PASSWORD = '2';
    const EMAIL_EXIST = '3';
}