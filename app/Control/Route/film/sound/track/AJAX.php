<?php
namespace Control\Route_film_sound_track;
use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Config\Server;
use Kinomania\System\Text\TText;

class AJAX extends AdminController
{
    use TText;

    /**
     * Add mp3.
     */
    public function upload()
    {
        $static = new StaticS();
        $data = json_decode($static->uploadMP3List($this->mysql()), true);

        if (isset($data['list'])) {
            $log = new Log($this->mysql());

            foreach ($data['list'] as $id => $item) {
                $id = intval($id);
                $ex = $item[0] ?? '';
                $author = $item[1] ?? '';
                $name = $item[2] ?? '';
                $time = $item[3] ?? '';
                switch ($ex) {
                    case 'mp3':
                        break;
                    default:
                        $ex = '';
                }

                if (empty($ex)) {
                    $this->mysql()->query("DELETE FROM `film_sound_track` WHERE `id` = {$id} LIMIT 1");
                } else {
                    $m = intval(Server::MEDIA_CURRENT);
                    $author = $this->mysql()->real_escape_string($this->clearText($author));
                    $name = $this->mysql()->real_escape_string($this->clearText($name));
                    $time = $this->mysql()->real_escape_string($this->clearText($time));
                    $this->mysql()->query("UPDATE `film_sound_track` SET `m` = {$m}, `author` = '{$author}', `name` = '{$name}', `time` = '{$time}' WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'film_sound_track', 'uploadMP3', '', $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Delete mp3.
     */
    public function delete()
    {
        $data = [];

        $post = new PostBag();
        $idList = $post->fetch('idList');
        $idList = explode(',', $idList);

        $id = intval($idList[0] ?? 0);
        $result = $this->mysql()->query("SELECT `m` FROM `film_sound_track` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {

            $static = new StaticS();
            $data = json_decode($static->deleteMP3List($row['m']), true);

            if ('' == $data) {
                $log = new Log($this->mysql());
                foreach ($idList as $id) {
                    $id = intval($id);
                    $this->mysql()->query("DELETE FROM `film_sound_track` WHERE `id` = {$id} LIMIT 1");
                    $log->add($this->admin()->id(), 'film_sound_track', 'deleteMP3', '', $id);
                }
            }
        }

        $this->setContent(json_encode($data));
    }
}