<?php
namespace Control\Route_person_video;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;
use Kinomania\Control\Person\Video\Video;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $person = new Person($this->mysql());
        $item = $person->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect('person');
        } else {
            $this->addData([
                'item' => $item,
                'list' => (new Video($this->mysql()))->getList($item->id())
            ]);
            $this->setTitle('Видео');
            $this->setTemplate('person/video/index.html.php');
        }
    }
}