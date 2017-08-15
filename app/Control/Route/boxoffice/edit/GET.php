<?php
namespace Control\Route_boxoffice_edit;

use Kinomania\Control\Boxoffice\Boxoffice;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $boxoffice = new Boxoffice($this->mysql());
        $list = $boxoffice->getList();

        if ([] == $list) {
            $this->setRedirect($this->request->makeUrl('boxoffice'));
        } else {
            $this->addData([
                'list' => $list
            ]);

            $this->setTemplate('boxoffice/edit.html.php');
        }
    }
}