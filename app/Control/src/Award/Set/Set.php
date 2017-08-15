<?php
namespace Kinomania\Control\Award\Set;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Person\Stat;
use Kinomania\System\Base\DB;

class Set extends DB
{
    /**
     * @param $awardId
     * @param $year
     * @return bool
     */
    public function add($awardId, $year)
    {

        $post = new PostBag();
        $nominationId = $post->fetchInt('nominationId');
        $personId = $post->fetchInt('personId');
        $filmId = $post->fetchInt('filmId');

        if (0 == $personId && 0 == $filmId) {
            return false;
        }

        $this->db->query("INSERT INTO `awards_set` SET `awardId` = {$awardId}, `year` = {$year}, `nominationId` = {$nominationId}, `filmId` = {$filmId}, `personId` = {$personId}, `win` = 'false'");
        if (!empty($this->db->error)) {
            return false;
        }

        /**
         * Stat.
         */
        if (0 != $personId) {
            $this->updatePersonAwardList($personId);

            $stat = new Stat($this->db);
            $stat->updateAwardCount($personId);
        }

        if (0 != $filmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($filmId);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function deleteNominee()
    {
        $post = new PostBag();
        $id = $post->fetchInt('setId');

        /**
         * Fix stat.
         */
        $personId = 0;
        $filmId = 0;
        $result = $this->db->query("SELECT `personId`, `filmId` FROM `awards_set` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $personId = $row['personId'];
            $filmId = $row['filmId'];
        }
        

        $this->db->query("DELETE FROM `awards_set` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            return false;
        }

        /**
         * Fix stat.
         */
        if (0 < $personId) {
            $stat = new Stat($this->db);
            $stat->updateAwardCount($personId);
        }

        if (0 < $filmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($filmId);
        }

        return true;
    }
    
    /**
     * @return bool
     */
    public function editNominee()
    {

        $post = new PostBag();
        $id = $post->fetchInt('setId');
        $personId = $post->fetchInt('personId');
        $filmId = $post->fetchInt('filmId');

        /**
         * Clear prev stat count.
         */
        $prevPersonId = 0;
        $prevFilmId = 0;
        $result = $this->db->query("SELECT `personId`, `filmId` FROM `awards_set` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $prevPersonId = $row['personId'];
            $prevFilmId = $row['filmId'];
        }

        /**
         * Delete if empty.
         */
        if (0 != $id && 0 == $personId && 0 == $filmId) {
            $this->db->query("DELETE FROM `awards_set` WHERE `id` = {$id} LIMIT 1");
            
            /**
             * Clear prev stat count.
             */
            if (0 < $prevPersonId) {
                $stat = new Stat($this->db);
                $stat->updateAwardCount($prevPersonId);
            }
            if (0 < $prevFilmId) {
                $stat = new \Kinomania\Control\Film\Stat($this->db);
                $stat->updateAwardCount($prevFilmId);
            }

            return true;
        }

        $this->db->query("UPDATE `awards_set` SET `filmId` = {$filmId}, `personId` = {$personId} WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            return false;
        }

        /**
         * Clear prev stat count.
         */
        if (0 < $prevPersonId) {
            $stat = new Stat($this->db);
            $stat->updateAwardCount($prevPersonId);
        }
        if (0 < $prevFilmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($prevFilmId);
        }

        if (0 != $personId) {
            $this->updatePersonAwardList($personId);

            $stat = new Stat($this->db);
            $stat->updateAwardCount($personId);
        }

        if (0 != $filmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($filmId);
        }

        return true;
    }

    /**
     * @param $awardId
     * @param $year
     * @return bool
     */
    public function editWin($awardId, $year)
    {

        $post = new PostBag();
        $nominationId = $post->fetchInt('nominationId');
        $id = $post->fetchInt('setId');
        $personId = $post->fetchInt('personId');
        $filmId = $post->fetchInt('filmId');
        
        /**
         * Clear prev stat count.
         */
        $prevPersonId = 0;
        $prevFilmId = 0;
        $result = $this->db->query("SELECT `personId`, `filmId` FROM `awards_set` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $prevPersonId = $row['personId'];
            $prevFilmId = $row['filmId'];
        }

        /**
         * Delete if empty.
         */
        if (0 != $id && 0 == $personId && 0 == $filmId) {
            $this->db->query("DELETE FROM `awards_set` WHERE `id` = {$id} LIMIT 1");

            /**
             * Clear prev stat count.
             */
            if (0 < $prevPersonId) {
                $stat = new Stat($this->db);
                $stat->updateAwardCount($prevPersonId);
            }
            if (0 < $prevFilmId) {
                $stat = new \Kinomania\Control\Film\Stat($this->db);
                $stat->updateAwardCount($prevFilmId);
            }

            return true;
        }

        if (0 == $id) {
            $this->db->query("INSERT INTO `awards_set` SET `awardId` = {$awardId}, `year` = {$year}, `nominationId` = {$nominationId}, `filmId` = {$filmId}, `personId` = {$personId}, `win` = 'true'");
        } else {
            $this->db->query("UPDATE `awards_set` SET `filmId` = {$filmId}, `personId` = {$personId} WHERE `id` = {$id} LIMIT 1");
        }
        if (!empty($this->db->error)) {
            return false;
        }


        /**
         * Clear prev stat count.
         */
        if (0 < $prevPersonId) {
            $stat = new Stat($this->db);
            $stat->updateAwardCount($prevPersonId);
        }
        if (0 < $prevFilmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($prevFilmId);
        }

        if (0 != $personId) {
            $this->updatePersonAwardList($personId);

            $stat = new Stat($this->db);
            $stat->updateAwardCount($personId);
        }

        if (0 != $filmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($filmId);
        }

        return true;
    }

    /**
     * @param $awardId
     * @param $year
     * @return bool
     */
    public function delete($awardId, $year)
    {
        $awardId = intval($awardId);
        $year = intval($year);

        /**
         * Stat.
         */
        $personIdList = [];
        $filmIdList = [];
        $result = $this->db->query("SELECT `personId`, `filmId` FROM `awards_set` WHERE `awardId` = {$awardId} AND `year` = {$year}");
        $stat = new Stat($this->db);
        while ($row = $result->fetch_assoc()) {
            $personIdList[] = $row['personId'];
            $filmIdList[] = $row['filmId'];
        }

        $this->db->query("DELETE FROM `awards_set` WHERE `awardId` = {$awardId} AND `year` = {$year}");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Stat.
         */
        foreach ($personIdList as $personId) {
            $stat->updateAwardCount($personId);

            $stat = new Stat($this->db);
            $stat->updateAwardCount($personId);
        }
        foreach ($filmIdList as $filmId) {
            $stat = new \Kinomania\Control\Film\Stat($this->db);
            $stat->updateAwardCount($filmId);
        }

        return true;
    }

    private function updatePersonAwardList($personId)
    {
        $personId = intval($personId);

        $award_list = [];
        $result2 = $this->db->query("SELECT `id` FROM `awards` ORDER BY `id`");
        while ($row2 = $result2->fetch_assoc()) {
            $awardId = $row2['id'];
            $countWin = 0;
            $countNominee = 0;
            $result3 = $this->db->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `awardId` = {$awardId} AND `personId` = {$personId} AND `win` = 'true' GROUP BY `awardId`");
            if ($row3 = $result3->fetch_assoc()) {
                $countWin = $row3['count'];
            }
            $result3 = $this->db->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `awardId` = {$awardId} AND `personId` = {$personId} GROUP BY `awardId`");
            if ($row3 = $result3->fetch_assoc()) {
                $countNominee = $row3['count'];
            }
            if (0 < $countNominee) {
                $award_list[] = $awardId . ':' . $countWin . ':' . $countNominee;
            }
        }
        $award_list = implode(';', $award_list);
        $award_list = $this->db->real_escape_string($award_list);

        $this->db->query("UPDATE `person` SET `award_list` = '{$award_list}' WHERE `id` = {$personId} LIMIT 1");
    }
}