<?php
namespace Control\Route_film_video_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class POST extends AdminController
{
    public function edit()
    {
        $video = new Video($this->mysql());

        $item = $video->getTrailer((new PostBag())->fetchInt('id'));

        if ($video->editTrailer()) {
            $this->successMessage('Изменения сохранены');
            $this->setRedirect($this->request->makeUrl('film/video?id=' . $item->filmId()));
        } else {
            $this->setErrorComment($video->error());
            if (Video::TYPE_EXIST == $video->error()) {
                $this->failMessage('Такой тип трейлера уже существует');
            } else {
                $this->failMessage('Не удалось сохранить изменения');
            }
            $this->setRedirect();
        }
    }

    public function load()
    {
        
        $video = new Video($this->mysql());
        $data = $video->load();
        $data = json_decode($data, true);

        if (empty($data['error'])) {
            $id = (new PostBag())->fetchInt('id');
            $hd480 =  '';
            $iName = md5($id);
            if ($data['type']['hd480']) {
                $hd480 = Server::MEDIA[Server::MEDIA_CURRENT] . Path::FILM_VIDEO_MEDIA . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.480.mp4';
            }
            $hd720 = '';
            if ($data['type']['hd720']) {
                $hd720 = Server::MEDIA[Server::MEDIA_CURRENT] . Path::FILM_VIDEO_MEDIA . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.720.mp4';
            }
            $hd1080 = '';
            if ($data['type']['hd1080']) {
                $hd1080 = Server::MEDIA[Server::MEDIA_CURRENT] . Path::FILM_VIDEO_MEDIA . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.1080.mp4';
            }

            $date = strtotime('now');
            $this->mysql()->query("UPDATE `trailer` SET `date` = FROM_UNIXTIME('{$date}'), `hd480` = '{$hd480}', `hd720` = '{$hd720}', `hd1080` = '{$hd1080}' WHERE `id` = {$id} LIMIT 1");

            $this->successMessage('Видео загружено');
        } else {
            $this->setErrorComment($video->error());
            switch ($data['error']) {
                case 1:
                    $this->failMessage('Недопустимый тип файла');
                    break;
                case 2:
                    $this->failMessage('Слишком большой размер файла');
                    break;
                case 3:
                    $this->failMessage('Недопустимый URL');
                    break;
                case 4:
                    $this->failMessage('Директория не существует');
                    break;
                case 8:
                    $this->failMessage('Слишком низкое разрешение');
                    break;
                default:
                    $this->failMessage('Не удалось загрузить видео');
            }
        }

        $this->setRedirect();
    }

    public function delete()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        $hd = $post->fetchInt('hd');

        $video = new Video($this->mysql());
        $video->deleteVideo(Server::MEDIA_CURRENT, $id, $hd);
        $this->mysql()->query("UPDATE `trailer` SET `hd{$hd}` = '' WHERE `id` = {$id} LIMIT 1");
        $this->successMessage('Видео удалено');

        sleep(1);
        $this->setRedirect();
    }
    
    public function person()
    {
        $video = new Video($this->mysql());
        if ($video->person()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($video->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}