<?php
namespace Control\Route_sys_group_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_group_edit
 */
class AJAX extends AdminController
{
    /**
     * Group name must be unique.
     */
    public function checkName()
    {
        $nameExist = false;
        $name = (new GetBag())->fetch('name');
        $id = (new GetBag())->fetchInt('id');
        if (!empty($name)) {
            $name = $this->mysql()->real_escape_string($name);
            $result = $this->mysql()->query("SELECT 1 FROM `admin_group` WHERE `id` != {$id} AND `name` = '{$name}' LIMIT 1");
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