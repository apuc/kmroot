<?php
namespace Kinomania\Control\Tv;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Parser\Parser;

class Tv extends DB
{
    use TRepository;
    
    public function getProgram($id)
    {
        $item = new Chanel();
        $id = intval($id);

        $result = $this->db->query("SELECT t1.`id`, t1.`date`, t2.`name` as `chanel` FROM 
                                    `tv_program` as `t1` JOIN 
                                    `tv_chanel` as `t2` ON t2.`id` = t1.`chanelId`
                                    WHERE t1.`id` = {$id} LIMIT 1
                                    ");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }
        
        return $item;
    }

    public function getProgramList($programId)
    {
        $list = [];
        $programId = intval($programId);

        $result = $this->db->query("SELECT `chanelId`, `date` FROM `tv_program` WHERE `id` = {$programId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $result = $this->db->query("SELECT t1.`id`, t1.`time`, t1.`name`, t1.`filmId` FROM 
                                    `tv_program` as `t1`
                                    WHERE `chanelId` = {$row['chanelId']} AND `date` = '{$row['date']}' ORDER BY `time`
                                    ");
            while ($row = $result->fetch_assoc()) {
                $item = new Program();
                $item->initFromArray($row);
                $list[] = $item;
            }
        }

        return $list;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];
        $result = $this->db->query("SELECT ANY_VALUE(t1.`id`) as `id`, ANY_VALUE(t1.`date`) as `date`, ANY_VALUE(t2.`name`) as `chanel` FROM 
                                    `tv_program` as `t1` JOIN 
                                    `tv_chanel` as `t2` ON t2.`id` = t1.`chanelId`
                                    GROUP BY t1.`chanelId`, t1.`date` ORDER BY ANY_VALUE(t1.`id`) DESC
                                    ");
        while ($row = $result->fetch_assoc()) {
            $item = new Chanel();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }

    /**
     * Delete all data.
     * @return bool
     */
    public function reset()
    {
        $this->db->query("TRUNCATE TABLE `tv_program_person`");
        $this->db->query("TRUNCATE TABLE `tv_program`");
        return true;
    }

    /**
     * @return bool
     */
    public function editFilmId()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');
        $filmId = $post->fetchInt('filmId');

        $this->db->query("UPDATE `tv_program` SET `filmId` = {$filmId} WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error =  $this->db->error;
            return false;
        }

        return true;
    }

    public function parse()
    {
        /**
         * Delete previous.
         */
        $date = date('Y-m-d');
        $result = $this->db->query("SELECT `id` FROM `tv_program` WHERE `date` < '{$date}'");
        while ($row = $result->fetch_assoc()) {
            $this->db->query("DELETE FROM `tv_program_person` WHERE `programId` = {$row['id']}");
            $this->db->query("DELETE FROM `tv_program` WHERE `id` = {$row['id']}");
        }

        /**
         * Add new.
         */
        $post = new PostBag();
        $url = $post->fetch('url');
        if (empty($url)) {
            for ($i = 0; $i < 8; $i++) {
                if (0 == $i) {
                    $date = date('Y-m-d');
                } else {
                    $date = date('Y-m-d', strtotime('+' . $i . ' days'));
                }
                $url = 'http://www.vsetv.com/schedule_package_rubase_day_' . $date . '.html';
                $this->parseData($url, $date);
            }
            return true;
        } else {
            $date = date('Y-m-d');
            return $this->parseData($url, $date);
        }
    }

    private function parseData($url, $date)
    {
        $result = $this->db->query("SELECT `id` FROM `tv_program` WHERE `date` = '{$date}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            return true;
        }

        $parser = new Parser(false);
        $parser->tv($url);
        $parser->log($this->db);
        if (empty($parser->error())) {
            $data = $parser->data();
            foreach ($data as $chanel => $program) {
                $chanel = $this->db->real_escape_string($chanel);
                $result = $this->db->query("SELECT `id` FROM `tv_chanel` WHERE `name` = '{$chanel}' LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $chanelId = $row['id'];

                    foreach ($program as $time => $name) {
                        $filmId = 0;

                        if (false !== stripos($name, 'Х/ф')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1]);
                                }
                            }
                        } elseif (false !== stripos($name, 'Т/с')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1], 'series');
                                }
                            }
                        } elseif (false !== stripos($name, 'М/с')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1]);
                                }
                            }
                        }  elseif (false !== stripos($name, 'М/ф')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1]);
                                }
                            }
                        } elseif (false !== stripos($name, 'Д/с')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1]);
                                }
                            }
                        } elseif (false !== stripos($name, 'Д/ф')) {
                            preg_match('/"(.*)"/Ui', $name, $matchList);
                            if (isset($matchList[1])) {
                                if (isset($matchList[1])) {
                                    $filmId = $this->getFilmIdByName($matchList[1]);
                                }
                            }
                        }

                        $date = $this->db->real_escape_string($date);
                        $time = $this->db->real_escape_string($time);
                        $name = $this->db->real_escape_string($name);

                        $this->db->query("INSERT INTO `tv_program` SET 
                                          `chanelId` = {$chanelId},
                                          `filmId` = {$filmId},
                                          `date` = '{$date}',
                                          `time` = '{$time}',
                                          `name` = '{$name}'
                                          ");
                        $programId = $this->db->insert_id;

                        if (0 < $filmId) {
                            $result = $this->db->query("SELECT `personId` FROM `film_cast` WHERE `filmId` = {$filmId}");
                            while ($row = $result->fetch_assoc()) {
                                $this->db->query("INSERT INTO `tv_program_person` SET `programId` = {$programId}, `personId` = {$row['personId']}");
                            }
                            
                            $result = $this->db->query("SELECT `personId` FROM `film_crew` WHERE `filmId` = {$filmId}");
                            while ($row = $result->fetch_assoc()) {
                                $this->db->query("INSERT INTO `tv_program_person` SET `programId` = {$programId}, `personId` = {$row['personId']}");
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    private function getFilmIdByName($search, $film = '')
    {
        iconv(mb_detect_encoding($search, mb_detect_order(), true), "UTF-8", $search);
        $search = preg_replace('/[^0-9a-zA-ZА-Яа-яёЁ_ -]+/u', '', $search);
        $search = $this->sphinx()->real_escape_string($search);
        $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        if (!empty($this->sphinx()->error)) {
            return 0;
        }
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            print_r($rowData);
            if (0 < $rowData['id']) {
                $idList[] = $rowData['id'];
            }
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }

        if (0 == count($idList)) {
            return 0;
        }

        $idList = implode(',', $idList);

        if ('' == $film) {
            $result = $this->db->query("SELECT `id` FROM `film` WHERE `id` IN ($idList) AND `status` = 'show' ORDER BY `year` DESC LIMIT 1");
        } else {
            $result = $this->db->query("SELECT `id` FROM `film` WHERE `id` IN ($idList) AND `status` = 'show' AND `type` != '' ORDER BY `year` DESC LIMIT 1");
        }
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }

        return 0;
    }
}