<?php
require_once dirname(__FILE__) . '/IBase.php';

class Admin extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `admin`");
        $this->db_to->query("TRUNCATE `admin_group`");

        $hashChange = strtotime('now') - 86400;

        $password = $this->db_to->real_escape_string('$2y$10$YT0RZH7t/5H6JHZnA7DB/egcz/kBsPzGf49qXoMUjxeL5pgf5GmMu');
        $query = "INSERT INTO `admin` SET 
                  `groupId` = 1,
                  `email` = 'admin@kinomania.ru',
                  `password` = '{$password}',
                  `status` = 'active',
                  `hash` = '',
                  `hashChange` = FROM_UNIXTIME('{$hashChange}'),
                  `name` = 'Admin',
                  `surname` = 'Root',
                  `userId` = 0
                  ";
        $this->db_to->query($query);
        $this->db_to->query("INSERT INTO `admin_group` SET `name` = 'Root', `userCount` = 1");

        $result = $this->db_from->query("SELECT t2.`Status`, t2.`ID`, t2.`NicName`, t2.`Name1`, t2.`Name2`, t2.`Password` FROM `administrator` as `t1` JOIN `a_Accounts` as `t2` ON t1.`user_id` = t2.`ID` WHERE 1");
        //$result = $this->db_from->query("SELECT t1.`active`, t2.`ID`, t2.`NicName`, t2.`Name1`, t2.`Name2`, t2.`Password` FROM `autors` as `t1` JOIN `a_Accounts` as `t2` ON t1.`user_id` = t2.`ID` WHERE 1");
        while ($row = $result->fetch_assoc()) {
            $email = $this->db_to->real_escape_string($this->repairText($row['NicName']));
            if (empty($email)) {
                continue;
            }
            $email .= '@kinomania.ru';

            $password = $this->getPassword($row['Password']);

            $status = 'active';
            if (1 != $row['Status']) {
                $status = 'banned';
            }

            $name = $this->db_to->real_escape_string($this->repairText($row['Name1']));
            $surname = $this->db_to->real_escape_string($this->repairText($row['Name2']));
            $userId = intval($row['ID']);

            $query = "INSERT INTO `admin` SET 
                  `groupId` = 0,
                  `email` = '{$email}',
                  `password` = '{$password}',
                  `status` = '{$status}',
                  `hash` = '',
                  `hashChange` = FROM_UNIXTIME('{$hashChange}'),
                  `name` = '{$name}',
                  `surname` = '{$surname}',
                  `userId` = {$userId}
                  ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                echo "\n\n";
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit();
            }
        }
    }

    private function getPassword($password)
    {
        $out = '';
        $key = '111';

        $password = base64_decode($password);
        for ($i = 0; $i < strlen($password); $i++) {
            $keyChar = 0;
            if ($i % 4 != 3) {
                $keyChar = ord($key[$i % 4]);
            }
            $passChar = ord($password[$i]);
            $out .= chr($keyChar ^ $passChar);
        }

        return password_hash($out, PASSWORD_DEFAULT);
    }
}