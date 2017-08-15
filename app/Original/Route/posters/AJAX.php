<?php
namespace Original\Route_posters;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Poster\Poster;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Poster())->ajaxList()));
    }
}