<?php
namespace Control\Route_tv;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Tv\Tv;

class GET extends AdminController
{
    public function index()
    {
        $tv = new Tv($this->mysql());
        $this->addData([
            'list' => $tv->getList()
        ]);
        $this->setTitle('TV программа');
        $this->setTemplate('tv/index.html.php');
    }
}