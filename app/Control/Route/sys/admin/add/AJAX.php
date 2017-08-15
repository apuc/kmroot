<?php
namespace Control\Route_sys_admin_add;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_sys_admin_add
 */
class AJAX extends AdminController
{
    /**
     * Administrator email must be unique.
     */
    public function checkEmail()
    {
        $exist = false;
        $email = (new GetBag())->fetch('email');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = $this->mysql()->real_escape_string($email);
            $result = $this->mysql()->query("SELECT 1 FROM `admin` WHERE `email` = '{$email}' LIMIT 1");
            if (1 == $result->num_rows) {
                $exist = true;
            }
        }

        if ($exist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }

    /**
     * Administrator userId must be unique.
     */
    public function checkUserId()
    {
        $exist = false;
        $userId = (new GetBag())->fetchInt('userId');
        if (0 < $userId) {
            $result = $this->mysql()->query("SELECT 1 FROM `admin` WHERE `userId` = '{$userId}' LIMIT 1");
            if (1 == $result->num_rows) {
                $exist = true;
            }
        }

        if ($exist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
    }
}