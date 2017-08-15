<?php
namespace Original\Route_film;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

/**
 * Class AJAX
 * @package Kinomania\Original\Route_film
 */
class AJAX extends DefaultController
{
    use TRepository;

    /**
     * Get trailer link by ID.
     */
    public function getTrailer()
    {
        $data = ['src' => ''];
        $get = new GetBag();
        $id = $get->fetchInt('id');

        if (0 < $id) {
            $result = $this->mysql()->query("SELECT `hd480`, `hd720`, `hd1080`, `source` FROM `trailer` WHERE `id` = {$id} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if (empty($data['src']) && !empty($row['hd720'])) {
                    $data['src'] = $row['hd720'];
                }
                if (!empty($row['hd1080'])) {
                    $data['src'] = $row['hd1080'];
                }
                if (empty($data['src']) && !empty($row['hd480'])) {
                    $data['src'] = $row['hd480'];
                }
            }
        }

        $this->setContent(json_encode($data));
    }

    /**
     * Update film ratings.
     */
    public function checkRate()
    {
        $check = 0;

        $post = new PostBag();
        $filmId = $post->fetch('filmId');

        if (0 < $filmId) {
            $now = strtotime('now');
            $result = $this->mysql()->query("SELECT `id`, `date` FROM `film_last_rate_update` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $date = strtotime($row['date']);
                if (432000 < ($now - $date)) { // 5 days
                    $check = 1;
                }
            } else {
                $check = 1;
                $this->mysql()->query("INSERT INTO `film_last_rate_update` SET `filmId` = {$filmId}, `date` = FROM_UNIXTIME('{$now}')");
            }
        }

        $this->setContent($check);
    }

    /**
     * Update imdb and kp rating.
     */
    public function updateRate()
    {
        $post = new PostBag();
        $filmId = $post->fetch('filmId');
        if (0 < $filmId) {
            $now = strtotime('now');
            $this->mysql()->query("UPDATE `film_last_rate_update` SET `date` = FROM_UNIXTIME('{$now}') WHERE `id` = {$filmId} LIMIT 1");

            $kp = $post->fetchFloat('kp');
            $kp_count = $post->fetchInt('kp_count');
            $imdb = $post->fetchFloat('imdb');
            $imdb_count = $post->fetchInt('imdb_count');

            if (10 >= $kp && 10 >= $imdb) {
                $result = $this->mysql()->query("SELECT `id`, `kp`, `imdb` FROM `film_stat` WHERE  `filmId` = {$filmId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    //$diff = abs($row['kp'] - $kp) + abs($row['imdb'] - $imdb);
                    //if (0 == $row['kp'] || 0 == $row['imdb'] || 1 > $diff) {
                        $this->mysql()->query("UPDATE `film_stat` SET `kp` = {$kp}, `kp_count` = {$kp_count}, `imdb` = {$imdb}, `imdb_count` = {$imdb_count} WHERE `id` = {$row['id']} LIMIT 1");
                        $redis = new \Redis();
                        $redisStatus = $redis->connect('127.0.0.1');
                        if ($redisStatus && $redis->exists('film:' . $filmId)) {
                            $redis->delete('film:' . $filmId);
                        }
                    //}

                } else {
                    $this->mysql()->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = {$imdb}, `imdb_count` = {$imdb_count}, `kp` = {$kp}, `kp_count` = {$kp_count}, 
                                        `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0
                                       ");
                    $redis = new \Redis();
                    $redisStatus = $redis->connect('127.0.0.1');
                    if ($redisStatus && $redis->exists('film:' . $filmId )) {
                        $redis->delete('film:' . $filmId);
                    }
                }
            }
        }
        $this->setContent('');
    }
}