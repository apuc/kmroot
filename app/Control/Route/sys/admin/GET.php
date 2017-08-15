<?php
namespace Control\Route_sys_admin;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_admin
 */
class GET extends AdminController
{
    /**
     * Administrators.
     */
    public function index()
    {
        $this->setTitle('Список администраторов');
        $this->setTemplate('sys/admin/index.html.php');
    }
}