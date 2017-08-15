<?php
namespace Control\Route_award_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_award_add
 */
class GET extends AdminController
{
    public function index()
    {
        $this->addData([
            'post' => new PostBag()
        ]);
        $this->setTitle('Добавить премию');
        $this->setTemplate('award/add.html.php');
    }
}