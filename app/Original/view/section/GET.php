<?php
namespace Original\Route_index;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $this->addData([
            'options' => new Options()
        ]);
        $this->setTemplate('index.html.php');
    }
}