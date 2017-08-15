<?php
namespace Control\Route_sys_group_edit;

use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_group_edit
 */
class POST extends AdminController
{
    /**
     * Update group item.
     */
    public function edit()
    {
        $group = new Group($this->mysql());
        if ($group->edit()) {
            $this->successMessage('Группа сохранена');
        } else {
            $this->setErrorComment($group->error());
            switch ($group->error()) {
                case Group::GROUP_EXIST:
                    $this->failMessage('Группа с таким имененм уже имеется');
                    break;
                default:
                    $this->failMessage('Не удалось сохранить группу');
            }

        }
        $this->setRedirect($this->request->makeUrl('sys/group'));
    }
}