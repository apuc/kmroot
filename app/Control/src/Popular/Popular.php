<?php
namespace Kinomania\Control\Popular;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;

class Popular extends DB
{
    public function list()
    {
        $item = new Item();

        $temp = [
            'film_wallpaper' => [],
            'person_wallpaper_actors' => [],
            'person_wallpaper_actresses' => [],
            'person_photo' => [],
            'film_poster' => [],
            'casting_promo' => [],
        ];
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'film_wallpaper' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['film_wallpaper'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'person_wallpaper_actors' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['person_wallpaper_actors'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'person_wallpaper_actresses' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['person_wallpaper_actresses'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'person_photo' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['person_photo'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'film_poster' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['film_poster'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'film_new' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['film_new'] = unserialize($row['list']);
        }
        $result = $this->db->query("SELECT `list` FROM `popular` WHERE `type` = 'casting_promo' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $temp['casting_promo'] = unserialize($row['list']);
        }

        $item->initFromArray($temp);

        return $item;
    }

    public function save()
    {
        $post = new PostBag();

        $film_wallpaper = $post->fetch('film_wallpaper');
        $person_wallpaper_actors = $post->fetch('person_wallpaper_actors');
        $person_wallpaper_actresses = $post->fetch('person_wallpaper_actresses');
        $person_photo = $post->fetch('person_photo');
        $film_poster = $post->fetch('film_poster');
        $film_new = $post->fetch('film_new');
        $casting_promo = $post->fetch('casting_promo');

        if (!empty($film_wallpaper)) {
            $film_wallpaper = $this->db->real_escape_string(serialize($film_wallpaper));
            $this->db->query("UPDATE `popular` SET `list` = '{$film_wallpaper}' WHERE `type` = 'film_wallpaper' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($person_wallpaper_actors)) {
            $person_wallpaper_actors = $this->db->real_escape_string(serialize($person_wallpaper_actors));
            $this->db->query("UPDATE `popular` SET `list` = '{$person_wallpaper_actors}' WHERE `type` = 'person_wallpaper_actors' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($person_wallpaper_actresses)) {
            $person_wallpaper_actresses = $this->db->real_escape_string(serialize($person_wallpaper_actresses));
            $this->db->query("UPDATE `popular` SET `list` = '{$person_wallpaper_actresses}' WHERE `type` = 'person_wallpaper_actresses' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($person_photo)) {
            $person_photo = $this->db->real_escape_string(serialize($person_photo));
            $this->db->query("UPDATE `popular` SET `list` = '{$person_photo}' WHERE `type` = 'person_photo' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($film_poster)) {
            $film_poster = $this->db->real_escape_string(serialize($film_poster));
            $this->db->query("UPDATE `popular` SET `list` = '{$film_poster}' WHERE `type` = 'film_poster' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($film_new)) {
            $film_new = $this->db->real_escape_string(serialize($film_new));
            $this->db->query("UPDATE `popular` SET `list` = '{$film_new}' WHERE `type` = 'film_new' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }

        if (!empty($casting_promo)) {
            $casting_promo = $this->db->real_escape_string(serialize($casting_promo));
            $this->db->query("UPDATE `popular` SET `list` = '{$casting_promo}' WHERE `type` = 'casting_promo' LIMIT 1");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
        }
        
        return true;
    }
}