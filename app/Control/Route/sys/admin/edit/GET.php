<?php
namespace Control\Route_sys_admin_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_admin_edit
 */
class GET extends AdminController
{
    public function index()
    {
        $admin = (new Admin($this->mysql()))->getById((new GetBag())->fetchInt('id'));
        if (0 < $admin->id()) {
            $this->addData([
                'admin' => $admin,
                'groupList' => (new Group($this->mysql()))->getList(),
            ]);
            $this->setTitle('Редактировать администратора');
            $this->setTemplate('sys/admin/edit.html.php');
        } else {
            $this->setRedirect($this->request->makeUrl('sys/admin'));
        }
    }
}