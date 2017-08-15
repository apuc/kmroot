<?php
namespace Kinomania\Control\Film\Boxoffice;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

class Boxoffice extends DB
{
    public function save()
    {
        $this->error = '';
        $post = new PostBag();

        $filmId = $post->fetchInt('filmId');
        $world = $post->fetchInt('world');
        $ru = $post->fetchInt('ru');
        $usa = $post->fetchInt('usa');
        
        $result = $this->db->query("SELECT `id` FROM `film_gross` WHERE `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `film_gross` SET `world` = {$world}, `ru` = {$ru}, `usa` = {$usa} WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->db->query("INSERT INTO `film_gross` SET `filmId` = {$filmId}, `world` = {$world}, `ru` = {$ru}, `usa` = {$usa}");
        }
        
        if (!empty($this->db->error)) {
            return false;
        }
        
        return true;
    }


    public function getByFilmId($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `film_gross` WHERE `filmId` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }
}