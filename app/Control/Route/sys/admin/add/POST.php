<?php
namespace Control\Route_sys_admin_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_admin_add
 */
class POST extends AdminController
{
    /**
     * Create new administrator.
     */
    public function add()
    {
        $admin = new Admin($this->mysql());
        if ($admin->add()) {
            $this->successMessage('Администратор добавлен');
            $this->setRedirect($this->request->makeUrl('sys/admin'));
        } else {
            $this->setErrorComment($admin->error());
            switch ($admin->error()) {
                case Admin::EMAIL_EXIST:
                    $this->failMessage('Администратор с таким email уже имеется');
                    break;
                case Admin::EMPTY_PASSWORD:
                    $this->failMessage('Некорректный пароль');
                    break;
                case Admin::WRONG_EMAIL:
                    $this->failMessage('Ошибка в email');
                    break;
                default:
                    $this->failMessage('Не удалось добавить администратора');
            }

            /**
             * Return to the admin.add template.
             */
            $this->addData([
                'groupList' => (new Group($this->mysql()))->getList(),
                'post' => (new PostBag())
            ]);
            $this->setTitle('Добавить администратора');
            $this->setTemplate('sys/admin/add.html.php');
        }
    }
}