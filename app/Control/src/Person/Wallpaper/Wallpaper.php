<?php
namespace Kinomania\Control\Person\Wallpaper;

use Kinomania\System\Base\DB;
use Kinomania\System\Text\TText;

class Wallpaper extends DB
{
    use TText;
    
    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `person_wallpaper` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }
    
    public function getPhoto($personId)
    {
        $list = [];
        $personId = intval($personId);
        
        $result = $this->db->query("SELECT `id`, `s`, `image`, `width`, `height` FROM `person_wallpaper` WHERE `personId` = {$personId} ORDER BY `id` DESC");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }
}