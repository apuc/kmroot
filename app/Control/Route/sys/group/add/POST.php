<?php
namespace Control\Route_sys_group_add;

use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_group_add
 */
class POST extends AdminController
{
    /**
     * Create new administrator group.
     */
    public function add()
    {
        $group = new Group($this->mysql());
        if ($group->add()) {
            $this->successMessage('Группа добавлена');
        } else {
            $this->setErrorComment($group->error());
            switch ($group->error()) {
                case Group::GROUP_EXIST:
                    $this->failMessage('Группа с таким имененм уже имеется');
                    break;
                default:
                    $this->failMessage('Не удалось добавить группу');
            }

        }
        $this->setRedirect($this->request->makeUrl('sys/group'));
    }
}