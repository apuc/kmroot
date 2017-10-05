<?php
namespace Original\Route_map;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\News\News;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {
        $this->addData([
			'options' => new Options()
        ]);

        $this->setTemplate('map/index.html.php');
    }
}