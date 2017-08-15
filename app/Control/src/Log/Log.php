<?php
namespace Kinomania\Control\Log;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;

/**
 * Class Log
 * @package Kinomania\Control\Log
 */
class Log extends DB
{
    use TDate;

    /**
     * @param int $id
     * @return Item
     */
    public function getById($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `log` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $row['date'] = $this->formatDate($row['date'], true, ' ');
            $data = '';
            if (!empty($row['data'])) {
                $data = unserialize($row['data']);
            }
            $row['data'] = $data;
            $item->initFromArray($row);
        }

        return $item;
    }
    
    /**
     * @param int $adminId
     * @param string $route
     * @param string $handler
     * @param bool $error
     * @param string $comment
     * @param string $data
     * @param string $method
     */
    public function add($adminId, $route, $handler, $error, $comment, $data = '', $method = 'GET')
    {
        if (1 == mt_rand(0, 32)) {
            $stamp = strtotime('now') - 7776000; // 3 month
            $this->db->query("DELETE FROM `log` WHERE `date` < FROM_UNIXTIME('{$stamp}')");
        }

        $adminId = intval($adminId);
        $route = $this->db->real_escape_string($route);
        $handler = $this->db->real_escape_string($handler);
        $comment = $this->db->real_escape_string($comment);
        $data = $this->db->real_escape_string($data);
        $method = $this->db->real_escape_string($method);
        if ($error) {
            $error = 'true';
        } else {
            $error = 'false';
        }

        $objId = (new PostBag())->fetchInt('id');

        $this->db->query("INSERT INTO `log` SET `adminId` = {$adminId}, `route` = '{$route}', `handler` = '{$handler}', `error` = '{$error}', `comment` = '{$comment}', `data` = '{$data}', `objId` = {$objId}, `method` = '{$method}'");
    }

    /**
     * Get json data for DataTable plugin.
     * @return mixed
     */
    public function renderTable()
    {

        $old = strtotime('now') - 2592003;
        $this->db->query("DELETE FROM `log` WHERE `date` <= FROM_UNIXTIME('{$old}')");
        
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
        $adminId = $get->fetchInt('adminId');
        $objId = $get->fetchInt('objId');
        $from = $get->fetch('from');
        $to = $get->fetch('to');
        if (!empty($from)) {
            $from = strtotime($from);
            $from = $this->db->real_escape_string($from);
        }
        if (!empty($to)) {
            $to = strtotime($to) + 86399;
            $to = $this->db->real_escape_string($to);
        }

        /**
         * Count of data.
         */
        $query = "SELECT COUNT(*) as `count` FROM `log` WHERE 1 ";
        if (!empty($from) && !empty($to)) {
            $query .= " AND `date` >= FROM_UNIXTIME('{$from}') AND `date` <= FROM_UNIXTIME('{$to}') ";
        } else if (!empty($from)) {
            $query .= " AND `date` >= FROM_UNIXTIME('{$from}') ";
        } else if (!empty($to)) {
            $query .= " AND `date` <= FROM_UNIXTIME('{$to}')";
        }
        if (0 < $adminId) {
            $query .= " AND `adminId` = {$adminId} ";
        }
        if (0 < $objId) {
            $query .= " AND `objId` = {$objId} ";
        }
        $total = 0;
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }
        $filtered = $total;

        /**
         * Get data.
         */
        $query = "SELECT t1.`id`, t1.`date`, t1.`adminId`, t1.`route`, t1.`handler`, t1.`error`, t1.`comment`, t1.`objId`, t1.`method`, t2.`email` FROM (SELECT `id` FROM `log` WHERE 1 ";

        if (!empty($from) && !empty($to)) {
            $query .= " AND `date` >= FROM_UNIXTIME('{$from}') AND `date` <= FROM_UNIXTIME('{$to}') ";
        } else if (!empty($from)) {
            $query .= " AND `date` >= FROM_UNIXTIME('{$from}') ";
        } else if (!empty($to)) {
            $query .= " AND `date` <= FROM_UNIXTIME('{$to}')";
        }

        if (0 < $adminId) {
            $query .= " AND `adminId` = {$adminId} ";
        }
        if (0 < $objId) {
            $query .= " AND `objId` = {$objId} ";
        }

        $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length} ) as `sq` ";

        $query .= " JOIN `log` as `t1` ON sq.`id` = t1.`id` LEFT JOIN `admin` as `t2` ON t1.`adminId` = t2.`id` ";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $admin = $row['email'];
            if (empty($admin)) {
                $admin = 'ID: ' . $row['adminId'];
            }
            $error = '0';
            if ('true' == $row['error']) {
                $error = '1';
            }
            
            $item[0] = $this->formatDate($row['date'], true);
            $item[1] = $admin;
            $item[2] = $row['route'];
            $item[3] = $row['handler'];
            $item[4] = $error;
            $item[5] = $row['comment'];
            $item[6] = $row['id'];
            $item[7] = $row['objId'];
            $item[8] = $row['method'];

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