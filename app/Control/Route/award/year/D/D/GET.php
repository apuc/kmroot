<?php
namespace Control\Route_award_year_D_D;

use Kinomania\Control\Award\Award;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $award = new Award($this->mysql());
        $item = $award->getById($awardId);

        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('award'));
        } else {
            $result = $this->mysql()->query("SELECT `from`, `to` FROM `awards_year` WHERE `awardId` = {$awardId} AND `year` = {$year} LIMIT 1");
            if (!$row = $result->fetch_assoc()) {
                $this->setRedirect($this->request->makeUrl('award'));
            } else {
                $nominationList = $award->getNominationList($awardId);
                $idList = [];
                /**
                 * @var \Kinomania\Control\Award\Nomination\Item $i
                 */
                foreach ($nominationList as $i) {
                    $idList[] = $i->id();
                }

                if ('0000-00-00' == $row['from']) {
                    $row['from'] = '';
                }
                if ('0000-00-00' == $row['to']) {
                    $row['to'] = '';
                }

                $this->addData([
                    'award' => $item,
                    'year' => $year,
                    'list' => $nominationList,
                    'set' => $award->getSetList($year, $idList),
                    'from' => $row['from'],
                    'to' => $row['to']
                ]);
                $this->setTitle('Победители и номинанты');
                $this->setTemplate('award/win.html.php');
            }
        }
    }
}