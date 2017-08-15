<?php
namespace Original\Route_soundtracks;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Soundtrack\Soundtrack;

class AJAX extends DefaultController
{
    public function search()
    {
        $this->setContent(json_encode((new Soundtrack())->ajaxList()));
    }
}