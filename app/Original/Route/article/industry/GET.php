<?php
namespace Original\Route_article_industry;

use Kinomania\Original\Controller\DefaultController;

class GET extends DefaultController
{
    public function index()
    {
        $this->setRedirect('/article/podborki');
    }
}