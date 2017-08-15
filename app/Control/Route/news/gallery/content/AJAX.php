<?php
namespace Control\Route_news_gallery_content;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    public function order()
    {
        $post = new PostBag();
        $data = json_decode($post->fetch('data'), true);

        $order = 1;
        foreach ($data[0] as $id) {
            $id = intval($id['id'] ?? 0);
            if (0 < $id) {
                $this->mysql()->query("UPDATE `news_gallery_image` SET `order` = {$order} WHERE `id` = {$id} LIMIT 1");
                $order++;
            }
        }

        $this->setContent('');
    }


    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('news_gallery', '1280x1280'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'news_gallery_image', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Add images.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->uploadList($this->mysql(), 'gallery'), true);

        if (isset($data['list'])) {
            $log = new Log($this->mysql());

            foreach ($data['list'] as $id => $item) {
                $id = intval($id);
                $ex = $item[0] ?? '';
                switch ($ex) {
                    case 'png':
                    case 'jpeg':
                    case 'gif':
                        break;
                    default:
                        $ex = '';
                }

                if (empty($ex)) {
                    $this->mysql()->query("DELETE FROM `news_gallery_image` WHERE `id` = {$id} LIMIT 1");
                } else {
                    $s = intval(Server::STATIC_CURRENT);
                    $this->mysql()->query("UPDATE `news_gallery_image` SET `s` = {$s}, `image` = '{$ex}' WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'news_gallery_image', 'uploadImage', '', $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete images.
     */
    public function delete()
    {
        $data = [];

        $post = new PostBag();
        $idList = $post->fetch('idList');
        $idList = explode(',', $idList);

        $id = intval($idList[0] ?? 0);
        $result = $this->mysql()->query("SELECT `s` FROM `news_gallery_image` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {

            $static = new StaticS();
            $data = json_decode($static->deleteList('gallery', $row['s']), true);

            if ('' == $data) {
                $log = new Log($this->mysql());
                foreach ($idList as $id) {
                    $id = intval($id);
                    $this->mysql()->query("DELETE FROM `news_gallery_image` WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'news_gallery_image', 'deleteImage', '', $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }
}