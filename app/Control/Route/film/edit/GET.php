<?php
namespace Control\Route_film_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Company\Company;
use Kinomania\Control\Film\Film;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('person'));
        } else {
            $company = new Company($this->mysql());
            $this->addData([
                'item' => $item,
                'companyList' => $company->getCompanyList($item->id())
            ]);
            $this->setTitle('Редактировать фильм');
            $this->setTemplate('film/edit.html.php');
        }
    }
}