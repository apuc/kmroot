<?php
require_once dirname(__FILE__) . '/IBase.php';

class Company extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `company`");

        /**
         * Company
         */
        $result = $this->db_from->query("SELECT * FROM `hires` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $kmId = intval($row['id']);
            $image = '';
            if (0 < $row['image']) {
                $image = 'jpeg';
            }
            $name = $this->db_to->real_escape_string($this->repairText($row['name']));
            $short_name = $this->db_to->real_escape_string($this->repairText($row['shortname']));
            $site = $this->db_to->real_escape_string($this->repairText($row['site_link']));
            $phone = $this->db_to->real_escape_string($this->repairText($row['phone']));
            $fax = $this->db_to->real_escape_string($this->repairText($row['fax']));
            $kinometro = $this->db_to->real_escape_string($this->repairText($row['kinometro_id']));
            $text = $this->db_to->real_escape_string($this->repairText($row['about'], false));

            $text = str_replace('<div', '<p', $text);
            $text = str_replace('</div>', '</p>', $text);

            if (false === strpos($text, '<p>')) {
                $text = '<p>' . $text . '</p>';
            }
            $text = str_replace('http://www.kinomania.ru/', '/', $text);

            $result2 = $this->db_to->query("SELECT 1 FROM `company` WHERE `name` = '{$name}' LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                continue;
            }

            /**
             * Company type.
             */
            $result2 = $this->db_from->query("SELECT t1.`id`, t1.`name` FROM `company_type` as `t1` JOIN `h2t` as `t2` ON t1.`id` = t2.`tid` WHERE t2.`hid` = {$row['id']} LIMIT 1");
            $row2 = $result2->fetch_assoc();
            if (10 == $row2['id']) {
                $type = 'Фонд';
            } else {
                $type = $this->db_to->real_escape_string($row2['name']);
            }

            $query = "INSERT INTO `company` SET
                                `id` = {$kmId},
                                `s` = 0,
                                `image` = '{$image}',
                                `type` = '{$type}', 
                                `status` = 'show',
                                `name` = '{$name}', 
                                `short_name` = '{$short_name}', 
                                `site` = '{$site}', 
                                `phone` = '{$phone}', 
                                `fax` = '{$fax}',
                                `text` = '{$text}',
                                `kinometro` = '{$kinometro}'
                                ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
    }
}