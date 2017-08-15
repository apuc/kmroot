<?php
namespace Control\Route_person_photo;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Person\Photo\Photo;
use Kinomania\Control\Person\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $photo = new Photo($this->mysql());
        $item = $photo->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('person/photo/crop.html.php');
    }

    /**
     *
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('person_photo', '3600x3600'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $id = $post->fetchInt('id');

            $size = intval($data['size'] ?? 0);
            $width = intval($data['w'] ?? 0);
            $height = intval($data['h'] ?? 0);

            $this->mysql()->query("UPDATE `person_photo` SET `width` = {$width}, `height` = {$height}, `size` = {$size} WHERE `id` = {$id} LIMIT 1");

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'person_photo', 'cropImage', '', $id);
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Add images.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->uploadList($this->mysql(), 'person_photo'), true);

        if (isset($data['list'])) {
            $log = new Log($this->mysql());
            $update = false;
            
            foreach ($data['list'] as $id => $item) {
                $id = intval($id);
                $ex = $item[0] ?? '';
                $width = intval($item[1] ?? 0);
                $height = intval($item[2] ?? 0);
                $size = intval($item[3] ?? 0);
                switch ($ex) {
                    case 'png':
                    case 'jpeg':
                    case 'gif':
                        break;
                    default:
                        $ex = '';
                }

                if (empty($ex) && 0 < $width && 0 < $height && 0 < $size) {
                    $this->mysql()->query("DELETE FROM `person_photo` WHERE `id` = {$id} LIMIT 1");
                } else {
                    $s = intval(Server::STATIC_CURRENT);
                    $this->mysql()->query("UPDATE `person_photo` SET `s` = {$s}, `image` = '{$ex}', `width` = {$width}, `height` = '{$height}', `size` = {$size} WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'person_photo', 'uploadImage', '', $id);
                    $update = true;
                }
            }
            
            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updatePhotoCount((new PostBag())->fetchInt('id'));
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
        $result = $this->mysql()->query("SELECT `s`, `personId` FROM `person_photo` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $data = json_decode($static->deleteList('person_photo', $row['s']), true);

            $update = false;
            
            if ('' == $data) {
                $log = new Log($this->mysql());
                foreach ($idList as $id) {
                    $id = intval($id);
                    $this->mysql()->query("DELETE FROM `person_photo` WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'person_photo', 'deleteImage', '', $id);
                    $update = true;
                }
            }

            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updatePhotoCount($row['personId']);
            }
        }

        $this->setContent(json_encode($data));
    }
}