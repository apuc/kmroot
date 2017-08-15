<?php
namespace Control\Route_moderation_comment_location;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        if (0 < $id) {
            $this->setRedirect((new Comment($this->mysql()))->location($id));
        }
    }
}