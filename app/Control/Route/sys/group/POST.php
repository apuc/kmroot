<?php
namespace Control\Route_sys_group;

use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_group
 */
class POST extends AdminController
{
    /**
     * Delete administrators group.
     */
    public function delete()
    {
        $group = new Group($this->mysql());
        if ($group->delete()) {
            $this->successMessage('Группа удалена');
        } else {
            $this->setErrorComment($group->error());
            $this->failMessage('Не удалось удалить группу');
        }
        $this->setRedirect();
    }
}