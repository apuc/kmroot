<?php
namespace Kinomania\Original\Controller;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Person\Person;
use Kinomania\Original\Key\Person\Stat;
use Kinomania\System\Common\TRepository;

/**
 * Class PersonController
 * @package Kinomania\Original\Controller
 */
class PersonController extends DefaultController
{
    use TRepository;

    /**
     * Get person name by ID.
     * @param $personId
     * @return array|mixed
     */
    protected function getMin($personId)
    {
        $item = [];

        $key = 'person:' . $personId . ':min';
        if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
            $item = unserialize($this->redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `person` WHERE `id` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $item[Person::NAME_ORIGIN] = $row['name_origin'];
                $item[Person::NAME_RU] = $row['name_ru'];
                $item[Person::TITLE] = $row['name_ru'];
                if (!empty($item[Person::NAME_ORIGIN])) {
                    if (empty($item[Person::TITLE])) {
                        $item[Person::TITLE] =  $item[Person::NAME_ORIGIN];
                    } else {
                        $item[Person::TITLE] .= ' / ' . $item[Person::NAME_ORIGIN] . ' / ';
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
     * @param $personId
     * @return array
     */
    protected function getStat($personId)
    {
        $personId = intval($personId);
        $item  = [];

        $key = 'person:' . $personId . ':stat';

        if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
            $item = unserialize($this->redis->get($key));
        } else {
            $result = $this->mysql()->query("SELECT `photo`, `wallpaper`, `frame`, `news`, `video`, `award` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                if (0 == $row['photo']) {
                    $row['photo'] = '';
                }
                if (0 == $row['wallpaper']) {
                    $row['wallpaper'] = '';
                }
                if (0 == $row['frame']) {
                    $row['frame'] = '';
                }
                if (0 == $row['news']) {
                    $row['news'] = '';
                }
                if (0 == $row['video']) {
                    $row['video'] = '';
                }
                if (0 == $row['award']) {
                    $row['award'] = '';
                }
                $item[Stat::PHOTO] = $row['photo'];
                $item[Stat::WALLPAPER] = $row['wallpaper'];
                $item[Stat::FRAME] = $row['frame'];
                $item[Stat::NEWS] = $row['news'];
                $item[Stat::VIDEO] = $row['video'];
                $item[Stat::AWARD] = $row['award'];

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 259200); // 3 days
                }
            }

            if ([] == $item) {
                $item[Stat::PHOTO] = '';
                $item[Stat::WALLPAPER] = '';
                $item[Stat::FRAME] = '';
                $item[Stat::NEWS] = '';
                $item[Stat::VIDEO] = '';
                $item[Stat::AWARD] = '';
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