<?php
namespace Control\Route_news_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\News\Tag;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;
use Kinomania\System\Debug\Debug;

/**
 * Class AJAX
 * @package Control\Route_news_edit
 */
class AJAX extends AdminController
{
    /**
     * Auto save text's.
     */
    public function save()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        $anons = $post->fetchEscape('anons', $this->mysql());
        $text = $post->fetchEscape('text', $this->mysql());
        $this->mysql()->query("UPDATE `news` SET `anons` = '{$anons}', `text` = '{$text}' WHERE `id` = {$id} LIMIT 1");
        $this->setContent('');
    }

    /**
     * Resize image.
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('news', '1920x1920'), true);
	   
        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'news', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }
    
    /**
     * Add news image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('news', '1920x1920'), true);

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
                $this->mysql()->query("UPDATE `news` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'news', 'uploadImage', '', $id);
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete news image.
     */
    public function delete()
    {
        $data = '';
        $post = new PostBag();
        $id = intval($post->fetchInt('id'));

        $result = $this->mysql()->query("SELECT `s` FROM `news` WHERE `id` = {$id}");
        if ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $data = json_decode($static->delete('news', $row['s']), true);

            if ('' == $data) {
                $this->mysql()->query("UPDATE `news` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'news', 'deleteImage', '', $id);
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Tag's autocomplete.
     */
    public function getTag()
    {
        $this->setContent((new Tag($this->mysql()))->autoComplete());
    }

    /**
     * Upload image inside text editor.
     */
    public function uploadFile()
    {
        $s = Server::STATIC_CURRENT;
        $this->mysql()->query("INSERT INTO `news_file` SET `s` = {$s}, `image` = '', `hash` = ''");
        $id = $this->mysql()->insert_id;
        $static = new StaticS();
        $data = json_decode($static->upload('news_text', '1280x1920', $id), true);
        
        $src = 'empty';

        if (isset($data['ex'])) {
            switch ($data['ex']) {
                case 'png':
                case 'jpeg':
                case 'gif':
                    break;
                default:
                    $data['ex'] = '';
            }

            if (!empty($data['ex'])) {
                $hash = md5($id);
                $this->mysql()->query("UPDATE `news_file` SET `image` = '{$data['ex']}', `hash` = UNHEX('{$hash}') WHERE `id` = {$id} LIMIT 1");

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'news_text', 'uploadImage', '', $id);

                $path = str_split($hash);
                $src = Server::STATIC[Server::STATIC_CURRENT] . '/file/news_text/' . $path[0] . '/' . $path[1] . $path[2] . '/' . $hash . '.' . $data['ex'];
            } else {
                $this->mysql()->query("DELETE FROM `news_file` WHERE `id` = {$id} LIMIT 1");
            }
        }

        $this->setContent($src);
    }

    /**
     * Delete image inside text editor.
     */
    public function deleteFile()
    {
        $post = new PostBag();

        $file = explode('/', $post->fetch('file'));
        $file = $file[count($file) - 1];
        $file = explode('.', $file);
        $file = $file[0];

        $data = [];

        if (!empty($file)) {
            $file = $this->mysql()->real_escape_string($file);
            $result = $this->mysql()->query("SELECT `id`, `s`, `image` FROM `news_file` WHERE `hash` = UNHEX('{$file}') LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $static = new StaticS();
                $data = json_decode($static->delete('news_text', $row['s'], $row['id'], $row['image']), true);

                if ('' == $data) {
                    $this->mysql()->query("DELETE FROM `news_file` WHERE `id` = {$row['id']} LIMIT 1");

                    $log = new Log($this->mysql());
                    $log->add($this->admin()->id(), 'news_text', 'deleteImage', '', $row['id']);
                }
            }
        }
        $this->setContent(json_encode($data));
    }
}