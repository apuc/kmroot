<?php
namespace Kinomania\Control\Comment;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;

/**
 * Class Review
 * @package Kinomania\System\Comment
 */
class Feedback extends DB
{
    use TDate;

    /**
     * Print review on site.
     * @return bool
     */
    public function approve()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        
        $this->db->query("UPDATE `person_review` SET `status` = 'show' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            return false;
        }

        $result = $this->db->query("SELECT `userId` FROM `person_review` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `user` SET `count_feedback` = `count_feedback` + 1 WHERE `id` = {$row['userId']} LIMIT 1");
        }
            
        return true;
    }

    /**
     * Remove review.
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

        $result = $this->db->query("SELECT `userId` FROM `person_review` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `user` SET `count_feedback` = `count_feedback` - 1 WHERE `id` = {$row['userId']} LIMIT 1");
        }

        $this->db->query("DELETE FROM `person_review` WHERE `id` = {$id} LIMIT 1");
        $this->db->query("DELETE FROM `person_review_vote` WHERE `reviewId` = {$id}");
        $this->db->query("DELETE FROM `person_review_stat` WHERE `reviewId` = {$id}");

        $comment = new Comment($this->db);
        $result = $this->db->query("SELECT `id` FROM `comment` WHERE `relatedId` = {$id} AND `type` = 'person' AND `parent` = 0");
        while ($row = $result->fetch_assoc()) {
            $comment->delete($row['id']);
        }

        return true;
    }

    /**
     * Get json data for DataTable plugin. List of reviews.
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
        $queryTotal = "SELECT COUNT(*) as `count` FROM `person_review` WHERE `status` = '{$type}'";
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

        $query = "SELECT t1.`id`, t1.`status`, t1.`personId`, t1.`userId`, t1.`name`, t1.`text`, t1.`date`, t2.`login` 
                  FROM `person_review` as `t1` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id` WHERE t1.`status` = '{$type}'";
        $query .= " ORDER BY t1.`{$order}` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $login = $row['login'];
            if (empty($login)) {
                $login = $row['name'];
            }
            
            $item[0] = $row['id'];
            $item[1] = $this->formatDate($row['date'], true);
            $item[2] = $row['userId'];
            $item[3] = $row['text'];
            $item[4] = $row['personId'];
            $item[5] = $login;

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