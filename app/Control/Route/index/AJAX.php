<?php
namespace Control\Route_index;

use Kinomania\Control\Controller\AdminController;

/**
 * Class AJAX
 * @package Control\Route_index
 */
class AJAX extends AdminController
{
    public function getNew()
    {
        $comment = 0;

        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `film_review` WHERE `status` = 'hide'");
        if ($row = $result->fetch_assoc()) {
            $comment = $row['count'];
        }


        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `person_review` WHERE `status` = 'hide'");
        if ($row = $result->fetch_assoc()) {
            $comment += $row['count'];
        }


        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `moderate` WHERE `new` = 'true'");
        if ($row = $result->fetch_assoc()) {
            $comment += $row['count'];
        }

        $data = [
            'comment' => $comment,
        ];

        $this->setContent(json_encode($data));
    }
}