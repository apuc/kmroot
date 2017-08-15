<?php
namespace Original\Route_info_casting;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Casting\Casting;

class GET extends DefaultController
{

    public function index()
    {
        $this->setTemplate('casting/info.html.php');
    }
}