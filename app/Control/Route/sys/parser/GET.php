<?php
namespace Control\Route_sys_parser;

use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Отладка парсера');
        $this->setTemplate('sys/parser/index.html.php');
    }
}