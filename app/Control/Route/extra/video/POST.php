<?php
namespace Control\Route_extra_video;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class POST extends AdminController
{
    /**
     * Create new video type.
     */
    public function add()
    {
        $video = new Video($this->mysql());

        if ($video->addType()) {
            $this->successMessage('Тип добавлен');
        } else {
            $this->setErrorComment($video->error());
            if (Video::TYPE_EXIST == $video->error()) {
                $this->failMessage('Такое название уже занято');
            } else {
                $this->failMessage('Не удалось добавить тип');
            }
        }

        $this->setRedirect();
    }

    /**
     * Update video type.
     */
    public function edit()
    {
        $video = new Video($this->mysql());

        if ($video->editType()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($video->error());
            if (Video::TYPE_EXIST == $video->error()) {
                $this->failMessage('Такое название уже занято');
            } else {
                $this->failMessage('Не удалось сохранить изменения');
            }
        }

        $this->setRedirect();
    }

    /**
     * Remove video type.
     */
    public function delete()
    {
        $video = new Video($this->mysql());

        if ($video->deleteType()) {
            $this->successMessage('Тип удалён');
        } else {
            $this->setErrorComment($video->error());
            if (Video::TYPE_EXIST == $video->error()) {
                $this->failMessage('Нельзя удалить, существуют видео данного типа');
            } else {
                $this->failMessage('Не удалось удалить');
            }
        }

        $this->setRedirect();
    }
}