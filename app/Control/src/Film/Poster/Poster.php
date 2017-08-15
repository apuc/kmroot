<?php
namespace Kinomania\Control\Film\Poster;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Person\Stat;
use Kinomania\System\Base\DB;

class Poster extends DB
{
    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');

        $popular = 'no';
        if ($post->has('popular')) {
            $popular = 'yes';
        }

        $this->db->query("UPDATE `film_poster` SET `popular` = '{$popular}' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $item = new Item();

        $id = intval($id);

        $result = $this->db->query("SELECT * FROM `film_poster` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @param $filmId
     * @return array
     */
    public function getPhoto($filmId)
    {
        $list = [];
        $filmId = intval($filmId);

        $result = $this->db->query("SELECT `id`, `s`, `image`, `width`, `height`, `size`, `popular` FROM `film_poster` WHERE `filmId` = {$filmId} ORDER BY `id` DESC");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }

        return $list;
    }
}