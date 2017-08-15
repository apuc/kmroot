<?php
namespace Control\Route_award_nomination;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Award\Award;
use Kinomania\Control\Award\Nomination\Item;
use Kinomania\Control\Award\Nomination\Nomination;
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
            $nominationItem = new Item();
            if ($get->has('nominationId')) {
                $nomination = new Nomination($this->mysql());
                $nominationItem = $nomination->getById($get->fetchInt('nominationId'));
            }
            $this->addData([
                'award' => $item,
                'list' => $award->getNominationList($item->id()),
                'nomination' => $nominationItem
            ]);
            $this->setTitle('Номинации');
            $this->setTemplate('award/nomination.html.php');
        }
    }
}