<?php
namespace Control\Route_extra_video_add;

use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $this->setTemplate('extra/video/add.html.php');
    }
}