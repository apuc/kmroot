<?php
namespace Control\Route_film_video;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class POST extends AdminController
{
    /**
     * Create new soundtrack collection.
     */
    public function add()
    {
        $video = new Video($this->mysql());

        if ($video->addTrailer()) {
            $this->successMessage('Трейлер добавлен');
        } else {
            $this->setErrorComment($video->error());
            if (Video::TYPE_EXIST == $video->error()) {
                $this->failMessage('Такой тип трейлера уже существует');
            } else {
                $this->failMessage('Не удалось добавить трейлер');
            }
        }

        $this->setRedirect();
    }

    /**
     * Delete soundtrack collection.
     */
    public function delete()
    {
        $film = new Video($this->mysql());

        if ($film->delete()) {
            $this->successMessage('Видео удалено');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось удалить видео');
        }

        $this->setRedirect();
    }
}