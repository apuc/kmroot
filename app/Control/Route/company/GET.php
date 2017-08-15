<?php
namespace Control\Route_company;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Data\Company;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        
        $this->addData([
            'get' => $get,
            'typeList' => Company::TYPE
        ]);
        $this->setTitle('Компании');
        $this->setTemplate('company/index.html.php');
    }
}