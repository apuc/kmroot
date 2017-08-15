<?php
namespace Control\Route_sys_admin_profile;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    /**
     * Email must be unique.
     */
    public function checkEmail()
    {
        $exist = false;
        $email = (new GetBag())->fetch('email');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $id = (new GetBag())->fetchInt('id');
            $email = $this->mysql()->real_escape_string($email);
            $result = $this->mysql()->query("SELECT 1 FROM `admin` WHERE `id` != {$id} AND `email` = '{$email}' LIMIT 1");
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
        $id = (new GetBag())->fetchInt('id');
        if (0 < $userId) {
            $result = $this->mysql()->query("SELECT 1 FROM `admin` WHERE `id` != {$id} AND `userId` = '{$userId}' LIMIT 1");
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