<?php
namespace Kinomania\Control\Award\Year;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

/**
 * Class Year
 * @package Kinomania\Control\Award\Year
 */
class Year extends DB
{
    /**
     * Error codes.
     */
    const ER_INPUT = 1;
    const ER_EXIST = 2;

    public function editDate($awardId, $year)
    {
        $awardId = intval($awardId);
        $year = intval($year);
        
        $post = new PostBag();
        $from = $post->fetchEscape('from', $this->db);
        $to = $post->fetchEscape('to', $this->db);

        if (empty($from)) {
            $from = 'null';
        } else {
            $from = '\'' . $from . '\'';
        }
        if (empty($to)) {
            $to = 'null';
        } else {
            $to = '\'' . $to . '\'';
        }
        
        $this->db->query("UPDATE `awards_year` SET `from` = {$from}, `to` = {$to} WHERE `awardId` = {$awardId} AND `year` = {$year} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }
        
        return true;
    }

    public function delete($awardId, $year)
    {
        $awardId = intval($awardId);
        $year = intval($year);

        $this->db->query("DELETE FROM `awards_year` WHERE `awardId` = {$awardId} AND `year` = {$year} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $result = $this->db->query("SELECT GROUP_CONCAT(`year` ORDER BY `year` DESC SEPARATOR ',') as `year` FROM `awards_year` WHERE `awardId` = {$awardId} GROUP BY `awardId`");
        if ($row = $result->fetch_assoc()) {
            $year = $this->db->real_escape_string($row['year']);
            $this->db->query("UPDATE `awards` SET `year` = '{$year}' WHERE `id` = {$awardId} LIMIT 1");
        }

        return true;
    }

    public function edit()
    {
        $this->error = '';
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $awardId = $post->fetchInt('awardId');
        $year = $post->fetchEscape('year', $this->db);

        $this->db->query("UPDATE `awards_year` SET
                          `id` = {$id},
                          `awardId` = {$awardId},
                          `year` = '{$year}'
                          WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $result = $this->db->query("SELECT GROUP_CONCAT(`year` ORDER BY `year` DESC SEPARATOR ',') as `year` FROM `awards_year` WHERE `awardId` = {$awardId} GROUP BY `awardId`");
        if ($row = $result->fetch_assoc()) {
            $year = $this->db->real_escape_string($row['year']);
            $this->db->query("UPDATE `awards` SET `year` = '{$year}' WHERE `id` = {$awardId} LIMIT 1");
        }

        return true;
    }

    /**
     * @return bool
     */
    public function add()
    {
        $this->error = '';
        $post = new PostBag();

        $awardId = $post->fetchInt('awardId');
        $year = $post->fetchInt('year');

        if (1901 > $year || 2155 < $year) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `awards` WHERE `id` = {$awardId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::ER_INPUT;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `awards_year` WHERE `awardId` = {$awardId} AND `year` = '{$year}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::ER_EXIST;
            return false;
        }

        $this->db->query("INSERT INTO `awards_year` SET
                          `awardId` = {$awardId},
                          `year` = '{$year}',
                          `from` = null,
                          `to` = null
                          ");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $result = $this->db->query("SELECT GROUP_CONCAT(`year` ORDER BY `year` DESC SEPARATOR ',') as `year` FROM `awards_year` WHERE `awardId` = {$awardId} GROUP BY `awardId`");
        if ($row = $result->fetch_assoc()) {
            $year = $this->db->real_escape_string($row['year']);
            $this->db->query("UPDATE `awards` SET `year` = '{$year}' WHERE `id` = {$awardId} LIMIT 1");
        }

        return true;
    }
}