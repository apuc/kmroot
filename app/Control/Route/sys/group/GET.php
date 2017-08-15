<?php
namespace Control\Route_sys_group;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_group
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Группы администраторов');
        $this->setTemplate('sys/group/index.html.php');
    }
}