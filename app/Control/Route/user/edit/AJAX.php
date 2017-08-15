<?php
namespace Control\Route_user_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    /**
     * Email must be unique.
     */
    public function checkEmail()
    {
        $get = new GetBag();

        $exist = false;
        $email = $get->fetch('email');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $id = $get->fetchInt('id');
            $email = $this->mysql()->real_escape_string($email);
            $result = $this->mysql()->query("SELECT 1 FROM `user` WHERE `id` != {$id} AND `email` = '{$email}' LIMIT 1");
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