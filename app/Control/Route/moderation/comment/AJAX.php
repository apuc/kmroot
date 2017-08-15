<?php
namespace Control\Route_moderation_comment;

use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Comment($this->mysql()))->renderTable());
    }
}