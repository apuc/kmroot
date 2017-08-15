<?php
namespace Control\Route_person_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;
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
            $this->setRedirect($this->request->makeUrl('person'));
        } else {
            $this->addData([
                'item' => $item
            ]);
            $this->setTitle('Редактировать персону');
            $this->setTemplate('person/edit.html.php');
        }
    }
}