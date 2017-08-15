<?php
namespace Control\Route_user;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Control\Alert\AlertSuccess;
use Dspbee\Core\Response;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\User\User;

/**
 * Class GET
 * @package Control\Route_index
 */
class POST extends AdminController
{
    public function export()
    {
        $response = new Response();
        $response->setContentTypeXml();
        $response->header('Content-Disposition', 'attachment; filename="user.xml"');
        $response->setContent((new User($this->mysql()))->getXml());
        $this->setResponse($response);
    }

    /**
     * Change admin status to `banned`
     */
    public function block()
    {
        (new User($this->mysql()))->block($this->getPostId());
        new AlertSuccess('Пользователь заблокирован');
        $this->setRedirect();
    }

    /**
     * Change admin status to `active`
     */
    public function unblock()
    {
        (new User($this->mysql()))->unblock($this->getPostId());
        new AlertSuccess('Пользователь разблокирован');
        $this->setRedirect();
    }

    /**
     * Change admin status to `active`
     */
    public function activate()
    {
        (new User($this->mysql()))->activate($this->getPostId());
        new AlertSuccess('Пользователь активирован');
        $this->setRedirect();
    }

    /**
     * Delete admin.
     */
    public function delete()
    {
        (new User($this->mysql()))->delete($this->getPostId());
        new AlertSuccess('Пользователь удалён');
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