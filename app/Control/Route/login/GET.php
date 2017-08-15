<?php
namespace Control\Route_login;

use Kinomania\System\Controller\DefaultController;

/**
 * Class GET
 * @package Control\Route_login
 */
class GET extends DefaultController
{
    public function index()
    {
        $this->setTemplate('admin/auth/login.html.php');
    }
}