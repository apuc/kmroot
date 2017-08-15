<?php
namespace Control\Route_award_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Award\Award;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_award_add
 */
class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');

        $award = new Award($this->mysql());
        $item = $award->getById($id);

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('award'));
        } else {
            $this->addData([
                'item' => $item
            ]);
            $this->setTitle('Редактировать премию');
            $this->setTemplate('award/edit.html.php');
        }
    }
}