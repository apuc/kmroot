<?php
require_once dirname(__FILE__) . '/IBase.php';

class Weight extends IBase
{
    public function run()
    {
        $result = $this->db_to->query("SELECT `id`, `image`, `year`, `premiere_world`, `premiere_ru`, `premiere_usa` FROM `film` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = $row['id'];
            
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
            $result2 = $this->db_to_2->query("SELECT `ru`, `usa` FROM `film_gross` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result2->fetch_assoc()) {
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

            $result2 = $this->db_to_2->query("SELECT `rate_count`, `imdb_count`, `kp_count`, `poster`, `frame`, `wallpaper`, `trailer`, `soundtrack`, `award` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
            if ($row = $result2->fetch_assoc()) {
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

            $this->db_to_2->query("UPDATE `film` SET `weight` = {$rate} WHERE `id` = {$filmId} LIMIT 1");
            if (!empty($this->db_to_2->error)) {
                echo $this->db_to_2->error;
                $result->close();
                exit;
            }
            $this->db_to_2->query("UPDATE `trailer` SET `weight` = {$rate} WHERE `filmId` = {$filmId}");
            if (!empty($this->db_to_2->error)) {
                echo $this->db_to_2->error;
                $result->close();
                exit;
            }
        }
        $result->close();

        $this->db_from->close();
        $this->db_from_2->close();
        $this->db_to->close();
        $this->db_to_2->close();

        $this->db_from = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kinomania");
        $this->db_from->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_from);
        $this->db_from_2 = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kinomania");
        $this->db_from_2->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_from_2);

        $this->db_to = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
        $this->db_to->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_to);
        $this->db_to_2 = mysqli_connect("127.0.0.1", "fg.kmmain", "fjT94HGF4jde3", "kmmain");
        $this->db_to_2->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_to_2);

        $result = $this->db_to->query("SELECT `id`, `image` FROM `person` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = $row['id'];

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

            $result2 = $this->db_to_2->query("SELECT `photo`, `wallpaper`, `frame`, `news`, `video`, `award` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
            if ($row = $result2->fetch_assoc()) {
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

            $this->db_to_2->query("UPDATE `person` SET `weight` = {$rate} WHERE `id` = {$personId} LIMIT 1");
            $this->db_to_2->query("UPDATE `person_casting` SET `personWeight` = {$rate} WHERE `personId` = {$personId} LIMIT 1");
        }
        $result->close();
    }
}