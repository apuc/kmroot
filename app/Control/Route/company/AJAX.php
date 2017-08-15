<?php
namespace Control\Route_company;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Company\Company;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_company
 */
class AJAX extends AdminController
{
    public function getList()
    {
        $this->setContent((new Company($this->mysql()))->renderTable());
    }

    /**
     * Company name must be unique.
     */
    public function checkName()
    {
        $get = new GetBag();

        $exist = false;
        $name = $get->fetchEscape('name', $this->mysql());
        $result = $this->mysql()->query("SELECT 1 FROM `company` WHERE `name` = '{$name}' LIMIT 1");
        if (1 == $result->num_rows) {
            $exist = true;
        }

        if ($exist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }
}