<?php
namespace Control\Route_film_wallpaper;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Wallpaper\Wallpaper;

class POST extends AdminController
{
    public function person()
    {
        $wallpaper = new Wallpaper($this->mysql());
        if ($wallpaper->person()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($wallpaper->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}