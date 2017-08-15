<?php
namespace Control\Route_index;

use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_index
 */
class POST extends AdminController
{
    public function update()
    {
        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `film`");
        if ($row = $result->fetch_assoc()) {
            $this->mysql()->query("UPDATE `count` SET `count` = {$row['count']} WHERE `key` = 'film' LIMIT 1");
        }

        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `person`");
        if ($row = $result->fetch_assoc()) {
            $this->mysql()->query("UPDATE `count` SET `count` = {$row['count']} WHERE `key` = 'person' LIMIT 1");
        }

        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `news`");
        if ($row = $result->fetch_assoc()) {
            $this->mysql()->query("UPDATE `count` SET `count` = {$row['count']} WHERE `key` = 'news' LIMIT 1");
        }

        $result = $this->mysql()->query("SELECT COUNT(*) as `count` FROM `user`");
        if ($row = $result->fetch_assoc()) {
            $this->mysql()->query("UPDATE `count` SET `count` = {$row['count']} WHERE `key` = 'user' LIMIT 1");
        }

        $this->setRedirect();
    }
}