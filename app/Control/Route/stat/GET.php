<?php
namespace Control\Route_stat;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Статистика');
        $this->setTemplate('stat/stat.html.php');
    }
}