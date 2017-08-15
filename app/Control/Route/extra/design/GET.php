<?php
namespace Control\Route_extra_design;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Design\Design;

class GET extends AdminController
{
    public function index()
    {
        $design = new Design($this->mysql());

        $this->addData([
            'list' => $design->getList()
        ]);
        
        $this->setTitle('Рекламные блоки на сайте');
        $this->setTemplate('design/index.html.php');
    }
}