<?php
namespace Kinomania\Control\Comment;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;

/**
 * Class Comment
 * @package Kinomania\System\Comment
 */
class Comment extends DB
{
    use TDate;

    /**
     * Remove comment.
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

        $result = $this->db->query("SELECT `relatedId`, `type`, `userId` FROM `comment` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $relatedId = intval($row['relatedId']);
            $type = $row['type'];
            $userId = intval($row['userId']);

            $this->db->query("DELETE FROM `comment` WHERE `id` = {$id} LIMIT 1");
            if (!empty($this->db->error)) {
                return false;
            }

            $this->db->query("DELETE FROM `comment_stat` WHERE `commentId` = {$id}");
            $this->db->query("DELETE FROM `comment_vote` WHERE `commentId` = {$id}");

            if (0 < $userId) {
                $this->db->query("UPDATE `user` SET `count_comment` = `count_comment` - 1 WHERE `id` = {$userId} LIMIT 1");
            }

            switch ($type) {
                case 'news':
                    $this->db->query("UPDATE `news_stat` SET `comment` = `comment` - 1 WHERE `newsId` = {$relatedId} LIMIT 1");
                    break;
                case 'film':
                    $this->db->query("UPDATE `film_review_stat` SET `comment` = `comment` - 1 WHERE `reviewId` = {$relatedId} LIMIT 1");
                    break;
                case 'trailer':
                    $this->db->query("UPDATE `trailer_stat` SET `comment` = `comment` - 1 WHERE `trailerId` = {$relatedId} LIMIT 1");
                    break;
                case 'person':
                    $this->db->query("UPDATE `person_stat` SET `comment` = `comment` - 1 WHERE `personId` = {$relatedId} LIMIT 1");
                    break;
            }


            /**
             * Delete child comment's.
             */
            $allList = [];
            $result = $this->db->query("SELECT `id`, `parent` FROM `comment`  WHERE `relatedId` = {$relatedId} AND `type` = '{$type}'");
            while ($row = $result->fetch_assoc()) {
                if (0 < $row['parent']) {
                    $allList[$row['parent']][] = $row['id'];
                }
            }
            $this->delList = [];
            $this->getDelList($id, $allList);
            foreach ($this->delList as $id) {
                $result = $this->db->query("SELECT `relatedId`, `type`, `userId` FROM `comment` WHERE `id` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $relatedId = intval($row['relatedId']);
                    $type = $row['type'];
                    $userId = intval($row['userId']);

                    $this->db->query("DELETE FROM `comment` WHERE `id` = {$id} LIMIT 1");
                    $this->db->query("DELETE FROM `comment_stat` WHERE `commentId` = {$id}");
                    $this->db->query("DELETE FROM `comment_vote` WHERE `commentId` = {$id}");

                    if (0 < $userId) {
                        $this->db->query("UPDATE `user` SET `count_comment` = `count_comment` - 1 WHERE `id` = {$userId} LIMIT 1");
                    }

                    switch ($type) {
                        case 'news':
                            $this->db->query("UPDATE `news_stat` SET `comment` = `comment` - 1 WHERE `newsId` = {$relatedId} LIMIT 1");
                            break;
                        case 'film':
                            $this->db->query("UPDATE `film_review_stat` SET `comment` = `comment` - 1 WHERE `reviewId` = {$relatedId} LIMIT 1");
                            break;
                        case 'trailer':
                            $this->db->query("UPDATE `trailer_stat` SET `comment` = `comment` - 1 WHERE `trailerId` = {$relatedId} LIMIT 1");
                            break;
                        case 'person':
                            $this->db->query("UPDATE `person_stat` SET `comment` = `comment` - 1 WHERE `personId` = {$relatedId} LIMIT 1");
                            break;
                    }
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Get page link.
     * @param $id
     * @return string
     */
    public function location($id)
    {
        $id = intval($id);

        $link = '';

        $result = $this->db->query("SELECT `relatedId`, `type` FROM `comment` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $relatedId = intval($row['relatedId']);
            if ('news' == $row['type']) {
                $result = $this->db->query("SELECT `category` FROM `news` WHERE `id` = {$relatedId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $category = $row['category'];
                    switch ($category) {
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
                            $link = '/article/';
                    }
                }
            } else if ('person' == $row['type']) {
                $link = '/people/';
            }  else if ('film' == $row['type']) {
                $link = '/film/';
            } else if ('trailer' == $row['type']) {
                $result = $this->db->query("SELECT `filmId` FROM `trailer` WHERE `id` = {$relatedId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $link = '/film/' . $row['filmId'] . '/trailers/';
                }
            }
            $link .= $relatedId;
        }
        
        return $link;
    }

    /**
     * Get json data for DataTable plugin. List of comments.
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
        $queryTotal = "SELECT COUNT(*) as `count` FROM `comment` WHERE 1 ";
        if (!empty($type)) {
            $queryTotal .= " AND `type` = '{$type}' ";
        }
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

        $query = "SELECT t1.`id`, t1.`status`, t1.`relatedId`, t1.`type`, t1.`userId`, t1.`name`, t1.`text`, t1.`date`, t2.`login` 
                  FROM `comment` as `t1` LEFT JOIN `user` as `t2` ON t1.`userId` = t2.`id` WHERE 1 ";
        if (!empty($type)) {
            $query .= " AND t1.`type` = '{$type}' ";
        }
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
            $item[4] = $row['type'];
            $item[5] = $row['relatedId'];
            $item[6] = $login;

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

    /**
     * Get child's.
     * @param $parent
     * @param $list
     */
    private function getDelList($parent, &$list)
    {
        if (isset($list[$parent])) {
            foreach ($list[$parent] as $item) {
                $this->delList[] = $item;
                $this->getDelList($item, $list);
            }
        }
    }

    private $delList;
}