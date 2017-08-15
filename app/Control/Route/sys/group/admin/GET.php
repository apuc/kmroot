<?php
namespace Control\Route_sys_group_admin;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_group_admin
 */
class GET extends AdminController
{
    public function index()
    {
        $group = (new Group($this->mysql()))->getByID((new GetBag())->fetchInt('id'));
        $name = 'Вне групп';
        if (0 < $group->id()) {
            $name = $group->name();
        }
        $this->addData([
            'id' => $group->id()
        ]);
        $this->setTitle('Список администраторов группы `' . $name . '`');
        $this->setTemplate('sys/group/admin.html.php');
    }
}