<?php
namespace Control\Route_sys_group;

use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_group
 */
class AJAX extends AdminController
{
    /**
     * Get data for DataTable plugin.
     */
    public function getList()
    {
        $this->setContent((new Group($this->mysql()))->renderTable());
    }
}