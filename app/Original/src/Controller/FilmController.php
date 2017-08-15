<?php
namespace Kinomania\Original\Controller;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Film\Film;
use Kinomania\Original\Key\Film\Stat;
use Kinomania\System\Common\TRepository;

/**
 * Class FilmController
 * @package Kinomania\Original\Controller
 */
class FilmController extends DefaultController
{
    use TRepository;

    /**
     * @param int $filmId
     * @return array
     */
    protected function getStat($filmId)
    {
        $filmId = intval($filmId);
        $item  = [];
        
        $key = 'film:' . $filmId . ':stat';

        if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
            $item = unserialize($this->redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT `rate`, `rate_count`, `imdb`, `imdb_count`, `kp`, `kp_count`, `poster`, `frame`, `wallpaper`, `trailer`, `soundtrack`, `award` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if (0 == $row['poster']) {
                    $row['poster'] = '';
                }
                if (0 == $row['frame']) {
                    $row['frame'] = '';
                }
                if (0 == $row['wallpaper']) {
                    $row['wallpaper'] = '';
                }
                if (0 == $row['trailer']) {
                    $row['trailer'] = '';
                }
                if (0 == $row['soundtrack']) {
                    $row['soundtrack'] = '';
                }
                if (0 == $row['award']) {
                    $row['award'] = '';
                }
                $item[Stat::POSTER] = $row['poster'];
                $item[Stat::FRAME] = $row['frame'];
                $item[Stat::WALLPAPER] = $row['wallpaper'];
                $item[Stat::TRAILER] = $row['trailer'];
                $item[Stat::SOUNDTRACK] = $row['soundtrack'];
                $item[Stat::AWARD] = $row['award'];

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 259200); // 3 days
                }
            }

            if ([] == $item) {
                $item[Stat::POSTER] = '';
                $item[Stat::FRAME] = '';
                $item[Stat::WALLPAPER] = '';
                $item[Stat::TRAILER] = '';
                $item[Stat::SOUNDTRACK] = '';
                $item[Stat::AWARD] = '';
            }
        }
        
        return $item;
    }

    /**
     * Get film name by ID.
     * @param $filmId
     * @return array|mixed
     */
    protected function getMin($filmId)
    {
        $item = [];

        $key = 'film:' . $filmId . ':min';
        if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
            $item = unserialize($this->redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $item[Film::NAME_ORIGIN] = $row['name_origin'];
                $item[Film::NAME_RU] = $row['name_ru'];
                $item[Film::TITLE] = $row['name_ru'];            
                if (!empty($item[Film::NAME_ORIGIN])) {
                    if (empty($item[Film::TITLE])) {
                        $item[Film::TITLE] = $item[Film::NAME_ORIGIN];
                    } else {
                        $item[Film::TITLE] .= ' | ' . $item[Film::NAME_ORIGIN];
                    }
                }

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 604800); // 7 days
                }
            }
        }

        return $item;
    }

    /**
     * @var \Redis
     */
    protected $redis;
    /**
     * @var bool
     */
    protected $redisStatus;
}