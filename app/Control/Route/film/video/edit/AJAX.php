<?php
namespace Control\Route_film_video_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\Control\Video\Video;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    /**
     * 
     */
    public function cropModal()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $item = new Video($this->mysql());
        $item = $item->getTrailer($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('film/video/crop.html.php');
    }
    /**
     * 
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('film_trailer', '1280x1280'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_trailer', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }

    public function person()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $video = new Video($this->mysql());
        $item = $video->getTrailer($id);
        $this->addData([
            'item' => $item,
            'personList' => $video->personList($item->filmId())
        ]);
        $this->setTemplate('film/video/person.html.php');
    }
    
    
    /**
     * Add image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('film_trailer', '1280x1280'), true);

        if (isset($data['ex'])) {
            $post = new PostBag();
            switch ($data['ex']) {
                case 'png':
                case 'jpeg':
                case 'gif':
                    break;
                default:
                    $data['ex'] = '';
            }
            $id = intval($post->fetchInt('id'));
            if (!empty($data['ex'])) {
                $s = intval(Server::STATIC_CURRENT);
                $this->mysql()->query("UPDATE `trailer` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'film_trailer', 'uploadImage', '', $id);
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete image.
     */
    public function delete()
    {
        $static = new StaticS();
        $data = json_decode($static->delete('film_trailer'), true);

        if ('' == $data) {
            $post = new PostBag();
            $id = intval($post->fetchInt('id'));
            $this->mysql()->query("UPDATE `trailer` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_trailer', 'deleteImage', '', $id);
        }

        $this->setContent(json_encode($data));
    }
}