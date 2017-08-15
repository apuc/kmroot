<?php
namespace Control\Route_sys_group_add;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_group_add
 */
class AJAX extends AdminController
{
    /**
     * Check group name, must be unique.
     */
    public function checkName()
    {
        $nameExist = false;
        $name = (new GetBag())->fetch('name');
        if (!empty($name)) {
            $name = $this->mysql()->real_escape_string($name);
            $result = $this->mysql()->query("SELECT 1 FROM `admin_group` WHERE `name` = '{$name}' LIMIT 1");
            if (1 == $result->num_rows) {
                $nameExist = true;
            }
        }
        if ($nameExist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }
}