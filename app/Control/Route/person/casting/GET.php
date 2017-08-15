<?php
namespace Control\Route_person_casting;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Casting\Casting;
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
            $casting = new Casting($this->mysql());
            
            $this->addData([
                'item' => $item,
                'casting' => $person->getCastingById($id),
                'companyList' => $casting->companyList()
            ]);
            $this->setTitle('Редактировать персону, кастинг');
            $this->setTemplate('person/casting.html.php');
        }
    }
}