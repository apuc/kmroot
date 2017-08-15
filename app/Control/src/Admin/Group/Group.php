<?php
namespace Kinomania\Control\Admin\Group;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

/**
 * Class Group
 * @package Kinomania\Control\Admin
 */
class Group extends DB
{
    const GROUP_EXIST = 'GROUP_EXIST';

    /**
     * Get group list.
     * @return array
     */
    public function getList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT `id`, `name` FROM `admin_group` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }

    /**
     * Add new administrator group.
     * @return bool
     */
    public function add()
    {
        $post = new PostBag();
        $name = $post->fetchEscape('name', $this->db);
        $lowerName = strtolower($name);
        $result = $this->db->query("SELECT 1 FROM `admin_group` WHERE LOWER(`name`) = '{$lowerName}' LIMIT 1");
        if (0 == $result->num_rows) {
            $this->db->query("INSERT INTO `admin_group` SET `name` = '{$name}', `userCount` = 0");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
            return true;
        } else {
            $this->error = self::GROUP_EXIST;
        }
        
        return false;
    }

    /**
     * Save administrator group.
     * @return bool
     */
    public function edit()
    {
        $post = new PostBag();
        $name = $post->fetchEscape('name', $this->db);
        $id = $post->fetchInt('id');
        if (0 < $id) {
            $lowerName = strtolower($name);
            $result = $this->db->query("SELECT 1 FROM `admin_group` WHERE `id` != {$id} AND LOWER(`name`) = '{$lowerName}' LIMIT 1");
            if (0 == $result->num_rows) {
                $this->db->query("UPDATE `admin_group` SET `name` = '{$name}' WHERE `id` = {$id} LIMIT 1");
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }
                return true;
            } else {
                $this->error = self::GROUP_EXIST;
            }
        }

        return false;
    }

    /**
     * Delete administrator group, change admin groupId to zero.
     * @return bool
     */
    public function delete()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        if (0 < $id) {
            $this->db->query("UPDATE `admin` SET `groupId` = 0 WHERE `groupId` = {$id}");
            $this->db->query("DELETE FROM `admin_group` WHERE `id` = {$id} LIMIT 1");
            $this->db->query("DELETE FROM `admin_token` WHERE `groupId` = {$id} LIMIT 1");
            return true;
        }

        return false;
    }

    /**
     * Get administrator group by ID.
     * @param $id
     * @return Item
     */
    public function getByID($id): Item
    {
        $id = intval($id);
        $group = new Item();

        if (0 < $id) {
            $result = $this->db->query("SELECT * FROM `admin_group` WHERE `id` = {$id} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $group->initFromArray($row);
            }
        }

        return $group;
    }

    /**
     * Get json data for DataTable plugin.
     * @param null $type
     * @return mixed
     */
    public function renderTable($type = null)
    {
        switch ($type) {
            case 'groupAdmin':
                return $this->groupAdminList();
            default:
                return $this->groupList();
        }
    }

    /**
     * @return string
     */
    private function groupList()
    {
        $get = new GetBag();

        $total = 0;
        $result = $this->db->query("SELECT COUNT(*) AS `count` FROM `admin_group`");
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

        $query = "SELECT `id`, `name`, `userCount` FROM `admin_group` ";

        /**
         * Total count.
         */
        $total = 0;
        $result = $this->db->query(str_replace('`id`, `name`, `userCount`', 'COUNT(*) AS `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";

        $filtered = $total;

        $data = [];

        if ('asc' == $direction) {
            $total0 = 0;
            $result = $this->db->query("SELECT COUNT(*) AS `count` FROM `admin` WHERE `groupId` = 0");
            if ($row = $result->fetch_assoc()) {
                $total0 = $row['count'];
            }
            $data[] = [
                0, 'Вне групп', $total0, ''
            ];
        }
        $total++;
        $filtered++;

        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $item[0] = $row['id'];
            $item[1] = $row['name'];
            $item[2] = $row['userCount'];
            $item[3] = '';

            $data[] = $item;
        }

        if ('desc' == $direction) {
            $total0 = 0;
            $result = $this->db->query("SELECT COUNT(*) AS `count` FROM `admin` WHERE `groupId` = 0");
            if ($row = $result->fetch_assoc()) {
                $total0 = $row['count'];
            }
            $data[] = [
                0, 'Вне групп', $total0, ''
            ];
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data
        ];

        return json_encode($data);
    }

    /**
     * @return string
     */
    private function groupAdminList()
    {
        $get = new GetBag();

        $groupId = $get->fetchInt('groupId');

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

        $query = "SELECT `id`, `email`, `status`, CONCAT_WS(' ', `name`, `surname`) as `name` FROM `admin` WHERE `groupId` = {$groupId} ";
        if (!empty($search)) {
            $query .= " AND `email` LIKE '{$search}%' ";
        }

        /**
         * Total count.
         */
        $total = 0;
        $result = $this->db->query(str_replace('`id`, `email`, `status`, CONCAT_WS(\' \', `name`, `surname`) as `name`', 'COUNT(*) AS `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $item[0] = $row['id'];
            $item[1] = $row['email'];
            $item[2] = $row['name'];

            $data[] = $item;
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];

        return json_encode($data);
    }
}