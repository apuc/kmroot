<?php
namespace Kinomania\Control\Server;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Config\Server;

/**
 * Class StaticS
 * @package Kinomania\Control\Server
 */
class StaticS
{
    public function __construct()
    {

    }

    /**
     * Upload image on server.
     *
     * @param string $handler
     * @param string $max
     * @param int $id
     * @param string $url
     * @return mixed
     */
    public function upload($handler, $max = '', $id = 0, $url = '')
    {
        $post = new PostBag();
        if (0 == $id) {
            $id = $post->fetch('id');
        }
        if ('' == $url) {
            $url = $post->fetch('url');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[Server::STATIC_CURRENT] . '/upload/image?handler=file&type=' . $handler);
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'url' => $url,
            'max' => $max,
        ];
        if (isset($_FILES['fileList'])) {
            if (count($_FILES['fileList']['tmp_name'])) {
                foreach ($_FILES['fileList']['tmp_name'] as $k => $file) {
                    $postVar['fileList' . $k] = new \CURLFile($file, $_FILES['fileList']['type'][$k], $_FILES['fileList']['name'][$k]);
                }
            }
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    /**
     * User avatar.
     *
     * @param $userId
     * @return mixed
     */
    public function avatar($userId)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[Server::STATIC_CURRENT] . '/upload/image?handler=avatar');
        $postVar = [
            'k' => 'trustme',
            'id' => $userId,
        ];
        if (isset($_FILES['fileList'])) {
            if (count($_FILES['fileList']['tmp_name'])) {
                foreach ($_FILES['fileList']['tmp_name'] as $k => $file) {
                    $postVar['fileList' . $k] = new \CURLFile($file, $_FILES['fileList']['type'][$k], $_FILES['fileList']['name'][$k]);
                }
            }
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    /**
     * @param $handler
     * @param int $s
     * @param int $id
     * @param string $extension
     * @return mixed
     */
    public function delete($handler, $s = -1, $id = 0, $extension = '')
    {
        $post = new PostBag();
        
        if (-1 == $s) {
            $s = Server::STATIC_CURRENT;
        } else {
            $s = intval($s);
        }
        
        $id = intval($id);
        if (0 == $id) {
            $id = $post->fetchInt('id');
        }
        
        if (empty($extension)) {
            $extension = $post->fetch('extension');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[$s] . '/upload/delete?handler=file&type=' . $handler);
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'extension' => $extension
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    /**
     * @param $handler
     * @param string $limit
     * @return mixed
     */
    public function crop($handler, $limit = '0x0')
    {
        $post = new PostBag();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[Server::STATIC_CURRENT] . '/upload/crop?handler=file&type=' . $handler . '&limit=' . $limit);
        $postVar = [
            'k' => 'trustme',
            'id' => $post->fetch('id'),
            'crop' => $post->fetch('crop'),
            'extension' => $post->fetch('extension')
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        
        return curl_exec($ch);
    }


    /**
     * Upload gallery image's.
     * @param \mysqli $db
     * @param string $handler
     * @return mixed
     */
    public function uploadList(\mysqli $db, $handler)
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[Server::STATIC_CURRENT] . '/upload/image?handler=' . $handler);
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'url' => $post->fetch('url'),
        ];

        if (isset($_FILES['fileList'])) {
            $count = count($_FILES['fileList']['tmp_name']);
            if ($count) {
                foreach ($_FILES['fileList']['tmp_name'] as $k => $file) {
                    $postVar['fileList' . $k] = new \CURLFile($file, $_FILES['fileList']['type'][$k], $_FILES['fileList']['name'][$k]);
                }
            }
        } else {
            $count = count(explode("\n", $post->fetch('url')));
        }

        $max = 0;
        if ('gallery' == $handler) {
            $result = $db->query("SELECT `order` FROM `news_gallery_image` WHERE `galleryId` = {$id} ORDER BY `order` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $max = $row['order'];
            }
        } else if ('film_frame' == $handler) {
            $result = $db->query("SELECT `order` FROM `film_frame` WHERE `filmId` = {$id} ORDER BY `order` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $max = $row['order'];
            }
        } else if ('person_photo' == $handler) {
            $result = $db->query("SELECT `order` FROM `person_photo` WHERE `personId` = {$id} ORDER BY `order` DESC LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $max = $row['order'];
            }
        }

        $idList = [];
        for ($i = 0; $i < $count; $i++) {
            $order = $i + 1 + $max;
            if ('gallery' == $handler) {
                $db->query("INSERT INTO `news_gallery_image` SET `galleryId` = {$id}, `s` = 0, `image` = '', `order` = {$order}");
            } else if ('film_frame' == $handler) {
                $db->query("INSERT INTO `film_frame` SET `filmId` = {$id}, `s` = 0, `image` = '', `order` = {$order}, `width` = 0, `height` = 0, `size` = 0, `photo_session` = 'no', `film_set` = 'no', `concept` = 'no', `screenshot` = 'no'");
            } else if ('film_wallpaper' == $handler) {
                $db->query("INSERT INTO `film_wallpaper` SET `filmId` = {$id}, `s` = 0, `image` = '', `width` = 0, `height` = 0");
            } else if ('film_poster' == $handler) {
                $db->query("INSERT INTO `film_poster` SET `s` = 0, `image` = '', `filmId` = {$id}, `width` = 0, `height` = 0, `size` = 0, `popular` = 'no'");
            } else if ('person_photo' == $handler) {
                $db->query("INSERT INTO `person_photo` SET `s` = 0, `image` = '', `personId` = {$id}, `order` = {$order}, `description` = '', `width` = 0, `height` = 0, `size` = 0");
            } else if ('person_wallpaper' == $handler) {
                $db->query("INSERT INTO `person_wallpaper` SET `s` = 0, `image` = '', `personId` = {$id}, `width` = 0, `height` = 0");
            }
            $idList[] = $db->insert_id;
        }
        $idList = implode(',', $idList);
        $postVar['idList'] = $idList;

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    /**
     * @param $handler
     * @param $s
     * @param array $idList
     * @return mixed
     */
    public function deleteList($handler, $s, $idList = [])
    {
        $post = new PostBag();
        if ([] == $idList) {
            $idList = $post->fetch('idList');
        } else {
            $idList = implode(',', $idList);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[$s] . '/upload/delete?handler=' . $handler);
        $postVar = [
            'k' => 'trustme',
            'id' => 1,
            'idList' => $idList
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }
    

    /**
     * @param \mysqli $db
     * @return mixed
     */
    public function uploadMP3List(\mysqli $db)
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::STATIC[Server::STATIC_CURRENT] . '/upload/mp3?handler=soundtrack');
        $postVar = [
            'k' => 'trustme',
            'id' => $id,
            'url' => $post->fetch('url'),
        ];

        if (isset($_FILES['fileList'])) {
            $count = count($_FILES['fileList']['tmp_name']);
            if ($count) {
                foreach ($_FILES['fileList']['tmp_name'] as $k => $file) {
                    $postVar['fileList' . $k] = new \CURLFile($file, $_FILES['fileList']['type'][$k], $_FILES['fileList']['name'][$k]);
                }
            }
        } else {
            $count = count(explode("\n", $post->fetch('url')));
        }

        $order = 1;
        $result = $db->query("SELECT `order` FROM `film_sound_track` WHERE `dirId` = {$id} ORDER BY `order` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $order = $row['order'];
        }

        $idList = [];
        for ($i = 0; $i < $count; $i++) {
            $order += $i;
            $db->query("INSERT INTO `film_sound_track` SET `dirId` = {$id}, `m` = 0, `author` = '', `name` = '', `time` = '', `order` = '{$order}'");
            $idList[] = $db->insert_id;
        }
        $idList = implode(',', $idList);
        $postVar['idList'] = $idList;

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }

    /**
     * @param $m
     * @param string $idList
     * @return mixed
     */
    public function deleteMP3List($m, $idList = '')
    {
        $post = new PostBag();
        if ([] == $idList) {
            $idList = $post->fetch('idList');
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_URL, 'http:' . Server::MEDIA[$m] . '/upload/mp3?handler=delete');
        $postVar = [
            'k' => 'trustme',
            'id' => 1,
            'idList' => $idList,
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVar);
        return curl_exec($ch);
    }
}
