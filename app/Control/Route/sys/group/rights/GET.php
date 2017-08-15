<?php
namespace Control\Route_sys_group_rights;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Package\Permission;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_group_rights
 */
class GET extends AdminController
{
    public function index()
    {
        $group = (new Group($this->mysql()))->getByID((new GetBag())->fetchInt('id'));
        if (empty($group->name())) {
            $group->initFromArray([
                'name' => 'Вне групп'
            ]);
        }
        $this->addData([
            'group' => $group,
            'list' => (new Permission())->groupRights($this->mysql(), $group->id())
        ]);
        $this->setTitle('Права доступа группы');
        $this->setTemplate('sys/group/rights.html.php');
    }
}