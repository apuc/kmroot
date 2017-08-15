<?php
namespace Original\Route_wallpapers_actresses;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Wallpaper\Actresses;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Actresses())->ajaxList()));
    }
}