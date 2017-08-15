<?php
namespace Control\Route_access;

use Kinomania\Control\Template\Menu;
use Kinomania\System\Controller\DefaultController;

class GET extends DefaultController
{
    public function index()
    {
        $this->addData([
            'menu' => (new Menu($this->request))->print()
        ]);
        $this->setTitle('Недостаточно прав');
        $this->setTemplate('sys/access.html.php');
    }
}