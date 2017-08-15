<?php
namespace Control\Route_boxoffice;

use Kinomania\Control\Boxoffice\Boxoffice;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Boxoffice($this->mysql()))->renderTable());
    }
}