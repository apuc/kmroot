<?php
namespace Control\Route_user;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\User\User;

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
        $this->setContent((new User($this->mysql()))->renderTable());
    }
}