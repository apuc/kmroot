<?php
namespace Kinomania\Control\Film\Filmography;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Text\TText;

/**
 * Class Filmography
 * @package Kinomania\Control\Film\Filmography
 */
class Filmography extends DB
{
    use TText;

    const UNKNOWN_ID = 'UNKNOWN_ID';
    const UNKNOWN_FILM = 'UNKNOWN_FILM';
    const UNKNOWN_PERSON = 'UNKNOWN_PERSON';
    const EXIST_PERSON = 'PERSON_EXIST';

    /**
     * @return bool
     */
    public function editCast()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $result = $this->db->query("SELECT `filmId` FROM `film_cast` WHERE `id` = {$id} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_ID;
            return false;
        } else {
            $filmId = intval($row['filmId']);
        }

        $personId = $post->fetch('personId');
        if (0 == intval($personId)) {
            $personId = explode('=', $personId);
            $personId = $personId[1] ?? '';
            $personId = trim($personId);
        }
        $personId = intval($personId);

        $result = $this->db->query("SELECT 1 FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_PERSON;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `film_cast` WHERE `id` != {$id} AND `filmId` = {$filmId} AND `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::EXIST_PERSON;
            return false;
        }

        $role_ru = $this->db->real_escape_string($this->clearText($post->fetch('role_ru')));
        $role_en = $this->db->real_escape_string($this->clearText($post->fetch('role_en')));

        $voice = 'no';
        if ('yes' == $post->fetch('voice')) {
            $voice = 'yes';
        }
        $uncredited = 'no';
        if ('yes' == $post->fetch('uncredited')) {
            $uncredited = 'yes';
        }
        $self = 'no';
        if ('yes' == $post->fetch('self')) {
            $self = 'yes';
        }

        $year = $this->db->real_escape_string($this->clearText($post->fetch('year')));
        $episodes = $post->fetchInt('episodes');
        $note = $this->db->real_escape_string($this->clearText($post->fetch('note')));

        $source = $post->fetchEscape('source', $this->db);

        $query = "UPDATE `film_cast` SET 
                  `personId` = {$personId}, `role_ru` = '{$role_ru}', `role_en` = '{$role_en}', 
                  `note` = '{$note}', `voice` = '{$voice}', `self` = '{$self}', `uncredited` = '{$uncredited}', 
                  `episodes` = '{$episodes}', `year` = '{$year}', `source` = '{$source}' WHERE `id` = {$id} LIMIT 1";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function editCrew()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');

        $result = $this->db->query("SELECT `filmId`, `type` FROM `film_crew` WHERE `id` = {$id} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_ID;
            return false;
        } else {
            $filmId = intval($row['filmId']);
            $type = $row['type'];
        }

        $personId = $post->fetch('personId');
        if (0 == intval($personId)) {
            $personId = explode('=', $personId);
            $personId = $personId[1] ?? '';
            $personId = trim($personId);
        }
        $personId = intval($personId);

        $result = $this->db->query("SELECT 1 FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_PERSON;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `film_crew` WHERE `filmId` = {$filmId} AND `personId` = {$personId} AND `type` = '{$type}' AND `id` != {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::EXIST_PERSON;
            return false;
        }

        $description = $this->db->real_escape_string($this->clearText($post->fetch('description')));
        $episodes = $post->fetchInt('episodes');
        $year = $this->db->real_escape_string($this->clearText($post->fetch('year')));

        $source = $post->fetchEscape('source', $this->db);

        $query = "UPDATE `film_crew` SET 
                  `personId` = {$personId}, `description` = '{$description}', `episodes` = '{$episodes}', 
                  `year` = '{$year}', `source` = '{$source}' WHERE `id` = {$id} LIMIT 1";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function addCast()
    {
        $post = new PostBag();

        $filmId = $post->fetchInt('filmId');
        $result = $this->db->query("SELECT 1 FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_FILM;
            return false;
        }

        $personId = $post->fetch('personId');
        if (0 == intval($personId)) {
            $personId = explode('=', $personId);
            $personId = $personId[1] ?? '';
            $personId = trim($personId);
        }
        $personId = intval($personId);

        $result = $this->db->query("SELECT `status` FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_PERSON;
            return false;
        }

        $result = $this->db->query("SELECT 1 FROM `film_cast` WHERE `filmId` = {$filmId} AND `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::EXIST_PERSON;
            return false;
        }

        $role_ru = $this->db->real_escape_string($this->clearText($post->fetch('role_ru')));
        $role_en = $this->db->real_escape_string($this->clearText($post->fetch('role_en')));

        $voice = 'no';
        if ('yes' == $post->fetch('voice')) {
            $voice = 'yes';
        }
        $uncredited = 'no';
        if ('yes' == $post->fetch('uncredited')) {
            $uncredited = 'yes';
        }
        $self = 'no';
        if ('yes' == $post->fetch('self')) {
            $self = 'yes';
        }

        $year = $this->db->real_escape_string($this->clearText($post->fetch('year')));
        $episodes = $post->fetchInt('episodes');
        $note = $this->db->real_escape_string($this->clearText($post->fetch('note')));

        $order = 1;
        $result = $this->db->query("SELECT `order` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $order = $row['order'] + 1;
        }

        $query = "INSERT INTO `film_cast` SET 
                  `filmId` = {$filmId}, `personId` = {$personId}, `role_ru` = '{$role_ru}', `role_en` = '{$role_en}', 
                  `note` = '{$note}', `voice` = '{$voice}', `self` = '{$self}', `uncredited` = '{$uncredited}', 
                  `episodes` = '{$episodes}', `year` = '{$year}', `source` = 'manual', `order` = {$order}";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function addCrew()
    {
        $post = new PostBag();

        $filmId = $post->fetchInt('filmId');
        $type = $post->fetchEscape('type', $this->db);
        $result = $this->db->query("SELECT 1 FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_FILM;
            return false;
        }

        $personId = $post->fetch('personId');
        if (0 == intval($personId)) {
            $personId = explode('=', $personId);
            $personId = $personId[1] ?? '';
            $personId = trim($personId);
        }
        $personId = intval($personId);

        $result = $this->db->query("SELECT `status` FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if (!$row = $result->fetch_assoc()) {
            $this->error = self::UNKNOWN_PERSON;
            return false;
        }
        
        $result = $this->db->query("SELECT 1 FROM `film_crew` WHERE `filmId` = {$filmId} AND `personId` = {$personId} AND `type` = '{$type}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->error = self::EXIST_PERSON;
            return false;
        }

        $description = $this->db->real_escape_string($this->clearText($post->fetch('description')));
        $episodes = $post->fetchInt('episodes');
        $year = $this->db->real_escape_string($this->clearText($post->fetch('year')));

        $order = 1;
        $result = $this->db->query("SELECT `order` FROM `film_crew` WHERE `filmId` = {$filmId} AND `type` = '{$type}' ORDER BY `order` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $order = $row['order'] + 1;
        }

        $query = "INSERT INTO `film_crew` SET 
                  `filmId` = {$filmId}, `personId` = {$personId}, `type` = '{$type}', `description` = '{$description}', 
                  `episodes` = '{$episodes}', `year` = '{$year}', `source` = 'manual', `order` = {$order}";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    public function getCast($filmId)
    {
        $list = [];

        $result = $this->db->query("SELECT t1.`id`, t1.`personId`, t1.`role_en`, t1.`role_ru`, t1.`note`, t1.`source`, t2.`s`, t2.`image`, t2.`status`, t2.`name_origin`, t2.`name_ru` 
                                    FROM `film_cast` as `t1` JOIN (SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id` 
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
        while ($row = $result->fetch_assoc()) {
            $item = new ItemCast();
            $item->initFromArray($row);
            $list[] =  $item;
        }

        return $list;
    }

    public function getCrew($filmId)
    {
        $list = [
            'Режиссер' => [],
            'Сценарист' => [],
            'Продюсер' => [],
            'Оператор' => [],
            'Композитор' => [],
        ];

        $result = $this->db->query("SELECT t1.`id`, t1.`personId`, t1.`type`, t1.`description`, t1.`source`, t2.`s`, t2.`image`, t2.`status`, t2.`name_origin`, t2.`name_ru`
                                    FROM `film_crew` as `t1` JOIN (SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id`
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
        while ($row = $result->fetch_assoc()) {
            $item = new ItemCrew();
            $item->initFromArray($row);
            $list[$row['type']][] =  $item;
        }

        return $list;
    }

    /**
     * @param int $id
     * @return ItemCast
     */
    public function getCastItem($id)
    {
        $id = intval($id);
        $item = new ItemCast();
        
        $result = $this->db->query("SELECT * FROM `film_cast` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }
        
        return $item;
    }

    /**
     * @param int $id
     * @return ItemCast
     */
    public function getCrewItem($id)
    {
        $id = intval($id);
        $item = new ItemCrew();
        
        $result = $this->db->query("SELECT * FROM `film_crew` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }
        
        return $item;
    }

    /**
     * @return bool
     */
    public function deleteCast()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        
        $this->db->query("DELETE FROM `film_cast` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function deleteCrew()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        
        $this->db->query("DELETE FROM `film_crew` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }
}