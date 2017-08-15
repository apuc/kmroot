<?php
namespace Control\Route_film_sound_edit;
use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
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
        $item = new Soundtrack($this->mysql());
        $item = $item->getDir($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('film/sound/crop.html.php');
    }
    /**
     * 
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('film_soundtrack', '1280x1280'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_soundtrack', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }
    
    
    /**
     * Add image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('film_soundtrack', '1280x1280'), true);

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
                $this->mysql()->query("UPDATE `film_sound_dir` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'film_soundtrack', 'uploadImage', '', $id);
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
        $data = json_decode($static->delete('film_soundtrack'), true);

        if ('' == $data) {
            $post = new PostBag();
            $id = intval($post->fetchInt('id'));
            $this->mysql()->query("UPDATE `film_sound_dir` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film_soundtrack', 'deleteImage', '', $id);
        }

        $this->setContent(json_encode($data));
    }
}