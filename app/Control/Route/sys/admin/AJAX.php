<?php
namespace Control\Route_sys_admin;

use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_admin
 */
class AJAX extends AdminController
{
    /**
     * Get data for DataTable plugin.
     */
    public function getList()
    {
        $this->setContent((new Admin($this->mysql()))->renderTable());
    }
}