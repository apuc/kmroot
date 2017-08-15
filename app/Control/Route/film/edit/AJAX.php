<?php
namespace Control\Route_film_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
    public function getCompany()
    {
        $term = (new GetBag())->fetchEscape('term', $this->mysql());

        $results = [];
        if (0 < mb_strlen($term, 'UTF-8')) {
            $result = $this->mysql()->query("SELECT `id`, `name` FROM `company` WHERE `name` LIKE '%{$term}%' LIMIT 10");
            while ($row = $result->fetch_assoc()) {
                $results[] = ['id' => $row['id'], 'value' => $row['name']];
            }
        }

        $this->setContent(json_encode($results));
    }
    
    /**
     * 
     */
    public function crop()
    {
        $static = new StaticS();
        $data = json_decode($static->crop('film', '1920x1920'), true);

        if (isset($data['er']) && 0 == $data['er']) {
            $post = new PostBag();
            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film', 'cropImage', '', $post->fetchInt('id'));
        }

        $this->setContent(json_encode($data));
    }
    
    /**
     * Add film image.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->upload('film', '1920x1920'), true);

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
                $this->mysql()->query("UPDATE `film` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");
                
                $stat = new Stat($this->mysql());
                $stat->update($id);

                $log = new Log($this->mysql());
                $log->add($this->admin()->id(), 'film', 'uploadImage', '', $id);

                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists('film:' . $id)) {
                    $redis->delete('film:' . $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete film image.
     */
    public function delete()
    {
        $static = new StaticS();
        $data = json_decode($static->delete('film'), true);

        if ('' == $data) {
            $post = new PostBag();
            $id = intval($post->fetchInt('id'));
            $this->mysql()->query("UPDATE `film` SET `s` = 0, `image` = '' WHERE `id` = {$id} LIMIT 1");

            $stat = new Stat($this->mysql());
            $stat->update($id);

            $log = new Log($this->mysql());
            $log->add($this->admin()->id(), 'film', 'deleteImage', '', $id);
            
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('film:' . $id)) {
                $redis->delete('film:' . $id);
            }
        }

        $this->setContent(json_encode($data));
    }
}