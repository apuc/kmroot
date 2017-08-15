<?php
namespace Control\Route_film_wallpaper;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Film\Wallpaper\Wallpaper;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $wallpaper = new Wallpaper($this->mysql());
        $item = $wallpaper->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('film/wallpaper/crop.html.php');
    }

    public function person()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $wallpaper = new Wallpaper($this->mysql());
        $item = $wallpaper->getById($id);
        $this->addData([
            'item' => $item,
            'personList' => $wallpaper->personList($item->filmId())
        ]);
        $this->setTemplate('film/wallpaper/person.html.php');
    }

    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('film_wallpaper', '2400x2400'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $id = $post->fetchInt('id');

            $width = intval($data['w'] ?? 0);
            $height = intval($data['h'] ?? 0);

            $this->mysql()->query("UPDATE `film_wallpaper` SET `width` = {$width}, `height` = {$height} WHERE `id` = {$id} LIMIT 1");
            
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_wallpaper', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Add images.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->uploadList($this->mysql(), 'film_wallpaper'), true);

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

                if (empty($ex) || 1 > $width || 1 > $height || 1 > $size) {
                    $this->mysql()->query("DELETE FROM `film_wallpaper` WHERE `id` = {$id} LIMIT 1");
                } else {
                    $s = intval(Server::STATIC_CURRENT);
                    $this->mysql()->query("UPDATE `film_wallpaper` SET `s` = {$s}, `image` = '{$ex}', `width` = {$width}, `height` = '{$height}' WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'film_wallpaper', 'uploadImage', '', $id);
                    $update = true;
                }
            }

            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updateWallpaperCount((new PostBag())->fetchInt('id'));
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
        $result = $this->mysql()->query("SELECT `s`, `filmId` FROM `film_wallpaper` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $data = json_decode($static->deleteList('film_wallpaper', $row['s']), true);
            $update = false;

            if ('' == $data) {
                $log = new Log($this->mysql());
                foreach ($idList as $id) {
                    $id = intval($id);
                    $this->mysql()->query("DELETE FROM `film_wallpaper` WHERE `id` = {$id} LIMIT 1");
                    $this->mysql()->query("DELETE FROM `film_wallpaper_person` WHERE `wallpaperId` = {$id}");
                    $log->add($this->admin()->id(), 'film_wallpaper', 'deleteImage', '', $id);
                }

                $update = true;
            }

            if ($update) {
                $stat = new Stat($this->mysql());
                $stat->updateWallpaperCount($row['filmId']);
            }
        }

        $this->setContent(json_encode($data));
    }
}