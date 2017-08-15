<?php
namespace Control\Route_film_video_content;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Video\Video;
use Weblab\Video\Youtube;

class GET extends AdminController
{
    public function index()
    {
        $video = new Youtube('https://www.youtube.com/watch?v=0hH-Q6Wm_0s');
        print_r($video->load('https://www.youtube.com/watch?v=0hH-Q6Wm_0s'));
        exit;

        $get = new GetBag();
        $id = $get->fetchInt('id');
        $video = new Video($this->mysql());
        $item = $video->getTrailer($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
        } else {
            $this->addData([
                'item' => $item,
                //'list' => $video->getContentList($id)
            ]);
            $this->setTitle('Видео файлы');
            $this->setTemplate('film/video/content.html.php');
        }
    }
}