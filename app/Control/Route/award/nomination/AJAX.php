<?php
namespace Control\Route_award_nomination;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_award
 */
class AJAX extends AdminController
{
    /**
     * Check name on existing.
     */
    public function checkName()
    {
        $get = new GetBag();
        $awardId = $get->fetchInt('awardId');
        $name_ru = $get->fetchEscape('name_ru', $this->mysql());

        $result = $this->mysql()->query("SELECT 1 FROM `awards_nomination` WHERE `name_ru` = '{$name_ru}' AND `awardId` = {$awardId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }

    /**
     * Check name on existing.
     */
    public function checkNameEdit()
    {
        $get = new GetBag();
        $awardId = $get->fetchInt('awardId');
        $nominationId = $get->fetchInt('nominationId');
        $name_ru = $get->fetchEscape('name_ru', $this->mysql());

        $result = $this->mysql()->query("SELECT 1 FROM `awards_nomination` WHERE `id` != {$nominationId} AND `name_ru` = '{$name_ru}' AND `awardId` = {$awardId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }
}