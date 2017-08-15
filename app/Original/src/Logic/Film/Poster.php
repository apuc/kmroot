<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\Original\Key\Person\Frame;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Poster
 * @package Kinomania\Original\Film
 */
class Poster
{
    use TRepository;
    use TDate;
    
    public function get($filmId, $page = 1)
    {
        $list = [];
        $filmId = intval($filmId);
        
        $page = intval($page);
        $offset = ($page - 1) * 24;

        $result = $this->mysql()->query("SELECT 
                                            t1.`id`, t1.`s`, t1.`image`, t1.`width`, t1.`height`, t1.`size`
                                            FROM `film_poster` as `t1` WHERE `filmId` = {$filmId} ORDER BY `id` DESC LIMIT {$offset}, 24");
        while ($row = $result->fetch_assoc()) {
            $imageName = md5($row['id']);
            $image = Server::STATIC[$row['s']] . Path::FILM_POSTER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            $preview = Server::STATIC[$row['s']] . '/image' . Path::FILM_POSTER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.228.313.' . $row['image'];

            $list[] = [
                Frame::ID => $row['id'],
                Frame::IMAGE => $image,
                Frame::PREVIEW => $preview,
                Frame::WIDTH => $row['width'],
                Frame::HEIGHT => $row['height'],
                Frame::SIZE => $row['size'],
            ];
        }
        
        return $list;
    }
    
    public function getById($filmId, $posterId)
    {
        $filmId = intval($filmId);
        $posterId = intval($posterId);
        
        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `width`, `height`, `size`
                                            FROM `film_poster` WHERE `filmId` = {$filmId} AND `id` = {$posterId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . Path::FILM_POSTER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];


                $list['item'] = [
                    Frame::ID => $row['id'],
                    Frame::IMAGE => $image,
                    Frame::PREVIEW => '',
                    Frame::WIDTH => $row['width'],
                    Frame::HEIGHT => $row['height'],
                    Frame::SIZE => $row['size'],
                ];
            }
        }

        $list['list'] = [];
        if (isset($list['item'])) {
            $result = $this->mysql()->query("SELECT `id` FROM `film_poster` WHERE `filmId` = {$filmId} AND `image` != '' ORDER BY `id` DESC");
            while ($row = $result->fetch_assoc()) {
                $list['list'][] = $row['id'];
            }


        }
        
        return $list;
    }
}
