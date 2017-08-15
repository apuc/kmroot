<?php
namespace Control\Route_company_crop;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Company\Company;
use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $company = new Company($this->mysql());
        $item = $company->getById($id);
        $this->addData([
            'item' => $item
        ]);
        $this->setTemplate('company/crop/main.photo.html.php');
    }
}