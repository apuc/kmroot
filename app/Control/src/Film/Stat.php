<?php
namespace Kinomania\Control\Film;

use Kinomania\System\Base\DB;

/**
 * Class Stat
 * @package Kinomania\Control\Film
 */
class Stat extends DB
{
    public function update($filmId)
    {
        $filmId = intval($filmId);

        $result = $this->db->query("SELECT `image`, `year`, `premiere_world`, `premiere_ru`, `premiere_usa` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $image = false;
            if ('' != $row['image']) {
                $image = true;
            }

            $diff = 2;
            if (!empty($row['year'])) {
                $diff = intval(date('Y')) - intval($row['year']);
            }

            $difPremiere = 2678400;
            if (!empty($row['premiere_ru']) || !empty($row['premiere_usa']) || !empty($row['premiere_world'])) {
                if (!empty($row['premiere_ru'])) {
                    $difPremiere = strtotime('now') - strtotime($row['premiere_ru']);
                } else if (!empty($row['premiere_usa'])) {
                    $difPremiere = strtotime('now') - strtotime($row['premiere_usa']);
                } else {
                    $difPremiere = strtotime('now') - strtotime($row['premiere_world']);
                }
            }

            $grossUsa = 0;
            $grossRu = 0;
            $result = $this->db->query("SELECT `ru`, `usa` FROM `film_gross` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $grossUsa = $row['usa'];
                $grossRu = $row['ru'];
            }

            $rate_count = 0;
            $imdb_count = 0;
            $kp_count = 0;
            $poster = 0;
            $frame = 0;
            $wallpaper = 0;
            $trailer = 0;
            $soundtrack = 0;
            $award = 0;

            $result = $this->db->query("SELECT `rate_count`, `imdb_count`, `kp_count`, `poster`, `frame`, `wallpaper`, `trailer`, `soundtrack`, `award` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $rate_count = $row['rate_count'];
                $imdb_count = $row['imdb_count'];
                $kp_count = $row['kp_count'];
                $poster = $row['poster'];
                $frame = $row['frame'];
                $wallpaper = $row['wallpaper'];
                $trailer = $row['trailer'];
                $soundtrack = $row['soundtrack'];
                $award = $row['award'];
            }

            $rate = 0;
            $rate += 1000 * $poster;
            $rate += 100 * $frame;
            $rate += 1000 * $wallpaper;
            $rate += 5000 * $trailer;
            $rate += 10000 * $soundtrack;
            $rate += 3000 * $award;

            $rate += 0.5 * ($rate_count + $imdb_count + $kp_count);
            if ($image) {
                $rate += 10000;
            }

            $rate += 0.0005 * $grossUsa;
            $rate += 0.005 * $grossRu;

            if (1 == $diff || 0 == $diff) {
                $rate += 100000;
            } else if (0 > $diff) {
                $rate += 20000;
            }

            if ($difPremiere < 2678400) {
                $rate += 200000;
            }

            $rate = intval($rate);

            $this->db->query("UPDATE `film` SET `weight` = {$rate} WHERE `id` = {$filmId} LIMIT 1");
            $this->db->query("UPDATE `trailer` SET `weight` = {$rate} WHERE `filmId` = {$filmId}");
            
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('film:' . $filmId . ':stat')) {
                $redis->delete('film:' . $filmId . ':stat');
            }
        }
    }

    /**
     * Update soundtrack data.
     * @param $filmId
     */
    public function updateSoundtrackCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `film_sound_dir` WHERE `filmId` = {$filmId} AND `status` = 'show'");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `soundtrack` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'soundtrack', $count);
            }
            $this->update($filmId);
        }
    }

    /**
     * Update frame data.
     * @param $filmId
     */
    public function updatePosterCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `film_poster` WHERE `filmId` = {$filmId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `poster` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'poster', $count);
            }
            $this->update($filmId);
        }
    }


    /**
     * Update frame data.
     * @param $filmId
     */
    public function updateFrameCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `film_frame` WHERE `filmId` = {$filmId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `frame` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'frame', $count);
            }
            $this->update($filmId);
        }
    }

    /**
     * Update frame data.
     * @param $filmId
     */
    public function updateWallpaperCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `film_wallpaper` WHERE `filmId` = {$filmId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `wallpaper` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'wallpaper', $count);
            }
            $this->update($filmId);
        }
    }


    /**
     * Update trailer data.
     * @param $filmId
     */
    public function updateTrailerCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `trailer` WHERE `filmId` = {$filmId} AND `status` = 'show'");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `trailer` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'trailer', $count);
            }
            $this->update($filmId);
        }
    }

    /**
     * Update award data.
     * @param $filmId
     */
    public function updateAwardCount($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `filmId` = {$filmId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `film_stat` SET `award` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($filmId, 'award', $count);
            }
            $this->update($filmId);
        }
    }

    /**
     * Add trailer.
     * @param $filmId
     */
    public function trailerInc($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `film_stat` SET `trailer` = `trailer` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($filmId, 'trailer');
        }
    }

    /**
     * Delete trailer.
     * @param $filmId
     */
    public function trailerDec($filmId)
    {
        $filmId = intval($filmId);
        $this->db->query("UPDATE `film_stat` SET `trailer` = `trailer` - 1 WHERE `filmId` = {$filmId} LIMIT 1");
    }

    /**
     * Add soundtrack.
     * @param $filmId
     */
    public function soundtrackInc($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `film_stat` SET `soundtrack` = `soundtrack` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($filmId, 'soundtrack');
        }
    }

    /**
     * Delete soundtrack.
     * @param $filmId
     */
    public function soundtrackDec($filmId)
    {
        $filmId = intval($filmId);
        $this->db->query("UPDATE `film_stat` SET `soundtrack` = `soundtrack` - 1 WHERE `filmId` = {$filmId} LIMIT 1");
    }

    /**
     * Add award.
     * @param $filmId
     */
    public function awardInc($filmId)
    {
        $filmId = intval($filmId);
        $result = $this->db->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `film_stat` SET `award` = `award` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($filmId, 'award');
        }
    }

    /**
     * Delete award.
     * @param $filmId
     */
    public function awardDec($filmId)
    {
        $filmId = intval($filmId);
        $this->db->query("UPDATE `film_stat` SET `award` = `award` - 1 WHERE `filmId` = {$filmId} LIMIT 1");
    }

    /**
     * Create new item.
     * 
     * @param $filmId
     * @param $notZero
     * @param $count
     */
    private function insert($filmId, $notZero, $count = 1)
    {
        $count = intval($count);
        $rate = 0;
        $rate_count = 0;
        $imdb = 0;
        $imdb_count = 0;
        $kp = 0;
        $kp_count = 0;
        $poster = 0;
        $frame = 0;
        $wallpaper = 0;
        $trailer = 0;
        $soundtrack = 0;
        $award = 0;

        switch ($notZero) {
            case 'poster':
                $poster = $count;
                break;
            case 'frame':
                $frame = $count;
                break;
            case 'wallpaper':
                $wallpaper = $count;
                break;
            case 'trailer':
                $trailer = $count;
                break;
            case 'soundtrack':
                $soundtrack = $count;
                break;
            case 'award':
                $award = $count;
                break;
        }
        
        $this->db->query("INSERT INTO `film_stat` SET 
                                      `filmId` = {$filmId}, `rate` = {$rate}, `rate_count` = {$rate_count}, `imdb` = {$imdb}, `imdb_count` = {$imdb_count},
                                      `kp` = {$kp}, `kp_count` = {$kp_count}, `poster` = {$poster}, `frame` = {$frame}, `wallpaper` = {$wallpaper}, `trailer` = {$trailer},
                                      `soundtrack` = {$soundtrack}, `award` = {$award}
                                      ");
    }
}