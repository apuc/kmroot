<?php
namespace Original\Route_photos;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Photo\Photo;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Photo())->ajaxList()));
    }
}