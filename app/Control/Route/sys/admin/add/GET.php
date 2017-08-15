<?php
namespace Control\Route_sys_admin_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_admin_add
 */
class GET extends AdminController
{
    public function index()
    {
        $this->addData([
            'groupList' => (new Group($this->mysql()))->getList(),
            'post' => new PostBag()
        ]);
        $this->setTitle('Добавить администратора');
        $this->setTemplate('sys/admin/add.html.php');
    }
}