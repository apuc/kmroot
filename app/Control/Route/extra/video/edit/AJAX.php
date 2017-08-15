<?php
namespace Control\Route_extra_video_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $video = new Video($this->mysql());
        $name = $video->getTypeNameById($id);
        $this->addData([
            'id' => $id,
            'name' => $name
        ]);
        $this->setTemplate('extra/video/edit.html.php');
    }
}