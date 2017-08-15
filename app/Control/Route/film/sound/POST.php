<?php
namespace Control\Route_film_sound;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Soundtrack\Soundtrack;

class POST extends AdminController
{
    /**
     * Create new soundtrack collection.
     */
    public function add()
    {
        $film = new Soundtrack($this->mysql());

        if ($film->add()) {
            $this->successMessage('Коллекция добавлена');
        } else {
            $this->setErrorComment($film->error());
            if (Soundtrack::BAD_YEAR == $film->error()) {
                $this->failMessage('Год вне допустимого диапазона');
            } else {
                $this->failMessage('Не удалось добавить коллекцию');
            }
        }

        $this->setRedirect();
    }

    /**
     * Delete soundtrack collection.
     */
    public function delete()
    {
        $film = new Soundtrack($this->mysql());

        if ($film->deleteDir()) {
            $this->successMessage('Коллекция удалена');
        } else {
            $this->setErrorComment($film->error());
            $this->failMessage('Не удалось удалить коллекцию');
        }

        $this->setRedirect();
    }
}