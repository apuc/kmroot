<?php
namespace Original\Route_wallpapers_actors;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Wallpaper\Actor;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Actor())->ajaxList()));
    }
}