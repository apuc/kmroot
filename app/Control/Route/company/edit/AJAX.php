<?php
namespace Control\Route_company_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    /**
     *
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('company', '720x720'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'company_image', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Company name must be unique.
     */
    public function checkName()
    {
        $get = new GetBag();

        $exist = false;
        $id = $get->fetchInt('id');
        if (0 < $id) {
            $name = $get->fetchEscape('name', $this->mysql());
            $result = $this->mysql()->query("SELECT 1 FROM `company` WHERE `id` != {$id} AND `name` = '{$name}' LIMIT 1");
            if (1 == $result->num_rows) {
                $exist = true;
            }
        } else {
            $exist = true;
        }

        if ($exist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }

    /**
     * Add company image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('company'), true);

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
                $this->mysql()->query("UPDATE `company` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'company', 'uploadImage', '', $id);
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete company image.
     */
    public function delete()
    {
        $static = new StaticS();
        $data = json_decode($static->delete('company'), true);

        if ('' == $data) {
            $post = new PostBag();
            $id = intval($post->fetchInt('id'));
            $this->mysql()->query("UPDATE `company` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'company', 'deleteImage', '', $id);
        }

        $this->setContent(json_encode($data));
    }
}