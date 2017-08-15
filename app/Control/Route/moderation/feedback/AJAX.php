<?php
namespace Control\Route_moderation_feedback;

use Kinomania\Control\Comment\Feedback;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Feedback($this->mysql()))->renderTable());
    }
}