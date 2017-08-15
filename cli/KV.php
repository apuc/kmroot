<?php
require_once dirname(__FILE__) . '/IBase.php';

class KV extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `eav_storage`");

        /**
         * Copy ethnic
         */
        $result = $this->db_from->query("SELECT `name` FROM `physical_person` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'ethnic' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'ethnic', `value` = '{$name}'");
            }
        }

        /**
         * Copy sport
         */
        $result = $this->db_from->query("SELECT `name` FROM `sport` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'sport' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'sport', `value` = '{$name}'");
            }
        }

        /**
         * Copy language
         */
        $result = $this->db_from->query("SELECT `name` FROM `foreign_language` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'language' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'language', `value` = '{$name}'");
            }
        }

        /**
         * Copy music_instrument
         */
        $result = $this->db_from->query("SELECT `name` FROM `musical_instrument` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'music_instrument' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'music_instrument', `value` = '{$name}'");
            }
        }

        /**
         * Copy dance
         */
        $result = $this->db_from->query("SELECT `name` FROM `dance` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'dance' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'dance', `value` = '{$name}'");
            }
        }

        /**
         * Copy sing
         */
        $result = $this->db_from->query("SELECT `name` FROM `sing` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'sing' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'sing', `value` = '{$name}'");
            }
        }

        /**
         * Copy university
         */
        $result = $this->db_from->query("SELECT `name` FROM `university` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'university' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'university', `value` = '{$name}'");
            }
        }

        /**
         * Copy department
         */
        $result = $this->db_from->query("SELECT `name` FROM `department` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'department' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'department', `value` = '{$name}'");
            }
        }

        /**
         * Copy studio
         */
        $result = $this->db_from->query("SELECT `name` FROM `studio` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'studio' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'studio', `value` = '{$name}'");
            }
        }

        /**
         * Copy theatre
         */
        $result = $this->db_from->query("SELECT `name` FROM `theater` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = str_replace('"', '\'', $row['name']);
            $name = $this->db_to->real_escape_string($name);
            if (empty($name)) {
                continue;
            }
            $result2 = $this->db_to->query("SELECT 1 FROM `eav_storage` WHERE `key` = 'theatre' AND `value` = '{$name}' LIMIT 1");
            if (!$row2 = $result2->fetch_assoc()) {
                $this->db_to->query("INSERT INTO `eav_storage` SET `key` = 'theatre', `value` = '{$name}'");
            }
        }
    }
}