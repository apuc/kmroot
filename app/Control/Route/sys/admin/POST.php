<?php
namespace Control\Route_sys_admin;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_sys_admin
 */
class POST extends AdminController
{
    /**
     * Change admin status to `banned`
     */
    public function block()
    {
        if ($this->admin()->id() == (new PostBag())->fetchInt('id')) {
            $this->infoMessage('Не стоит блокировать самого себя');
        } else {
            (new Admin($this->mysql()))->block($this->getPostId());
            $this->successMessage('Администратор заблокирован');
        }
        $this->setRedirect();
    }

    /**
     * Change admin status to `active`
     */
    public function unblock()
    {
        (new Admin($this->mysql()))->unblock($this->getPostId());
        $this->successMessage('Администратор разблокирован');
        $this->setRedirect();
    }

    /**
     * Delete admin.
     */
    public function delete()
    {
        if ($this->admin()->id() == (new PostBag())->fetchInt('id')) {
            $this->infoMessage('Не стоит удалять самого себя');
        } else {
            (new Admin($this->mysql()))->delete($this->getPostId());
            $this->successMessage('Администратор удалён');
        }
        $this->setRedirect();
    }

    /**
     * @return int
     */
    private function getPostId()
    {
        return (new PostBag())->fetchInt('id');
    }
}