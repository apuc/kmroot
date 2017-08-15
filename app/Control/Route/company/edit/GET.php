<?php
namespace Control\Route_company_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Company\Company;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();

        $id = $get->fetchInt('id');
        $company = new Company($this->mysql());
        $item = $company->getById($id);

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('company'));
        } else {
            $this->addData([
                'typeList' => \Kinomania\System\Data\Company::TYPE,
                'item' => $item
            ]);
            $this->setTitle('Редактирование компании');
            $this->setTemplate('company/edit.html.php');
        }
    }
}