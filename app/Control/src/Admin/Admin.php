<?php
namespace Kinomania\Control\Admin;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

/**
 * Class Admin
 * @package Kinomania\Control\Admin
 */
class Admin extends DB
{
    const WRONG_EMAIL = 'WRONG_EMAIL';
    const EMPTY_PASSWORD = 'EMPTY_PASSWORD';
    const EMAIL_EXIST = 'EMAIL_EXIST';
    
    public function getAdminList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT `id`, `name`, `surname` FROM `admin` ORDER BY `surname`");
        while ($row = $result->fetch_assoc()) {
            $name = $row['surname'] . ' ' . $row['name'];
            $list[$row['id']] = $name;
        }
        
        return $list;
    }
    
    public function getUserList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT t1.`userId`, t1.`name`, t1.`surname`, t2.`login`
                                    FROM `admin` as `t1` 
                                    JOIN `user` as `t2` ON t1.`userId` = t2.`id`
                                    ORDER BY t1.`surname`");
        while ($row = $result->fetch_assoc()) {
            $name = $row['surname'] . ' ' . $row['name'] . ' [' . $row['login'] . ']';
            $list[$row['userId']] = $name;
        }
        
        return $list;
    }

    /**
     * Block user by ID.
     * @param int $id
     */
    public function block($id)
    {
        $id = intval($id);
        
        $this->db->query("UPDATE `admin` SET `status` = 'banned' WHERE `id` = {$id} LIMIT 1");

        /**
         * Delete token.
         */
        $this->db->query("DELETE FROM `admin_token` WHERE `userId` = {$id}");
    }

    /**
     * Unblock user by ID.
     * @param int $id
     */
    public function unblock($id)
    {
        $id = intval($id);
        
        $this->db->query("UPDATE `admin` SET `status` = 'active' WHERE `id` = {$id} LIMIT 1");
    }

    /**
     * Add new active administrator.
     * @return bool
     */
    public function add()
    {
        $post = new PostBag();
        
        $email = $post->fetchEscape('email', $this->db);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password = $post->fetch('password');
            if (3 > strlen($password)) {
                $this->error = self::EMPTY_PASSWORD;
            } else {
                $result = $this->db->query("SELECT 1 FROM `admin` WHERE `email` = '{$email}' LIMIT 1");
                if (1 == $result->num_rows) {
                    $this->error = self::EMAIL_EXIST;
                } else {
                    $groupId = $post->fetchInt('group');
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $name = $post->fetchEscape('name', $this->db);
                    $surname = $post->fetchEscape('surname', $this->db);
                    $userId = $post->fetchInt('userId');
                    
                    $this->db->query("
                          INSERT INTO `admin` SET
                          `groupId` = {$groupId},
                          `email` = '{$email}',
                          `password` = '{$password}',
                          `status` = 'active',
                          `hash` = '',
                          `hashChange` = FROM_UNIXTIME(0),
                          `name` = '{$name}',
                          `surname` = '{$surname}',
                          `userId` = {$userId}
                        ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }

                    if (0 < $groupId) {
                        $this->db->query("UPDATE `admin_group` SET `userCount` = `userCount` + 1 WHERE `id` = {$groupId} LIMIT 1");
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
     * Edit administrator profile (cant change group).
     * @return bool
     */
    public function editProfile()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $email = $post->fetchEscape('email', $this->db);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password = $post->fetch('password');
            if (0 != strlen($password) && 3 > strlen($password)) {
                $this->error = self::EMPTY_PASSWORD;
            } else {
                $result = $this->db->query("SELECT 1 FROM `admin` WHERE `id` != {$id} AND `email` = '{$email}' LIMIT 1");
                if (1 == $result->num_rows) {
                    $this->error = self::EMAIL_EXIST;
                } else {
                    $name = $post->fetchEscape('name', $this->db);
                    $surname = $post->fetchEscape('surname', $this->db);
                    $userId = $post->fetchInt('userId');

                    $this->db->query("
                          UPDATE `admin` SET
                          `email` = '{$email}',
                          `name` = '{$name}',
                          `surname` = '{$surname}',
                          `userId` = {$userId}
                          WHERE `id` = {$id} LIMIT 1
                        ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }

                    if (!empty($password)) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $this->db->query("
                            UPDATE `admin` SET
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
     * Edit administrator.
     * @return bool
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
                $result = $this->db->query("SELECT 1 FROM `admin` WHERE `id` != {$id} AND `email` = '{$email}' LIMIT 1");
                if (1 == $result->num_rows) {
                    $this->error = self::EMAIL_EXIST;
                } else {
                    $groupId = $post->fetchInt('group');
                    $name = $post->fetchEscape('name', $this->db);
                    $surname = $post->fetchEscape('surname', $this->db);
                    $userId = $post->fetchInt('userId');

                    $this->db->query("
                          UPDATE `admin` SET
                          `groupId` = {$groupId},
                          `email` = '{$email}',
                          `name` = '{$name}',
                          `surname` = '{$surname}',
                          `userId` = {$userId}
                          WHERE `id` = {$id} LIMIT 1
                        ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }

                    if (!empty($password)) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $this->db->query("
                            UPDATE `admin` SET
                            `password` = '{$password}'
                            WHERE `id` = {$id} LIMIT 1
                        ");
                    }

                    /**
                     * Fix group users count.
                     */
                    $groupIdPrev = $post->fetchInt('groupIdPrev');
                    if ($groupId != $groupIdPrev) {
                        if (0 < $groupIdPrev) {
                            $this->db->query("UPDATE `admin_group` SET `userCount` = `userCount` - 1 WHERE `id` = {$groupIdPrev} LIMIT 1");
                        }
                        if (0 < $groupId) {
                            $this->db->query("UPDATE `admin_group` SET `userCount` = `userCount` + 1 WHERE `id` = {$groupId} LIMIT 1");
                        }
                        $this->db->query("DELETE FROM `admin_token` WHERE `groupId` = {$groupIdPrev}");
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
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $id = intval($id);

        $result = $this->db->query("SELECT `groupId` FROM `admin` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (0 < $row['groupId']) {
                $this->db->query("UPDATE `admin_group` SET `userCount` = `userCount` - 1 WHERE `id` = {$row['groupId']} LIMIT 1");
            }
        }
        $this->db->query("DELETE FROM `admin` WHERE `id` = {$id} LIMIT 1");
    }

    /**
     * @param int $id
     * @return Item
     */
    public function getById($id): Item
    {
        $id = intval($id);

        $admin = new Item();

        $result = $this->db->query("SELECT * FROM `admin` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $admin->initFromArray($row);
        }

        return $admin;
    }


    /**
     * Get json data for DataTable plugin.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

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

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        /**
         * Data query.
         */
        $search = $get->fetch('search');
        $search = trim($search['value']);

        $query = "SELECT t1.`id`, t1.`email`, t1.`status`, CONCAT_WS(' ', t1.`name`, t1.`surname`) as `name`, t2.`name` as `group` FROM `admin` as `t1` LEFT JOIN `admin_group` as `t2` ON t1.`groupId` = t2.`id` ";
        if (!empty($search)) {
            $query .= " WHERE t1.`email` LIKE '{$search}%' ";
        }

        /**
         * Count of data.
         */
        $total = 0;
        $result = $this->db->query(str_replace('t1.`id`, t1.`email`, t1.`status`, CONCAT_WS(\' \', t1.`name`, t1.`surname`) as `name`, t2.`name` as `group`', 'COUNT(*) AS `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }
        $filtered = $total;

        $query .= " ORDER BY t1.`{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            if (null == $row['group']) {
                $row['group'] = 'Вне групп';
            }
            $item[0] = $row['id'];
            $item[1] = $row['email'];
            $item[2] = $row['name'];
            $item[3] = $row['group'];
            $item[4] = $row['status'];
            $item[5] = '';

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
}