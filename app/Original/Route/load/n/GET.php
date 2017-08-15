<?php
namespace Original\Route_load_n;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Controller\DefaultController;

class GET extends DefaultController
{
    public function index()
    {
        $file = (new GetBag())->fetch('file');
        if (!empty($file)) {
            $file = str_replace('/file/', '/load/file/', $file);
            $file = str_replace('/media/', '/load/media/', $file);
            $file = str_replace('../', '/', $file);
            $this->setRedirect($file . '?t=' . strtotime('now'), 307);
        }
    }
}