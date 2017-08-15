<?php
namespace Control\Route_award_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_award
 */
class AJAX extends AdminController
{
    /**
     * Check short name on existing.
     */
    public function checkCode()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $code = $get->fetchEscape('code', $this->mysql());

        $result = $this->mysql()->query("SELECT 1 FROM `awards` WHERE `id` != {$id} AND `code` = '{$code}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }
}