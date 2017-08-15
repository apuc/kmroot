<?php
namespace Control\Route_moderation_review;

use Kinomania\Control\Comment\Review;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Review($this->mysql()))->renderTable());
    }
}