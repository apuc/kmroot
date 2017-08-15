<?php
namespace Control\Route_user;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_index
 */
class GET extends AdminController
{
    public function index()
    {
        $this->setTitle('Пользователи');
        $this->setTemplate('user/user.html.php');
    }

}