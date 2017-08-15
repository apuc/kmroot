<?php
namespace Control\Route_sys_admin_rights;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Package\Permission;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_admin_rights
 */
class POST extends AdminController
{
    /**
     * Update package route rights for admin.
     */
    public function change()
    {
        $post = new PostBag();
        if ($post->has('block')) {
            $permission = new Permission();
            if ($permission->blockAdminRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        } else if ($post->has('clear')) {
            $permission = new Permission();
            if ($permission->clearAdminRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        } else {
            $permission = new Permission();
            if ($permission->unblockAdminRights($this->mysql())) {
                $this->successMessage('Изменения сохранены');
            } else {
                $this->infoMessage('Укажите маршруты');
            }
        }
        $this->setRedirect();
    }
}