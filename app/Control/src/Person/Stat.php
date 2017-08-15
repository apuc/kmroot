<?php
namespace Kinomania\Control\Person;

use Kinomania\System\Base\DB;

/**
 * Class Stat
 * @package Kinomania\Control\Person
 */
class Stat extends DB
{
    /**
     * @param $personId
     */
    public function update($personId)
    {
        $personId = intval($personId);

        $result = $this->db->query("SELECT `image` FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $image = false;
            if ('' != $row['image']) {
                $image = true;
            }

            $photo = 0;
            $wallpaper = 0;
            $frame = 0;
            $news = 0;
            $video = 0;
            $award = 0;

            $result = $this->db->query("SELECT `photo`, `wallpaper`, `frame`, `news`, `video`, `award` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $photo = $row['photo'];
                $wallpaper = $row['wallpaper'];
                $frame = $row['frame'];
                $news = $row['news'];
                $video = $row['video'];
                $award = $row['award'];
            }

            $rate = 0;
            $rate += 250 * min(100, $photo);
            $rate += 1000 * min(50, $wallpaper);
            $rate += 500 * min(100, $frame);
            $rate += 1000 * $news;
            $rate += 1000 * $video;
            $rate += 3000 * $award;
            if ($image) {
                $rate += 20000;
            }

            $rate = intval($rate);

            $this->db->query("UPDATE `person` SET `weight` = {$rate} WHERE `id` = {$personId} LIMIT 1");
            $this->db->query("UPDATE `person_casting` SET `personWeight` = {$rate} WHERE `personId` = {$personId} LIMIT 1");

            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('person:' . $personId . ':stat')) {
                $redis->delete('person:' . $personId . ':stat');
            }
        }
    }

    /**
     * Update news data.
     * @param $personId
     */
    public function updateNewsCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `news_link` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `news` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'news', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Update photo data.
     * @param $personId
     */
    public function updatePhotoCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `person_photo` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `photo` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'photo', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Update wallpaper data.
     * @param $personId
     */
    public function updateWallpaperCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `person_wallpaper` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `wallpaper` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'wallpaper', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Update frame data.
     * @param $personId
     */
    public function updateFrameCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `film_frame_person` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `frame` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'frame', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Update video data.
     * @param $personId
     */
    public function updateVideoCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `trailer_person` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `video` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'video', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Update award data.
     * @param $personId
     */
    public function updateAwardCount($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `personId` = {$personId}");
        if ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->db->query("UPDATE `person_stat` SET `award` = {$count} WHERE `id` = {$row['id']} LIMIT 1");
            } else {
                $this->insert($personId, 'award', $count);
            }
            $this->update($personId);
        }
    }

    /**
     * Add photo.
     * @param $personId
     */
    public function photoInc($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `person_stat` SET `photo` = `photo` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($personId, 'photo');
        }
    }

    /**
     * Delete photo.
     * @param $personId
     */
    public function photoDec($personId)
    {
        $personId = intval($personId);
        $this->db->query("UPDATE `person_stat` SET `photo` = `photo` - 1 WHERE `personId` = {$personId} LIMIT 1");
    }

    /**
     * Add wallpaper.
     * @param $personId
     */
    public function wallpaperInc($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `person_stat` SET `wallpaper` = `wallpaper` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($personId, 'wallpaper');
        }
    }

    /**
     * Delete wallpaper.
     * @param $personId
     */
    public function wallpaperDec($personId)
    {
        $personId = intval($personId);
        $this->db->query("UPDATE `person_stat` SET `wallpaper` = `wallpaper` - 1 WHERE `personId` = {$personId} LIMIT 1");
    }

    /**
     * Add frame.
     * @param $personId
     */
    public function frameInc($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `person_stat` SET `frame` = `frame` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($personId, 'frame');
        }
    }

    /**
     * Delete frame.
     * @param $personId
     */
    public function frameDec($personId)
    {
        $personId = intval($personId);
        $this->db->query("UPDATE `person_stat` SET `frame` = `frame` - 1 WHERE `personId` = {$personId} LIMIT 1");
    }

    /**
     * Add video.
     * @param $personId
     */
    public function videoInc($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `person_stat` SET `video` = `video` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($personId, 'video');
        }
    }

    /**
     * Delete video.
     * @param $personId
     */
    public function videoDec($personId)
    {
        $personId = intval($personId);
        $this->db->query("UPDATE `person_stat` SET `video` = `video` - 1 WHERE `personId` = {$personId} LIMIT 1");
    }

    /**
     * Add award.
     * @param $personId
     */
    public function awardInc($personId)
    {
        $personId = intval($personId);
        $result = $this->db->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $this->db->query("UPDATE `person_stat` SET `award` = `award` + 1 WHERE `id` = {$row['id']} LIMIT 1");
        } else {
            $this->insert($personId, 'award');
        }
    }

    /**
     * Delete award.
     * @param $personId
     */
    public function awardDec($personId)
    {
        $personId = intval($personId);
        $this->db->query("UPDATE `person_stat` SET `award` = `award` - 1 WHERE `personId` = {$personId} LIMIT 1");
    }

    /**
     * Create new item.
     *
     * @param $personId
     * @param $notZero
     * @param int $count
     */
    private function insert($personId, $notZero, $count = 1)
    {
        $count = intval($count);
        
        $photo = 0;
        $wallpaper = 0;
        $frame = 0;
        $news = 0;
        $video = 0;
        $award = 0;

        switch ($notZero) {
            case 'photo':
                $photo = $count;
                break;
            case 'wallpaper':
                $wallpaper = $count;
                break;
            case 'frame':
                $frame = $count;
                break;
            case 'news':
                $news = $count;
                break;
            case 'video':
                $video = $count;
                break;
            case 'award':
                $award = $count;
                break;
        }

        $this->db->query("INSERT INTO `person_stat` SET 
                                      `personId` = {$personId}, `photo` = {$photo}, `wallpaper` = {$wallpaper}, `frame` = {$frame}, 
                                      `news` = {$news}, `video` = {$video}, `award` = {$award}
                                      ");
    }
}