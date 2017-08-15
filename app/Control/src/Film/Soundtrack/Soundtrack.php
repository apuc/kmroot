<?php
namespace Kinomania\Control\Film\Soundtrack;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Text\TText;

class Soundtrack extends DB
{
    use TText;
    
    const BAD_YEAR = 'BAD_YEAR';

    /**
     * Create new dir.
     * @return bool
     */
    public function add()
    {
        $this->error = '';
        
        $post = new PostBag();
        $filmId = $post->fetchInt('filmId');
        $name = $this->clearText($post->fetch('name'));
        $year = $post->fetchInt('year');

        if (1901 > $year || 2155 < $year) {
            $this->error = self::BAD_YEAR;
            return false;
        }

        if (0 == $filmId) {
            return false;
        }

        $name = $this->db->real_escape_string($name);

        $this->db->query("INSERT INTO `film_sound_dir` SET `filmId` = {$filmId}, `status` = 'hide', `s` = 0, `image` = '', `path` = '', `name` = '{$name}', `year` = '{$year}', `popular` = 'no'");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    public function edit()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');
        $name = $this->clearText($post->fetch('name'));
        $year = $post->fetchInt('year');

        if (1901 > $year || 2155 < $year) {
            $this->error = self::BAD_YEAR;
            return false;
        }

        $status = 'hide';
        if ('show' == $post->fetch('status')) {
            $status = 'show';
        }

        $popular = 'no';
        if ('yes' == $post->fetch('popular')) {
            $popular = 'yes';
        }

        $this->db->query("UPDATE `film_sound_dir` SET `status` = '{$status}', `name` = '{$name}', `year` = '{$year}', `popular` = '{$popular}' WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }
        
        $filmId = 0;
        $result = $this->db->query("SELECT `filmId` FROM `film_sound_dir` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $filmId = $row['filmId'];
        }

        $stat = new Stat($this->db);
        $stat->updateSoundtrackCount($filmId);

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus) {
            $redis->delete('film:' . $filmId);
            $redis->delete('film:' . $filmId . ':min');
            $redis->delete('film:' . $filmId . ':stat');
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteDir($id = 0)
    {
        $this->error = '';

        /**
         * Image.
         */
        $static = new StaticS();
        json_decode($static->delete('film_soundtrack'), true);
        
        if (0 == $id) {
            $post = new PostBag();
            $id = $post->fetchInt('id');
        } else {
            $id = intval($id);
        }

        /**
         * Film stat.
         */
        $filmId = 0;
        $result = $this->db->query("SELECT `filmId` FROM `film_sound_dir` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $filmId = $row['filmId'];
        }

        /**
         * Dir.
         */
        $this->db->query("DELETE FROM `film_sound_dir` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * MP3.
         */
        $m = 0;
        $idList = [];
        $result = $this->db->query("SELECT `id`, `m` FROM `film_sound_track` WHERE `dirId` = {$id}");
        while ($row = $result->fetch_assoc()) {
           $m = $row['m'];
            $idList[] = $row['id'];
        }
        $idList = implode(',', $idList);
        $server = new StaticS();
        $server->deleteMP3List($m, $idList);

        $this->db->query("DELETE FROM `film_sound_track` WHERE `dirId` = {$id}");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        /**
         * Film stat.
         */
        $stat = new Stat($this->db);
        $stat->updateSoundtrackCount($filmId);

        return true;
    }

    /**
     * @param $filmId
     * @return array
     */
    public function getDirList($filmId)
    {
        $filmId = intval($filmId);
        $list = [];

        $result = $this->db->query("SELECT * FROM `film_sound_dir` WHERE `filmId` = {$filmId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $item = new Dir();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }

    /**
     * @param int $id
     * @return Dir
     */
    public function getDir($id)
    {
        $id = intval($id);
        $item = new Dir();

        $result = $this->db->query("SELECT * FROM `film_sound_dir` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @param $dirId
     * @return array
     */
    public function getTrackList($dirId)
    {
        $dirId = intval($dirId);
        $list = [];

        $result = $this->db->query("SELECT * FROM `film_sound_track` WHERE `dirId` = {$dirId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $item = new Track();
            $item->initFromArray($row);
            $list[] = $item;
        }

        return $list;
    }

    /**
     * @param int $id
     * @return Dir
     */
    public function getTrack($id)
    {
        $id = intval($id);
        $item = new Track();

        $result = $this->db->query("SELECT * FROM `film_sound_track` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @return bool
     */
    public function editTrack()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');
        $author = $this->clearText($post->fetch('author'));
        $name = $this->clearText($post->fetch('name'));
        $time = $this->clearText($post->fetch('time'));

        $this->db->query("UPDATE `film_sound_track` SET `author` = '{$author}', `name` = '{$name}', `time` = '{$time}' WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }
}