<?php
namespace Control\Route_film_video_add;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $video = new Video($this->mysql());
        
        $this->addData([
            'filmId' => $get->fetchInt('filmId'),
            'typeList' => $video->getTypeList()
        ]);
        $this->setTemplate('film/video/add.html.php');
    }
}