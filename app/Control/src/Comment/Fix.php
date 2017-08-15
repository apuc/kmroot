<?php
namespace Kinomania\Control\Comment;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;

/**
 * Class Fix
 * @package Kinomania\System\Comment
 */
class Fix extends DB
{
    use TDate;

    /**
     * Proceed fix.
     * @return bool
     */
    public function approve()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        
        $this->db->query("UPDATE `moderate` SET `new` = 'false' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            return false;
        }
            
        return true;
    }

    /**
     * Remove fix.
     * @param int $id
     * @return bool
     */
    public function delete($id = 0)
    {
        $id = intval($id);
        if (0 == $id) {
            $post = new PostBag();
            $id = $post->fetchInt('id');
        }

        $this->db->query("DELETE FROM `moderate` WHERE `id` = {$id} LIMIT 1");

        return true;
    }

    /**
     * Get json data for DataTable plugin. List of fix.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

        $type = $get->fetchEscape('type', $this->db);

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'id';
                break;
            case 1:
                $order = 'date';
                break;
            default:
                $order = 'id';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];

        /**
         * Total.
         */
        $total = 0;
        $queryTotal = "SELECT COUNT(*) as `count` FROM `moderate` WHERE `new` = '{$type}'";
        $result = $this->db->query($queryTotal);
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        $query = "SELECT t1.`id`, t1.`type`, t1.`relatedId`, t1.`date`, t1.`userId`, t1.`info`, t1.`source`, t1.`form`, t2.`login` 
                  FROM `moderate` as `t1` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id` WHERE t1.`new` = '{$type}'";
        $query .= " ORDER BY t1.`{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $login = $row['login'];
            if (empty($login)) {
                $login = $row['name'];
            }
            
            if (!empty($row['source'])) {
                $row['info'] .= "<br / >\n Источник: " . $row['source'];
            }
            
            $item[0] = $row['id'];
            $item[1] = $this->formatDate($row['date'], true);
            $item[2] = $row['userId'];
            $item[3] = $row['info'];
            $item[4] = $row['relatedId'];
            $item[5] = $login;
            $item[6] = $row['type'];

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