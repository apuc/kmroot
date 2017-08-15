<?php
require_once dirname(__FILE__) . '/IBase.php';

class Film extends IBase
{
    public function run()
    {
        /**
        $this->db_to->query("TRUNCATE `film`");
        $this->db_to->query("TRUNCATE `film_cast`");
        $this->db_to->query("TRUNCATE `film_company_rel`");
        $this->db_to->query("TRUNCATE `film_country`");
        $this->db_to->query("TRUNCATE `film_crew`");
        $this->db_to->query("TRUNCATE `film_frame`");
        $this->db_to->query("TRUNCATE `film_frame_person`");
        $this->db_to->query("TRUNCATE `film_genre`");
        $this->db_to->query("TRUNCATE `film_gross`");
            $this->db_to->query("TRUNCATE `film_last_rate_update`");
        $this->db_to->query("TRUNCATE `film_letter`");
        $this->db_to->query("TRUNCATE `film_poster`");
            $this->db_to->query("TRUNCATE `film_review`");
            $this->db_to->query("TRUNCATE `film_review_stat`");
            $this->db_to->query("TRUNCATE `film_review_vote`");
        $this->db_to->query("TRUNCATE `film_script`");
        $this->db_to->query("TRUNCATE `film_sound_dir`");
        $this->db_to->query("TRUNCATE `film_sound_track`");
            $this->db_to->query("TRUNCATE `film_stat`");
        $this->db_to->query("TRUNCATE `film_wallpaper`");
        $this->db_to->query("TRUNCATE `film_wallpaper_person`");
        $this->db_to->query("TRUNCATE `trailer_type`");
        $this->db_to->query("TRUNCATE `trailer`");
        $this->db_to->query("TRUNCATE `trailer_person`");
        **/
        
        $this->db_to->query("TRUNCATE `film_boxoffice`");

        /**
        $this->filmRun();
        $this->more();
        $this->gross();
        $this->crew();
        $this->cast();
        $this->soundtrack();
        $this->trailer();
        $this->frame();
        $this->poster();
        $this->wallpaper();
        $this->script();
        $this->letter();
         * **/
        $this->boxoffice();
    }

    private function boxoffice()
    {
        $result = $this->db_from->query("SELECT t1.*, t2.`type`, t2.`from_date`, t2.`to_date` FROM `weekend_boxoffice` as `t1` JOIN `weekend` as `t2` ON t1.`weekend_id` = t2.`id` ORDER BY t1.`id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $type = 'usa';
            if (0 == $row['type']) {
                $type = 'russia';
            }
            $position = $row['position'];
            $previous = $row['last_week'];
            $filmId = $row['film_id'];
            $name_origin = '';
            $name_ru = '';
            $company_name = '';
            $week = $row['count_weeks'];
            $copy = $row['count_screens'];
            $gross = $row['gross'];
            $gross_total = $row['gross_total'];
            $gross_rub = $row['gross_rub'];
            $gross_total_rub = $row['gross_total_rub'];
            $views = $row['count_people'];
            $views_total = $row['count_total_people'];
            $date_from = $row['from_date'];
            $date_to = $row['to_date'];

            if ('0000-00-00 00:00:00' == $date_from) {
                $date_from = 'null';
            } else {
                $date_from = '\'' . $date_from . '\'';
            }

            if ('0000-00-00 00:00:00' == $date_to) {
                $date_to = 'null';
            } else {
                $date_to = '\'' . $date_to . '\'';
            }

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                continue;
            }

            $query = "INSERT INTO `film_boxoffice` SET
              `id` = {$id},
              `type` = '{$type}',
              `position` = {$position}, 
              `previous` = {$previous}, 
              `filmId` = {$filmId}, 
              `name_origin` = '{$name_origin}', 
              `name_ru` = '{$name_ru}', 
              `company_name` = '{$company_name}', 
              `week` = {$week}, 
              `copy` = {$copy}, 
              `gross` = {$gross}, 
              `gross_total` = {$gross_total}, 
              `gross_rub` = {$gross_rub}, 
              `gross_total_rub` = {$gross_total_rub}, 
              `views` = {$views}, 
              `views_total` = {$views_total}, 
              `date_from` = {$date_from}, 
              `date_to` = {$date_to},
              `course` = 0
            ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "<br> \n";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function letter()
    {
        $result = $this->db_to->query("SELECT `id`, `name_origin`, `name_ru` FROM `film` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $letters = [];
            $string = $row['name_origin'] . ' ' . $row['name_ru'];
            $string = preg_replace("/[^A-Za-zА-Яа-яёЁ]/u", ' ', $string);
            $string = explode(' ', $string);
            foreach ($string as $word) {
                if (!empty($word)) {
                    $letter = trim(mb_substr($word, 0, 1, 'UTF-8'));
                    if (!empty($letter)) {
                        $add = true;
                        foreach ($letters as $item) {
                            if (mb_strtolower($letter, 'UTF-8') == mb_strtolower($item, 'UTF-8')) {
                                $add = false;
                            }
                        }
                        if ($add) {
                            $letters[] = $letter;
                        }
                    }
                }
            }
            if (0 < count($letters)) {
                foreach ($letters as $letter) {
                    $letter = $this->db_to_2->real_escape_string($letter);
                    $this->db_to_2->query("INSERT INTO `film_letter` SET `filmId` = {$row['id']}, `letter` = '{$letter}'");
                }
            }
        }
        $result->close();
    }

    private function script()
    {
        $result = $this->db_from->query("SELECT * FROM `scripts` ORDER BY `sid`");
        while ($row = $result->fetch_assoc()) {
            $filmId = $row['_films_id'];
            $file = $row['file_link'];
            $text = $row['txt'];
            $language = '';

            if ('e' == $row['language']) {
                $language = 'en';
            } else if ('r' == $row['language']) {
                $language = 'ru';
            }

            if (0 < $filmId) {
                $result2 = $this->db_to->query("SELECT `id` FROM `film` WHERE `id_imdb` = {$filmId}");
                if ($row2 = $result2->fetch_assoc()) {
                    $filmId = $row2['id'];
                    $file = $this->db_to->real_escape_string($file);
                    $text = $this->db_to->real_escape_string($text);

                    $query = "INSERT INTO `film_script` SET `filmId` = {$filmId}, `file` = '{$file}', `text` = '{$text}', `language` = '{$language}'";
                    $this->db_to->query($query);
                    if (!empty($this->db_to->error)) {
                        echo $this->db_to->error;
                        echo "\n\n";
                        echo $query;
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "{$query}\n{$this->db_to->error}");
                        fclose($fh);
                        exit();
                    }
                }
            }
        }
    }
    
    private function wallpaper()
    {
        $result = $this->db_from->query("SELECT * FROM `wallpapers`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['_films_id']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = intval($row2['id']);

                $query = "INSERT INTO `film_wallpaper` SET `id` = {$row['wid']}, `s` = 0, `image` = 'jpeg', `filmId` = {$filmId}, `width` = 0, `height` = 0";
                $this->db_to->query($query);
                if (!empty($this->db_to->error)) {
                    echo $query . "\n<br />";
                    echo $this->db_to->error;
                    $result->close();
                    $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                    fwrite($fh, "{$query}\n{$this->db_to->error}");
                    fclose($fh);
                    exit;
                }

                $result2 = $this->db_from_2->query("SELECT `_peoples_id` FROM `wallp2people` WHERE `wallp_id` = {$row['wid']} ORDER BY `sort`");
                while ($row2 = $result2->fetch_assoc()) {
                    if (0 < $row2['_peoples_id']) {
                        $result3 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$row2['_peoples_id']} LIMIT 1");
                        if ($row3 = $result3->fetch_assoc()) {
                            $this->db_to->query("INSERT INTO `film_wallpaper_person` SET `wallpaperId` = {$row['wid']}, `personId` = {$row3['id']}");
                        }
                    }
                }

            }
        }
        $result->close();
    }

    private function poster()
    {
        $result = $this->db_from->query("SELECT * FROM `posters` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $filmId = intval($row['_films_id']);
            $order = intval($row['numero']);
            $popular = 'no';
            if ('Y' == $row['for_index']) {
                $popular = 'yes';
            }
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                continue;
            }

            $width = $row['w'];
            $height = $row['h'];
            $size = $row['siz'];

            if (0 > $order) {
                $order = 0;
            }
            if (0 > $width) {
                $width = 0;
            }
            if (0 > $height) {
                $height = 0;
            }
            if (0 > $size) {
                $size = 0;
            }

            $query = "INSERT INTO `film_poster` SET
                        `id` = {$id},
                        `filmId` = {$filmId},
                        `s` = 0,
                        `image` = 'jpeg',
                        `width` = {$width},
                        `height` = {$height},
                        `size` = {$size},
                        `popular` = '{$popular}'
                      ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function frame()
    {
        $result = $this->db_from->query("SELECT `frid`, `numero`, `_films_id`, `w`, `h`, `siz`, `pf`, `sp`, `cr`, `screenshot` FROM `frames` ORDER BY `frid`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['frid']);
            $filmId = intval($row['_films_id']);
            $order = intval($row['numero']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                continue;
            }

            $w = intval($row['w']);
            $h = intval($row['h']);
            $siz = intval($row['siz']);

            $photo_session = 'no';
            if ('Y' == $row['pf']) {
                $photo_session = 'yes';
            }
            $film_set = 'no';
            if ('Y' == $row['sp']) {
                $film_set = 'yes';
            }
            $concept = 'no';
            if ('Y' == $row['cr']) {
                $concept = 'yes';
            }
            $screenShot = 'no';
            if (1 == $row['screenshot']) {
                $screenShot = 'yes';
            }

            $query = "INSERT INTO `film_frame` SET
                        `id` = {$id},
                        `filmId` = {$filmId},
                        `s` = 0,
                        `image` = 'jpeg',
                        `order` = '{$order}',
                        `width` = {$w},
                        `height` = {$h},
                        `size` = {$siz},
                        `photo_session` = '{$photo_session}',
                        `film_set` = '{$film_set}',
                        `concept` = '{$concept}',
                        `screenshot` = '{$screenShot}'
                      ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();

        $result = $this->db_from->query("SELECT `frame_id`, `_peoples_id` FROM `frame2people` ORDER BY `frame_id`");
        while ($row = $result->fetch_assoc()) {
            $frameId = intval($row['frame_id']);
            $personId = intval($row['_peoples_id']);

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = $row2['id'];
            } else {
                continue;
            }

            $query = "INSERT INTO `film_frame_person` SET
                        `frameId` = {$frameId},
                        `personId` = {$personId}
                      ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function trailer()
    {
        $result = $this->db_from->query("SELECT `ttid`, `tt_name` FROM `trailer_type` ORDER BY `tt_name`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['ttid']);
            $name = $this->clearText($row['tt_name']);
            $name = $this->db_to->real_escape_string($name);
            if (!empty($name)) {
                $query = "INSERT INTO `trailer_type` SET `id` = {$id}, `name` = '{$name}'";
                $this->db_to->query($query);
                if (!empty($this->db_to->error)) {
                    echo $query;
                    echo "\n<br>";
                    echo $this->db_to->error;
                    $result->close();
                    $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                    fwrite($fh, "{$query}\n{$this->db_to->error}");
                    fclose($fh);
                    exit;
                }
            }
        }

        $result = $this->db_from->query("SELECT * FROM `trailer` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $filmId = intval($row['_films_id']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                continue;
            }

            $image = '';
            if (0 < $row['image']) {
                $image = 'jpeg';
            }
            
            $date = strtotime($row['data']);
            $popular = 'no';
            if (0 < $row['recomended']) {
                $popular = 'yes';
            }
            $local = 'no';
            if (0 < $row['local']) {
                $local = 'yes';
            }
            $type = $row['ttype'];

            $hd480 = '';
            $hd720 = '';
            $hd1080 = '';
            $source = '';

            $result2 = $this->db_from_2->query("SELECT * FROM `trailer_link` WHERE `tid` = {$id} ORDER BY `stype` DESC");
            while ($row2 = $result2->fetch_assoc()) {
                if (empty($row2['link'])) {
                    continue;
                }

                if (!empty($source)) {
                    continue;
                }

                if (false === strpos($row2['link'], 'kinomania.')) {
                    if (false !== strpos($row2['link'], 'youtube.') || false !== strpos($row2['link'], 'vimeo.')) {
                        $source = $row2['link'];
                        continue;
                    }
                }

                if (empty($hd1080)) {
                    if (13 == $row2['stype'] || 7 == $row2['stype']) {
                        $hd1080 = $row2['link'];
                    }
                    if (10 == $row2['stype'] || 3 == $row2['stype']) {
                        $hd1080 = $row2['link'];
                    }
                }

                if (empty($hd720)) {
                    if (12 == $row2['stype'] || 6 == $row2['stype']) {
                        $hd720 = $row2['link'];
                    }
                    if (9 == $row2['stype'] || 2 == $row2['stype']) {
                        $hd720 = $row2['link'];
                    }
                }

                if (empty($hd480)) {
                    if (11 == $row2['stype'] || 5 == $row2['stype']) {
                        $hd480 = $row2['link'];
                    }
                    if (8 == $row2['stype'] || 1 == $row2['stype']) {
                        $hd480 = $row2['link'];
                    }
                }
            }

            if (empty($hd480) && empty($hd720) && empty($hd1080) && empty($source)) {
                continue;
            }

            $query = "INSERT INTO `trailer` SET
                        `id` = {$id},
                        `filmId` = {$filmId},
                        `status` = 'show',
                        `s` = 0,
                        `image` = '{$image}',
                        `date` = FROM_UNIXTIME('{$date}'),
                        `popular` = '{$popular}',
                        `local` = '{$local}',
                        `type` = {$type},
                        `m` = 0,
                        `hd480` = '{$hd480}',
                        `hd720` = '{$hd720}',
                        `hd1080` = '{$hd1080}',
                        `source` = '{$source}',
                        `weight` = 0
                      ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }


        $result = $this->db_from->query("SELECT `trailer_id`, `people_id` FROM `trailer_people`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $trailerId = intval($row['trailer_id']);
            $result2 = $this->db_to->query("SELECT 1 FROM `trailer` WHERE `id` = {$trailerId} LIMIT 1");
            if (0 < $result2->num_rows) {
                $personId = intval($row['people_id']);
                $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $personId = $row2['id'];

                    $query = "INSERT INTO `trailer_person` SET `trailerId` = {$trailerId}, `personId` = {$personId}";
                    $this->db_to->query($query);
                    if (!empty($this->db_to->error)) {
                        echo $query . "\n<br />";
                        echo $this->db_to->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "{$query}\n{$this->db_to->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();
    }
    
    private function soundtrack()
    {
        $result = $this->db_from->query("SELECT * FROM `soundtrack` ORDER BY `sid`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['sid']);
            $name = $this->clearText($row['name_eng']);
            if (empty($name)) {
                $name = $this->clearText($row['name_rus']);
            }
            $year = intval($row['year']);
            $filmId = intval($row['_films_id']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = intval($row2['id']);
                if (1 > $filmId) {
                    continue;
                }

                $s = 0;
                $image = '';
                if (!empty($row['photo'])) {
                    $image = 'jpeg';
                }

                $path = '';
                switch ($row['ost_route']) {
                    case 1:
                        $path = 'FAT/';
                        break;
                    case 2:
                        $path = 'FAT2/';
                        break;
                    case 3:
                        $path = 'FAT3/';
                        break;
                    case 4:
                        $path = 'FAT5/';
                        break;
                    case 6:
                        $path = '/';
                        break;
                }
                if (empty($path)) {
                    continue;
                }
                $path .= $row['mp3'];

                $popular = 'no';
                if ('1' == $row['formain']) {
                    $popular = 'yes';
                }

                $status = 'show';
                if ('Y' == $row['hide']) {
                    $status = 'hide';
                }

                $path = $this->db_to->real_escape_string($path);
                $name = $this->db_to->real_escape_string($name);

                $query = "INSERT INTO `film_sound_dir` SET `id` = {$id}, `filmId` = {$filmId}, `status` = '{$status}', `s` = {$s}, `image` = '{$image}', `path` = '{$path}', `name` = '{$name}', `year` = '{$year}', `popular` = '{$popular}'";
                $this->db_to->query($query);
                if (!empty($this->db_to->error)) {
                    echo $query;
                    echo "\n<br>";
                    echo $this->db_to->error;
                    $result->close();
                    $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                    fwrite($fh, "{$query}\n{$this->db_to->error}");
                    fclose($fh);
                    exit;
                }
            }
        }
        $result->close();

        $result = $this->db_from->query("SELECT * FROM `ost_details` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $dirId = intval($row['sid']);
            $m = 5;
            $order = intval($row['num']);
            $author = $this->repairText($row['author']);
            $name = $this->repairText($row['name']);
            $time = $this->repairText($row['stime']);

            $author = $this->db_to->real_escape_string($author);
            $name = $this->db_to->real_escape_string($name);

            $query = "INSERT INTO `film_sound_track` SET `id` = {$id}, `dirId` = {$dirId}, `m` = {$m}, `author` = '{$author}', `name` = '{$name}', `time` = '{$time}', `order` = {$order}";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function crew()
    {
        $result = $this->db_from->query("SELECT * FROM `_links`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['film_id']);
            $personId = intval($row['people_id']);
            $type = $row['role'];
            $description = $row['descript'];
            $episodes = intval($row['episod']);
            $year = $row['years'];
            $source = $row['source'];
            $order = intval($row['ord']);

            $status = 'show';
            if (1 == $row['hidden']) {
                $status = 'hide';
            }

            if ('director' == $type) {
                $type = 'Режиссер';
            } elseif ('writer' == $type) {
                $type = 'Сценарист';
            } elseif ('producer' == $type || 'rus_producer' == $type) {
                $type = 'Продюсер';
            } elseif ('composer' == $type || 'rus_composer' == $type) {
                $type = 'Композитор';
            } elseif ('cinematographer' == $type || 'rus_operator' == $type) {
                $type = 'Оператор';
            } else {
                $type = '';
            }

            if (empty($type)) {
                continue;
            }

            if ('hand' == $source) {
                $source = 'manual';
            }

            $temp = explode('-', $year);
            $y1 = intval($temp[0]);
            $y2 = intval($temp[1] ?? 0);
            if (1850 > $y1 && 2100 < $y1) {
                $year = $y1;
            } else {
                $year = '';
            }
            if (!empty($year) && 1850 > $y2 && 2100 < $y2) {
                $year .= ' - ' . $y2;
            }

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId}");
            if ($row = $result2->fetch_assoc()) {
                $personId = intval($row['id']);
            } else {
                $personId = 0;
            }

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId}");
            if ($row = $result2->fetch_assoc()) {
                $filmId = intval($row['id']);
            } else {
                $filmId = 0;
            }

            if (0 == $personId || 0 == $filmId) {
                continue;
            }

            $result2 = $this->db_to->query("SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} AND `personId` = {$personId} AND `type` = '{$type}' LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                continue;
            }

            $type = $this->db_to->real_escape_string($type);
            $description = $this->db_to->real_escape_string($description);
            $year = $this->db_to->real_escape_string($year);
            $source = $this->db_to->real_escape_string($source);

            if (65535 < $episodes) {
                $episodes = 0;
            }

            $query = "INSERT INTO `film_crew` SET `filmId` = {$filmId}, `personId` = {$personId}, `type` = '{$type}', `description` = '{$description}', `episodes` = {$episodes}, `year` = '{$year}', `source` = '{$source}', `order` = {$order}";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function cast()
    {
        $result = $this->db_from->query("SELECT * FROM `_links_cast`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['film_id']);
            $personId = intval($row['people_id']);

            $role_ru = $row['descript_rus'];
            $role_en = $row['descript'];
            $note = $row['note'];
            $episodes = intval($row['episode']);
            $year = $row['years'];
            $source = $row['source'];
            $order = intval($row['ord']);

            $status = 'show';
            if (1 == $row['hidden']) {
                $status = 'hide';
            }

            $voice = 'no';
            if (1 == $row['voice']) {
                $voice = 'yes';
            }
            $self = 'no';
            if (1 == $row['is_himself']) {
                $self = 'yes';
            }
            $uncredited = 'no';
            if (1 == $row['uncredited']) {
                $uncredited = 'yes';
            }

            if ('hand' == $source) {
                $source = 'manual';
            }

            $temp = explode('-', $year);
            $y1 = intval($temp[0]);
            $y2 = intval($temp[1] ?? 0);
            if (1850 > $y1 && 2100 < $y1) {
                $year = $y1;
            } else {
                $year = '';
            }
            if (!empty($year) && 1850 > $y2 && 2100 < $y2) {
                $year .= ' - ' . $y2;
            }

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId}");
            if ($row = $result2->fetch_assoc()) {
                $personId = intval($row['id']);
            } else {
                $personId = 0;
            }

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId}");
            if ($row = $result2->fetch_assoc()) {
                $filmId = intval($row['id']);
            } else {
                $filmId = 0;
            }

            if (0 == $personId || 0 == $filmId) {
                continue;
            }

            $result2 = $this->db_to->query("SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} AND `personId` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                continue;
            }


            $role_ru = $this->repairText($role_ru);
            $role_en = $this->repairText($role_en);
            $note = $this->repairText($note);

            $role_ru = mb_strcut($role_ru, 0, 255, 'UTF-8');
            $role_en = mb_strcut($role_en, 0, 255, 'UTF-8');
            $note = mb_strcut($note, 0, 255, 'UTF-8');

            $role_ru = $this->db_to->real_escape_string($role_ru);
            $role_en = $this->db_to->real_escape_string($role_en);
            $note = $this->db_to->real_escape_string($note);
            $year = $this->db_to->real_escape_string($year);
            $source = $this->db_to->real_escape_string($source);

            if (65535 < $episodes) {
                $episodes = 0;
            }


            $query = "INSERT INTO `film_cast` SET `filmId` = {$filmId}, `personId` = {$personId}, `role_ru` = '{$role_ru}', `role_en` = '{$role_en}', `note` = '{$note}', `voice` = '{$voice}', `self` = '{$self}', `uncredited` = '{$uncredited}', `episodes` = {$episodes}, `year` = '{$year}', `source` = '{$source}', `order` = {$order}";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "\n<br>";
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
        $result->close();
    }

    private function gross()
    {
        $result2 = $this->db_from_2->query("SELECT  `film_id`, `gross_usa`, `gross_world`, `gross_russia` FROM `boxoffice` ORDER BY `id`");
        while ($row = $result2->fetch_assoc()) {
            $world = intval($row['gross_world']);
            $usa = intval($row['gross_usa']);
            $ru = intval($row['gross_russia']);

            $result3 = $this->db_to->query("SELECT `id` FROM `film` WHERE `id_imdb` = {$row['film_id']} LIMIT 1");
            if (!$row3 = $result3->fetch_assoc()) {
                continue;
            } else {
                $filmId = intval($row3['id']);
            }

            $this->db_to->query("INSERT INTO `film_gross` SET `filmId` = {$filmId}, `world` = {$world}, `ru` = {$ru}, `usa` = {$usa}");
        }
    }

    private function more()
    {
        $result2 = $this->db_from_2->query("SELECT `_films_id`, `txt` FROM `previews` ORDER BY `id`");
        while ($row2 = $result2->fetch_assoc()) {
            $preview = $row2['txt'];
            if (!empty($preview)) {
                if (false === strpos($preview, '<p>')) {
                    $preview = '<p>' . $preview . '</p>';
                }
                $preview = str_replace('http://www.kinomania.ru/', '/', $preview);
            }
            $preview = $this->db_to->real_escape_string($preview);
            $this->db_to->query("UPDATE `film` SET `preview` = '{$preview}' WHERE `id_imdb` = {$row2['_films_id']} LIMIT 1");
        }

        $result2 = $this->db_from_2->query("SELECT `txt`, `_films_id` FROM `facts` ORDER BY `id`");
        while ($row2 = $result2->fetch_assoc()) {
            $fact = $row2['txt'];
            if (!empty($fact)) {
                if (false === strpos($fact, '<p>')) {
                    $fact = '<p>' . $fact . '</p>';
                }
                $fact = str_replace('http://www.kinomania.ru/', '/', $fact);
            }
            $fact = $this->db_to->real_escape_string($fact);
            $this->db_to->query("UPDATE `film` SET `fact` = '{$fact}' WHERE `id_imdb` = {$row2['_films_id']} LIMIT 1");
        }

        /**
         * Company.
         */
        $result2 = $this->db_from_2->query("SELECT `company`, `type`, `film` FROM `_film2company` ORDER BY `id`");
        while ($row2 = $result2->fetch_assoc()) {
            $concern = '';
            switch ($row2['type']) {
                case '4':
                    $concern = 'По заказу';
                    break;
                case '10':
                    $concern = 'При поддержке';
                    break;
                case '8':
                    $concern = 'При участии';
                    break;
                case '7':
                    $concern = 'Продюсер';
                    $concern = 'При участии';
                    break;
                case '9':
                    $concern = 'Совместно с';
                    break;
                case '11':
                    $concern = 'Сценарист';
                    $concern = 'При участии';
                    break;
                case '3':
                    $concern = 'Производство';
                    break;
                case '1':
                    $concern = 'Прокат';
                    break;
                case '5':
                    $concern = 'Телеканал';
                    $concern = 'При участии';
                    break;
            }

            if (empty($concern)) {
                continue;
            }

            $result3 = $this->db_to->query("SELECT `id` FROM `company` WHERE `id` = {$row2['company']} LIMIT 1");
            if (!$row3 = $result3->fetch_assoc()) {
                continue;
            }

            $result3 = $this->db_to->query("SELECT `id` FROM `film` WHERE `id_imdb` = {$row2['film']} LIMIT 1");
            if (!$row3 = $result3->fetch_assoc()) {
                continue;
            } else {
                $filmId = intval($row3['id']);
            }

            $this->db_to->query("INSERT INTO `film_company_rel` SET `filmId` = {$filmId}, `companyId` = {$row2['company']}, `type` = '{$concern}'");
        }
    }
    
    private function filmRun()
    {
        $result = $this->db_from->query("SELECT * FROM `_films` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            /**
             *
             * Add status_check
             * NULL
             * 0 profile
             * 1 parser
             */
            $id = intval($row['id']);

            $status = 'show';
            if (1 ==  $row['hidden']) {
                $status = 'hide';
            }

            $image = '';
            if (0 < $row['image']) {
                $image = 'jpeg';
            }


            $check = '';
            if (!is_null($row['status_check'])) {
                if (1 == $row['status_check']) {
                    $check = 'parser';
                } else {
                    $check = 'profile';
                }
            }

            /**
             * External ID.
             */
            $id_imdb = intval($row['imdb_key']);
            $id_kt = intval($row['kt']);
            $id_rk = intval($row['rk_link']);
            $id_kp = 0;

            /**
             * Name.
             */
            $name_origin = $this->db_to->real_escape_string(trim($this->repairText($row['name_eng']), '\'" '));
            if (empty($name_origin)) {
                $name_origin = $this->db_to->real_escape_string(trim($this->repairText($row['name_eng2']), '\'" '));
            }

            $name_ru = $this->db_to->real_escape_string(trim($this->repairText($row['name_rus']), '\'" '));
            if (empty($name_ru)) {
                $name_ru = $this->db_to->real_escape_string(trim($this->repairText($row['name_rus2']), '\'" '));
                if (empty($name_ru)) {
                    $name_ru = $this->db_to->real_escape_string(trim($this->repairText($row['name_rus3']), '\'" '));
                }
            }

            if (empty($name_origin) && empty($name_ru)) {
                continue;
            }

            $name_ru = str_replace('&quot;', '', $name_ru);
            $name_origin = str_replace('&quot;', '', $name_origin);

            /**
             * Unique search words.
             */
            $search = trim($this->repairText($row['name_eng3']), '\'" ');
            $wordList = explode(' ', $search);
            $temp = [];
            foreach ($wordList as $word) {
                if (false === stripos($name_origin, $word) && false === stripos($name_ru, $word)) {
                    if (!in_array($word, $temp)) {
                        $temp[] = $word;
                    }
                }
            }
            $temp = str_replace('&quot;', '', implode(' ', $temp));
            $search = $this->db_to->real_escape_string($temp);

            /**
             * Information for internal usage.
             */
            $note = $this->db_to->real_escape_string($this->repairText($row['note']));

            /**
             * Country.
             */
            $county = $this->addCountry($id, $id_imdb);
            $county = $this->db_to->real_escape_string($county);

            /**
             * Year.
             */
            $year = intval($row['year']);
            if (1850 > $year || 2100 < $year) {
                $year = 0;
            }

            /**
             * Genre.
             */
            $genre = $this->addGenre($id, $id_imdb);
            $genre = $this->db_to->real_escape_string($genre);

            $type = '';
            if ('Y' == $row['s_rus']) {
                $type = 'series_ru';
            } else if ('Y' == $row['s_eng']) {
                $type = 'series';
            }

            $arthouse = 'no';
            if ('Y' == $row['arthouse']) {
                $arthouse = 'yes';
            }

            $runtime = intval($row['runtime']);

            $premiere_world = $row['premiere_date_world'];
            if ('0000-00-00' == $premiere_world) {
                $premiere_world = '';
            }
            if (empty($premiere_world)) {
                $premiere_world = 'null';
            } else {
                $premiere_world = '\'' . $premiere_world . '\'';
            }

            $premiere_ru = $row['premier_data_rus'];
            if ('0000-00-00' == $premiere_ru) {
                $premiere_ru = '';
            }
            if (empty($premiere_ru)) {
                $premiere_ru = 'null';
            } else {
                $premiere_ru = '\'' . $premiere_ru . '\'';
            }

            $premiere_usa = $row['premier_data_usa'];
            if ('0000-00-00' == $premiere_usa) {
                $premiere_usa = '';
            }
            if (empty($premiere_usa)) {
                $premiere_usa = 'null';
            } else {
                $premiere_usa = '\'' . $premiere_usa . '\'';
            }

            $budget = floatval($row['budget']);

            $limit_us = '';
            if (!is_null($row['us_certificate'])) {
                switch (intval($row['us_certificate'])) {
                    case 0:
                        $limit_us = 'G';
                        break;
                    case 1:
                        $limit_us = 'PG';
                        break;
                    case 2:
                        $limit_us = 'PG-13';
                        break;
                    case 3:
                        $limit_us = 'R';
                        break;
                    case 4:
                        $limit_us = 'NC-17';
                        break;
                }
            }

            $limit_ru = '';
            if (!is_null($row['us_certificate'])) {
                switch (intval($row['age_limit'])) {
                    case 0:
                        $limit_ru = 0;
                        break;
                    case 6:
                        $limit_ru = 6;
                        break;
                    case 12:
                        $limit_ru = 12;
                        break;
                    case 16:
                        $limit_ru = 16;
                        break;
                    case 18:
                        $limit_ru = 18;
                        break;
                }
            }

            $season_count = intval($row['season_count']);
            $series_count = intval($row['series_count']);

            $year_finish = $row['year_finish'];
            if ('0000-00-00' == $year_finish) {
                $year_finish = '';
            }
            if (empty($year_finish)) {
                $year_finish = 'null';
            } else {
                $year_finish = '\'' . $year_finish . '\'';
            }

            $preview = '';
            $fact = '';

            if (0 > $runtime) {
                $runtime = 0;
            }

            $query = "INSERT INTO `film` SET
                `id` = {$id},
                `s` = 0,
                `image` = '{$image}',
                `status` = '{$status}',
                `name_origin` = '{$name_origin}',
                `name_ru` = '{$name_ru}',
                `search` = '{$search}',
                `country` = '{$county}',
                `year` = {$year},
                `genre` = '{$genre}',
                `type` = '{$type}',
                `arthouse` = '{$arthouse}',
                `runtime` = {$runtime},
                `premiere_world` = {$premiere_world},
                `premiere_ru` = {$premiere_ru},
                `premiere_usa` = {$premiere_usa},
                `limit_us` = '{$limit_us}',
                `limit_ru` = '{$limit_ru}',
                `budget` = {$budget},
                `season_count` = {$season_count},
                `series_count` = {$series_count},
                `year_finish` = {$year_finish},
                `review` = 0,
                `preview` = '{$preview}',
                `fact` = '{$fact}',
                `id_imdb` = {$id_imdb},
                `id_kt` = {$id_kt},
                `id_rk` = {$id_rk},
                `id_kp` = {$id_kp},
                `note` = '{$note}',
                `weight` = '0',
                `check` = '{$check}'
            ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "<br> \n";
                echo $this->db_to->error;
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                $result->close();
                exit;
            }
        }
        $result->close();
    }

    private function addGenre($filmId, $id_imdb)
    {
        $filmId = intval($filmId);
        $id_imdb = intval($id_imdb);

        $genre = [];
        $result = $this->db_from_2->query("SELECT t2.`name` FROM `film_genre` as `t1` JOIN `genre` as `t2` ON t1.`genre_id` = t2.`id` WHERE t1.`film_id` = {$id_imdb} ORDER BY t1.`film_id`");
        while ($row = $result->fetch_assoc()) {
            if (empty($row['name'])) {
                continue;
            }
            $nameEn = trim(strtolower($row['name']));

            /**
             * Search genre code.
             */
            $code = '';
            foreach (Genre::EN as $key => $value) {
                if (false !== stripos($value, $nameEn)) {
                    $code = $key;
                    break;
                }
            }

            if (empty($code)) {
                echo 'Unknown genre: ' . $row['name'];
                echo '<br>' . "\n";
                echo 'Id: ' . $filmId;
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "Unknown genre\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }

            if (!in_array($code, $genre)) {
                $genre[] = $code;
                $code = $this->db_to->real_escape_string($code);
                $this->db_to->query("INSERT INTO `film_genre` SET `filmId` = {$filmId}, `genre` = '{$code}'");
            }
        }

        $genre = implode(',', $genre);

        return $genre;
    }

    private function addCountry($filmId, $id_imdb)
    {
        $filmId = intval($filmId);
        $id_imdb = intval($id_imdb);

        $county = [];
        $result = $this->db_from_2->query("SELECT `c_name` as `name` FROM `_film2country` as `t1` JOIN `_countries` as `t2` ON t1.`cid` = t2.`cid` WHERE t1.`fid` = {$id_imdb} ORDER BY t1.`id`");
        while ($row = $result->fetch_assoc()) {
            if (empty($row['name'])) {
                continue;
            }
            $nameEn = trim(strtolower($row['name']));

            /**
             * Search country ISO code.
             */
            $code = '';
            if ('uk' == $nameEn) {
                $code = 'uk';
            } else {
                foreach (Country::EN as $key => $value) {
                    if (false !== stripos($value, $nameEn)) {
                        $code = $key;
                        break;
                    }
                }
            }

            if (empty($code)) {
                echo 'Unknown country: ' . $row['name'];
                echo '<br>' . "\n";
                echo 'Id: ' . $filmId;
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "Unknown country\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }

            if (!in_array($code, $county)) {
                $county[] = $code;
                $code = $this->db_to->real_escape_string($code);
                $this->db_to->query("INSERT INTO `film_country` SET `filmId` = {$filmId}, `country` = '{$code}'");
            }
        }

        $county = implode(',', $county);

        return $county;
    }
}