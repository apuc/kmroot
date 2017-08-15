<?php
namespace Control\Route_sys_admin_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_admin_edit
 */
class POST extends AdminController
{
    /**
     * Update administrator.
     */
    public function edit()
    {
        $admin = new Admin($this->mysql());
        if ($admin->edit()) {
            $this->successMessage('Администратор сохранен');
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
                    $this->failMessage('Не удалось сохранить изменения');
            }

            $this->addData([
                'admin' => $admin->getById((new GetBag())->fetchInt('id')),
                'groupList' => (new Group($this->mysql()))->getList(),
            ]);
            $this->setTitle('Редактировать администратора');
            $this->setTemplate('sys/admin.edit.html.php');
        }
    }
}