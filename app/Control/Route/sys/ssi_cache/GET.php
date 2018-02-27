<?php
namespace Control\Route_sys_ssi_cache;

use Kinomania\Control\Check\Check;
use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Config\Server;

class GET extends AdminController
{
    public function index()
    {
        $check = new Check($this->root);
        $this->addData([
            'check' => $check,
            'mysqlInfo' => mysqli_get_server_info($this->mysql()),
            'staticServer' => implode(',', Server::STATIC),
        ]);
        $this->setTitle('Проверка системы');
        $this->setTemplate('sys/ssi_cache/index.html.php');
    }
}