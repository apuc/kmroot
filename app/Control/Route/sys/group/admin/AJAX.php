<?php
namespace Control\Route_sys_group_admin;

use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_group_admin
 */
class AJAX extends AdminController
{
    /**
     * Get data for DataTable plugin.
     */
    public function getList()
    {
        $this->setContent((new Group($this->mysql()))->renderTable('groupAdmin'));
    }
}