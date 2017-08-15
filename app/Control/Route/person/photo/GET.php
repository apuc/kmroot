<?php
namespace Control\Route_person_photo;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;
use Kinomania\Control\Person\Photo\Photo;
use Kinomania\Migrate\PersonPhoto;
use Kinomania\System\Config\Server;

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
                'list' => (new Photo($this->mysql()))->getPhoto($item->id())
            ]);
            $this->setTitle('Фотографии');
            $this->setTemplate('person/photo/index.html.php');
        }
    }
}