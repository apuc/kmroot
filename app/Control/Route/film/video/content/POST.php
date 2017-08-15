<?php
namespace Control\Route_film_video_content;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class POST extends AdminController
{
    public function load()
    {
        $video = new Video($this->mysql());
        $this->successMessage('Загрузка видео ввременно не доступна');

        if (0) {
            $data = json_encode($video->load());

            if (empty($data['error'])) {
                $this->successMessage('Видео загружено');

                $post = new PostBag();
                $id = $post->fetch('id');

            } else {
                $this->setErrorComment($video->error());
                switch ($data['error']) {
                    case 1:
                        $this->failMessage('Недопустимый тип файла');
                        break;
                    case 2:
                        $this->failMessage('Слишком низкое разрешение');
                        break;
                    case 3:
                        $this->failMessage('Недопустимый URL');
                        break;
                    case 4:
                        $this->failMessage('Директория не существует');
                        break;
                    default:
                        $this->failMessage('Не удалось загрузить видео');
                }
            }
        }

        $this->setRedirect();
    }
}