<?php
namespace Control\Route_user_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\User\User;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();

        $id = $get->fetchInt('id');
        $user = (new User($this->mysql()))->getById($id);

        if (0 == $user->id()) {
            $this->setRedirect($this->request->makeUrl('user'));
        } else {
            $this->addData([
                'user' => $user
            ]);
            $this->setTitle('Редактировать пользователя');
            $this->setTemplate('user/edit.html.php');
        }
    }
}