<?php
namespace Control\Route_extra_novelty;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Popular\Popular;
use Kinomania\Control\Video\Video;

class GET extends AdminController
{
    public function index()
    {
        $popular = new Popular($this->mysql());
        
        $this->setTitle('Новинки (популярное)');
        $this->addData([
            'list' => $popular->list() 
        ]);
        $this->setTemplate('extra/novelty/index.html.php');
    }
}