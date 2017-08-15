<?php
namespace Control\Route_film_frame;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Frame\Frame;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $frame = new Frame($this->mysql());
        $item = $frame->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('film/frame/crop.html.php');
    }

    public function person()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $frame = new Frame($this->mysql());
        $item = $frame->getById($id);
        $this->addData([
            'item' => $item,
            'personList' => $frame->personList($item->filmId())
        ]);
        $this->setTemplate('film/frame/person.html.php');
    }

    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('film_frame', '3600x3600'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $id = $post->fetchInt('id');

            $size = intval($data['size'] ?? 0);
            $width = intval($data['w'] ?? 0);
            $height = intval($data['h'] ?? 0);

            $this->mysql()->query("UPDATE `film_frame` SET `width` = {$width}, `height` = {$height}, `size` = {$size} WHERE `id` = {$id} LIMIT 1");
            
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_frame_image', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Add images.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->uploadList($this->mysql(), 'film_frame'), true);

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
                    $this->mysql()->query("DELETE FROM `film_frame` WHERE `id` = {$id} LIMIT 1");
                } else {
                    $s = intval(Server::STATIC_CURRENT);
                    $this->mysql()->query("UPDATE `film_frame` SET `s` = {$s}, `image` = '{$ex}', `width` = {$width}, `height` = '{$height}', `size` = {$size} WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'film_frame_image', 'uploadImage', '', $id);
                    $update = true;
                }
            }

            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updateFrameCount((new PostBag())->fetchInt('id'));
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
        $result = $this->mysql()->query("SELECT `s`, `filmId` FROM `film_frame` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $data = json_decode($static->deleteList('film_frame', $row['s']), true);
            $update = false;

            if ('' == $data) {
                $log = new Log($this->mysql());
                foreach ($idList as $id) {
                    $id = intval($id);
                    $this->mysql()->query("DELETE FROM `film_frame` WHERE `id` = {$id} LIMIT 1");
                    $this->mysql()->query("DELETE FROM `film_frame_person` WHERE `frameId` = {$id}");
                    $log->add($this->admin()->id(), 'film_frame_image', 'deleteImage', '', $id);
                }

                $update = true;
            }

            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updateFrameCount($row['filmId']);
            }
        }

        $this->setContent(json_encode($data));
    }
}