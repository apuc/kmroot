<?php
namespace Control\Route_sys_group_rights;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Package\Permission;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_group_rights
 */
class POST extends AdminController
{
    /**
     * Update package route rights for groups.
     */
    public function change()
    {
        $post = new PostBag();
        if ($post->has('block')) {
            $permission = new Permission();
            if ($permission->blockGroupRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        } else if ($post->has('clear')) {
            $permission = new Permission();
            if ($permission->clearGroupRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        } else {
            $permission = new Permission();
            if ($permission->unblockGroupRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        }
        $this->setRedirect();
    }
}