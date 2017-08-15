<?php
namespace Control\Route_extra_video;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class GET extends AdminController
{
    public function index()
    {
        $video = new Video($this->mysql());
        
        $this->setTitle('Типы видео');
        $this->addData([
            'list' => $video->getTypeList() 
        ]);
        $this->setTemplate('extra/video/index.html.php');
    }
}