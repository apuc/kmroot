<?php
namespace Control\Route_sys_admin_rights;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Package\Permission;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $admin = (new Admin($this->mysql()))->getById((new GetBag())->fetchInt('id'));
        if (0 < $admin->id()) {
            $permission = new Permission();
            $this->addData([
                'admin' => $admin,
                'list' => $permission->adminRights($this->mysql(), $admin->id()),
                'group' => $permission->groupRights($this->mysql(), $admin->groupId())
            ]);
            $this->setTitle('Права доступа группы');
            $this->setTemplate('sys/admin/rights.html.php');
        } else {
            $this->setRedirect($this->request->makeUrl('sys/admin'));
        }
    }
}