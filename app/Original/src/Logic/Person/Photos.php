<?php
namespace Kinomania\Original\Logic\Person;

use Kinomania\Original\Key\Person\Photo;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Photos
 * @package Kinomania\Original\Person
 */
class Photos
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @param int $page
     * @return array
     */
    public function get($personId, $page = 1)
    {
        $list = [];
        
        $personId = intval($personId);
        $page = intval($page);
        $offset = ($page - 1) * 24;

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `description`, `width`, `height`, `size`
                                            FROM `person_photo` JOIN (SELECT `id` FROM `person_photo` WHERE `personId` = {$personId} ORDER BY `order` DESC LIMIT {$offset}, 24) as `t` USING (`id`)");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . Path::PERSON_PHOTO . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                $preview = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.240.301.' . $row['image'];

                $list[] = [
                    Photo::ID => $row['id'],
                    Photo::IMAGE => $image,
                    Photo::PREVIEW => $preview,
                    Photo::DESCRIPTION => $row['description'],
                    Photo::WIDTH => $row['width'],
                    Photo::HEIGHT => $row['height'],
                    Photo::SIZE => $row['size'],
                ];
            }
        }

        return $list;
    }
    
    public function getById($personId, $photoId)
    {
        $list = [];

        $personId = intval($personId);
        $photoId = intval($photoId);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `description`, `width`, `height`, `size`
                                            FROM `person_photo` WHERE `personId` = {$personId} AND `id` = {$photoId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . Path::PERSON_PHOTO . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                $preview = Server::STATIC[$row['s']] . '/image' . Path::PERSON_PHOTO . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.240.301.' . $row['image'];

                $list['item'] = [
                    Photo::ID => $row['id'],
                    Photo::IMAGE => $image,
                    Photo::PREVIEW => $preview,
                    Photo::DESCRIPTION => $row['description'],
                    Photo::WIDTH => $row['width'],
                    Photo::HEIGHT => $row['height'],
                    Photo::SIZE => $row['size'],
                ];
            }
        }

        if (isset($list['item'])) {
            $result = $this->mysql()->query("SELECT `id` FROM `person_photo` WHERE `personId` = {$personId} AND `image` != '' ORDER BY `order` DESC");
            while ($row = $result->fetch_assoc()) {
                $list['list'][] = $row['id'];
            }
        }
        
        return $list;
    }
}