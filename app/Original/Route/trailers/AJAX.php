<?php
namespace Original\Route_trailers;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Trailer\Trailer;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Trailer())->ajaxList()));
    }
}