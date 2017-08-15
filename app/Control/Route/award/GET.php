<?php
namespace Control\Route_award;

use Kinomania\Control\Award\Award;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $award = new Award($this->mysql());
        
        $this->addData([
            'list' => $award->getList(),
        ]);
        $this->setTitle('Премии');
        $this->setTemplate('award/index.html.php');
    }
}