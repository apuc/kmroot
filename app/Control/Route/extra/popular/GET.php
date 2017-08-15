<?php
namespace Control\Route_extra_popular;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Popular\Popular;
use Kinomania\Control\Video\Video;

class GET extends AdminController
{
    public function index()
    {
        $popular = new Popular($this->mysql());
        
        $this->setTitle('Популярное');
        $this->addData([
            'list' => $popular->list() 
        ]);
        $this->setTemplate('extra/popular/index.html.php');
    }
}