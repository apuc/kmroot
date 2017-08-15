<?php
namespace Original\Route_wallpapers_films;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Wallpaper\Film;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Film())->ajaxList()));
    }
}