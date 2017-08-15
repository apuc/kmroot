<?php
require_once dirname(__FILE__) . '/IBase.php';

class Count extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `count`");
        
        /**
         * Film.
         */
        $result = $this->db_to->query("SELECT COUNT(*) as `count` FROM `film`");
        if ($row = $result->fetch_assoc()) {
            $count = intval($row['count']);
            $this->db_to->query("INSERT INTO `count` SET `key` = 'film', `count` = {$count}");
        }

        /**
         * Person.
         */
        $result = $this->db_to->query("SELECT COUNT(*) as `count` FROM `person`");
        if ($row = $result->fetch_assoc()) {
            $count = intval($row['count']);
            $this->db_to->query("INSERT INTO `count` SET `key` = 'person', `count` = {$count}");
        }

        /**
         * News.
         */
        $result = $this->db_to->query("SELECT COUNT(*) as `count` FROM `news`");
        if ($row = $result->fetch_assoc()) {
            $count = intval($row['count']);
            $this->db_to->query("INSERT INTO `count` SET `key` = 'news', `count` = {$count}");
        }

        /**
         * User.
         */
        $result = $this->db_to->query("SELECT COUNT(*) as `count` FROM `user`");
        if ($row = $result->fetch_assoc()) {
            $count = intval($row['count']);
            $this->db_to->query("INSERT INTO `count` SET `key` = 'user', `count` = {$count}");
        }
    }
}