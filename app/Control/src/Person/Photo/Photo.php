<?php
namespace Kinomania\Control\Person\Photo;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Text\TText;

class Photo extends DB
{
    use TText;
    
    public function saveDescription()
    {
        $this->error = '';
        $post = new PostBag();
        $id = $post->fetchInt('id');
        $description = $this->clearText($post->fetch('description'));
        $description = $this->db->real_escape_string($description);
        
        $this->db->query("UPDATE `person_photo` SET `description` = '{$description}' WHERE `id` = {$id} LIMIT 1");
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
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `person_photo` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }
    
    public function getPhoto($personId)
    {
        $list = [];
        $personId = intval($personId);
        
        $result = $this->db->query("SELECT `id`, `s`, `image`, `description`, `width`, `height`, `size` FROM `person_photo` WHERE `personId` = {$personId} ORDER BY `order` DESC");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }
}