<?php
namespace Control\Route_sys_rights;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Права доступа');
        $this->setTemplate('sys/rights.html.php');
    }
}