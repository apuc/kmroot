<?php
namespace Control\Route_person_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Person\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\Control\Storage\Autocomplete;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    /**
     * University autocomplete.
     */
    public function getUniversity()
    {
        $this->setContent((new Autocomplete($this->mysql()))->university());
    }

    /**
     * Department autocomplete.
     */
    public function getDepartment()
    {
        $this->setContent((new Autocomplete($this->mysql()))->department());
    }

    /**
     * Studio autocomplete.
     */
    public function getStudio()
    {
        $this->setContent((new Autocomplete($this->mysql()))->studio());
    }

    /**
     * Theatre autocomplete.
     */
    public function getTheatre()
    {
        $this->setContent((new Autocomplete($this->mysql()))->theatre());
    }

    /**
     * Resize image.
     */
    public function crop()
    {
        $static = new StaticS();
            $data = json_decode($static->crop('person', '1920x1920'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'person_main_photo', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }
    
    /**
     * Add person image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('person', '1920x1920'), true);

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
                $this->mysql()->query("UPDATE `person` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");

                $stat = new Stat($this->mysql());
                $stat->update($id);

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'person', 'uploadImage', '', $id);

                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists('person:' . $id)) {
                    $redis->delete('person:' . $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete person image.
     */
    public function delete()
    {
        $static = new StaticS();
        $data = json_decode($static->delete('person'), true);

        if ('' == $data) {
            $post = new PostBag();
            $id = intval($post->fetchInt('id'));
            $this->mysql()->query("UPDATE `person` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

            $stat = new Stat($this->mysql());
            $stat->update($id);

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'person', 'deleteImage', '', $id);

            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('person:' . $id)) {
                $redis->delete('person:' . $id);
            }
        }

        $this->setContent(json_encode($data));
    }
}