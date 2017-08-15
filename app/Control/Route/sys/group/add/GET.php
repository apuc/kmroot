<?php
namespace Control\Route_sys_group_add;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_group_add
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Добавить группу администраторов');
        $this->setTemplate('sys/group/add.html.php');
    }
}