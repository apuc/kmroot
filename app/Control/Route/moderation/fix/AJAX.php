<?php
namespace Control\Route_moderation_fix;

use Kinomania\Control\Comment\Fix;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Fix($this->mysql()))->renderTable());
    }
}