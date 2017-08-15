<?php
require_once dirname(__FILE__) . '/IBase.php';

class Person extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `person`");
        $this->db_to->query("TRUNCATE `person_casting`");
        $this->db_to->query("TRUNCATE `person_casting_dance`");
        $this->db_to->query("TRUNCATE `person_casting_ethnic`");
        $this->db_to->query("TRUNCATE `person_casting_language`");
        $this->db_to->query("TRUNCATE `person_casting_music_instrument`");
        $this->db_to->query("TRUNCATE `person_casting_sing`");
        $this->db_to->query("TRUNCATE `person_casting_sport`");
        $this->db_to->query("TRUNCATE `person_letter`");
        $this->db_to->query("TRUNCATE `person_photo`");
            $this->db_to->query("TRUNCATE `person_review`");
            $this->db_to->query("TRUNCATE `person_review_stat`");
            $this->db_to->query("TRUNCATE `person_review_vote`");
            $this->db_to->query("TRUNCATE `person_stat`");
        $this->db_to->query("TRUNCATE `person_wallpaper`");
        
        $this->personRun();
        $this->moreInfo();
        $this->bio();
        $this->casting();
        $this->photo();
        $this->wallpaper();
        $this->letter();
    }

    private function letter()
    {
        $result = $this->db_to->query("SELECT `id`, `name_origin`, `name_ru` FROM `person` ORDER BY `id`", MYSQLI_USE_RESULT);
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
                    $this->db_to_2->query("INSERT INTO `person_letter` SET `personId` = {$row['id']}, `letter` = '{$letter}'");
                }
            }
        }
        $result->close();
    }

    private function wallpaper()
    {
        $result = $this->db_from->query("SELECT * FROM `wallp_people`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['_peoples_id']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = intval($row2['id']);

                $query = "INSERT INTO `person_wallpaper` SET `id` = {$row['wid']}, `s` = 0, `image` = 'jpeg', `personId` = {$personId}, `width` = 0, `height` = 0";
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
        $result->close();
    }

    private function photo()
    {
        $result = $this->db_from->query("SELECT 
                                        `frid`, `_peoples_id`, `numero`, `descript`, `width`, `height`, `size`
                                        FROM `frames_people` ORDER BY `frid`, `numero`", MYSQLI_USE_RESULT); // ID 0
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['frid']);
            $image = 'jpeg';
            $personId = intval($row['_peoples_id']);
            $order = intval($row['numero']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = intval($row2['id']);
            } else {
                continue;
            }
            $width = intval($row['width']);
            $height = intval($row['height']);
            $size = intval($row['size']);
            if (1 > $size) {
                continue;
            }
            $description = $this->db_to->real_escape_string($this->clearText($row['descript']));

            $query = "INSERT INTO `person_photo` SET 
                                `id` = {$id},
                                `s` = 0,
                                `image` = '{$image}',
                                `personId` = {$personId},
                                `order` = {$order},
                                `description` = '{$description}',
                                `width` = {$width},
                                `height` = {$height},
                                `size` = {$size}
                                ";
            $this->db_to->query($query);

            if (!empty($this->db_to->error)) {
                echo $query . ' <br>' . "\n";
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
    
    private function casting()
    {
        $result = $this->db_to->query("SELECT `id`, `id_imdb` FROM `person` WHERE `image` != '' AND `origin` = 'ru' AND `actor` = 'yes' AND `death` IS NULL");
        while ($row = $result->fetch_assoc()) {
            $imdbId = $row['id_imdb'];

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `physical_person_people` as `t1` JOIN `physical_person` as `t2` ON t1.`physical_person_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'ethnic' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_ethnic` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `sport_people` as `t1` JOIN `sport` as `t2` ON t1.`sport_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sport' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_sport` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `foreign_language_people` as `t1` JOIN `foreign_language` as `t2` ON t1.`foreign_language_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'language' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_language` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `musical_instrument_people` as `t1` JOIN `musical_instrument` as `t2` ON t1.`musical_instrument_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'music_instrument' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_music_instrument` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `dance_people` as `t1` JOIN `dance` as `t2` ON t1.`dance_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'dance' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_dance` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }

            $result2 = $this->db_from->query("SELECT t2.`name` FROM `sing_people` as `t1` JOIN `sing` as `t2` ON t1.`sing_id` = t2.`id` WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $this->db_from->real_escape_string($row2['name']);
                $result3 = $this->db_to->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sing' AND `value` = '{$name}' LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $this->db_to->query("INSERT INTO `person_casting_sing` SET `personId` = {$row['id']}, `keyId` = {$row3['id']}");
                }
            }
        }

        $result = $this->db_to->query("SELECT `id`, `id_imdb` FROM `person` WHERE `image` != '' AND `origin` = 'ru' AND `actor` = 'yes' AND `death` IS NULL");
        while ($row = $result->fetch_assoc()) {
            $result2 = $this->db_from->query("SELECT 
                                    `sex`, `birthday`, `height`, `weight`, `hair_color_id`, `eyes_color_id`, `kasting`
                                    FROM `_peoples` WHERE `imdb_key` = {$row['id_imdb']} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = $row['id'];

                $sex = '';
                if ('m' == $row2['sex']) {
                    $sex = 'male';
                } else if ('w' == $row2['sex']) {
                    $sex = 'female';
                }

                $birthday = $row2['birthday'];
                if (false !== strpos($birthday, '-00')) {
                    $birthday = '';
                }
                if (empty($birthday)) {
                    $birthday = 'null';
                } else {
                    $birthday = '\'' . $birthday . '\'';
                }

                $height = intval($row2['height']);
                $weight = intval($row2['weight']);

                $hair_color_id = intval($row2['hair_color_id']);
                $color_hair = '';
                $result3 = $this->db_from->query("SELECT `name` FROM `hair_color` WHERE `id` = {$hair_color_id} LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $color_hair = $row3['name'];
                }
                $color_hair = $this->db_to->real_escape_string($color_hair);

                $eyes_color_id = intval($row2['eyes_color_id']);
                $color_eyes = '';
                $result3 = $this->db_from->query("SELECT `name` FROM `eyes_color` WHERE `id` = {$eyes_color_id} LIMIT 1");
                if ($row3 = $result3->fetch_assoc()) {
                    $color_eyes = $row3['name'];
                }
                $color_eyes = $this->db_to->real_escape_string($color_eyes);

                $castingId = intval($row2['kasting']);

                $query = "INSERT INTO `person_casting` SET 
                            `personId` = {$personId},
                            `sex` = '{$sex}',
                            `birthday` = {$birthday},
                            `height` = '{$height}',
                            `weight` = '{$weight}',
                            `color_hair` = '{$color_hair}',
                            `color_eyes` = '{$color_eyes}',
                            `castingId` = '{$castingId}',
                            `personWeight` = 0
                            ";
                $this->db_to_2->query($query);

                if (!empty($this->db_to_2->error)) {
                    echo $query . ' <br>' . "\n";
                    echo $this->db_to_2->error;
                    $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                    fwrite($fh, "{$query}\n{$this->db_to_2->error}");
                    fclose($fh);
                    exit;
                }
            }
        }
    }
    
    private function bio()
    {
        /**
         * Biography.
         */
        $result = $this->db_from->query("SELECT `_peoples_id` FROM `bio` WHERE 1 GROUP BY `_peoples_id` ORDER BY `_peoples_id`");
        while ($row = $result->fetch_assoc()) {
            $biography = '';
            $result2 = $this->db_from->query("SELECT `txt` FROM `bio` WHERE `_peoples_id` = {$row['_peoples_id']} ORDER BY `id` DESC LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $biography = $this->repairText($row2['txt'], false);

                if (!empty($biography)) {
                    if (false === strpos($biography, '<p>')) {
                        $biography = '<p>' . $biography . '</p>';
                    }
                    $biography = str_replace('http://www.kinomania.ru/', '/', $biography);
                }

                $biography = $this->db_to->real_escape_string($biography);
            }

            $this->db_to->query("UPDATE `person` SET `biography` = '{$biography}' WHERE `id_imdb` = {$row['_peoples_id']} LIMIT 1");
        }
    }
    
    private function moreInfo()
    {
        /**
         * Education.
         */
        $result = $this->db_from->query("SELECT `people_id` FROM `theater_work` WHERE 1 GROUP BY `people_id` ORDER BY `people_id`");
        while ($row = $result->fetch_assoc()) {
            $imdbId = intval($row['people_id']);

            $education = [];

            $result2 = $this->db_from->query("SELECT 
                                                t2.`name` as `university`,
                                                t3.`name` as `department`,
                                                t4.`name` as `studio`,
                                                t1.`year_start`,
                                                t1.`year_finish`,
                                                t1.`note`
                                                FROM `education` as `t1` 
                                                LEFT JOIN `university` as `t2` ON t1.`university_id` = t2.`id`
                                                LEFT JOIN `department` as `t3` ON t1.`department_id` = t3.`id`
                                                LEFT JOIN `studio` as `t4` ON t1.`department_id` = t4.`id`
                                                WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $item = [];

                $year_start = intval($row2['year_start']);
                if (0 == $year_start) {
                    $year_start = '';
                }
                $year_finish = intval($row2['year_finish']);
                if (0 == $year_finish) {
                    $year_finish = '';
                }

                $item[] = $row2['university']; //university
                $item[] = $row2['department']; //department
                $item[] = $row2['studio']; //studio
                $item[] = $year_start; //year_start
                $item[] = $year_finish; //year_end
                $item[] = $row2['note']; //comment

                $item = implode('_:_', $item);
                $education[] = $item;
            }
            $education = implode('_;_', $education);
            $education = $this->db_to->real_escape_string($education);

            $this->db_to->query("UPDATE `person` SET `education` = '{$education}' WHERE `id_imdb` = {$imdbId} LIMIT 1");
        }

        /**
         * Theatre.
         */
        $result = $this->db_from->query("SELECT `people_id` FROM `theater_work` WHERE 1 GROUP BY `people_id` ORDER BY `people_id`");
        while ($row = $result->fetch_assoc()) {
            $imdbId = intval($row['people_id']);

            $theater = [];
            $result2 = $this->db_from->query("SELECT 
                                                t2.`name` as `theatre`,
                                                t1.`performances`,
                                                t1.`year_from`,
                                                t1.`year_to`,
                                                t1.`note`
                                                FROM `theater_work` as `t1` 
                                                LEFT JOIN `theater` as `t2` ON t1.`theater_id` = t2.`id`
                                                WHERE t1.`people_id` = {$imdbId}");
            while ($row2 = $result2->fetch_assoc()) {
                $item = [];

                $year_start = intval($row2['year_from']);
                if (0 == $year_start) {
                    $year_start = '';
                }
                $year_finish = intval($row2['year_to']);
                if (0 == $year_finish) {
                    $year_finish = '';
                }

                $item[] = $row2['theatre']; //theatre
                $item[] = $row2['performances']; //spectacle
                $item[] = $year_start; //year_start
                $item[] = $year_finish; //year_end
                $item[] = $row2['note']; //comment

                $item = implode('_:_', $item);
                $theater[] = $item;
            }

            $theater = implode('_;_', $theater);
            $theater = $this->db_to->real_escape_string($theater);

            $this->db_to->query("UPDATE `person` SET `theater` = '{$theater}' WHERE `id_imdb` = {$imdbId} LIMIT 1");
        }

        /**
         * Award list.
         */
        $result = $this->db_to->query("SELECT `personId` FROM `awards_set` WHERE 1 GROUP BY `personId` ORDER BY `personId`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['personId']);

            $award_list = [];
            $result2 = $this->db_to->query("SELECT `id` FROM `awards` ORDER BY `id`");
            while ($row2 = $result2->fetch_assoc()) {
                $awardId = $row2['id'];
                $countWin = 0;
                $countNominee = 0;
                $result3 = $this->db_to->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `awardId` = {$awardId} AND `personId` = {$id} AND `win` = 'true' GROUP BY `awardId`");
                if ($row3 = $result3->fetch_assoc()) {
                    $countWin = $row3['count'];
                }
                $result3 = $this->db_to->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `awardId` = {$awardId} AND `personId` = {$id} GROUP BY `awardId`");
                if ($row3 = $result3->fetch_assoc()) {
                    $countNominee = $row3['count'];
                }
                if (0 < $countNominee) {
                    $award_list[] = $awardId . ':' . $countWin . ':' . $countNominee;
                }
            }



            $award_list = implode(';', $award_list);
            $award_list = $this->db_to->real_escape_string($award_list);

            $this->db_to->query("UPDATE `person` SET `award_list` = '{$award_list}' WHERE `id` = {$id} LIMIT 1");
        }
    }
    
    private function personRun()
    {
        $result = $this->db_from->query("SELECT 
                                        `id`, `imdb_key`, `name_eng`, `name_eng2`, `name_rus`, `name_rus2`, `words`, `sex`, `eng`,
                                         `rus`, `is_actor`, `is_rej`, `is_scen`, `is_prod`, `is_comp`, `is_oper`, `image`, `birthday`, `deathday`, 
                                         `birthplace`, `birthplace_rus`, `height`, `hidden`, `dop_obraz`, `dop_theat`, `performances`, `dop_prem`, `info`,
                                         `kt`, `rk_link`, `kp_link`, `status_check`
                                        FROM `_peoples` ORDER BY `id`", MYSQLI_USE_RESULT); // ID 0
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            if (1 > $id) {
                continue;
            }

            $id_imdb = intval($row['imdb_key']);
            $id_kt = intval($row['kt']);
            $id_rk = intval($row['rk_link']);

            $id_kp = $row['kp_link'];
            $id_kp = explode('?', $id_kp)[0];
            $id_kp = explode('people', $id_kp)[1] ?? explode('people', $id_kp)[0];
            $id_kp = intval(filter_var($id_kp, FILTER_SANITIZE_NUMBER_INT));

            if (0 > $id_imdb || 4294967295 < $id_imdb) {
                $id_imdb = 0;
            }
            if (0 > $id_kt || 4294967295 < $id_kt) {
                $id_kt = 0;
            }
            if (0 > $id_rk || 4294967295 < $id_rk) {
                $id_rk = 0;
            }
            if (0 > $id_kp || 4294967295 < $id_kp) {
                $id_kp = 0;
            }

            $image = '';
            if (0 < $row['image']) {
                $image = 'jpeg';
            }

            $status = 'hide';
            if (0 == $row['hidden']) {
                $status = 'show';
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
             * Name.
             */
            $name_origin = $this->db_to->real_escape_string(trim($this->repairText($row['name_eng']), '\'" '));
            if (empty($name_origin)) {
                $name_origin = $this->db_to->real_escape_string(trim($this->repairText($row['name_eng2']), '\'" '));
            }

            $name_ru = $this->db_to->real_escape_string(trim($this->repairText($row['name_rus']), '\'" '));
            if (empty($name_ru)) {
                $name_ru = $this->db_to->real_escape_string(trim($this->repairText($row['name_rus2']), '\'" '));
            }

            if (4 > mb_strlen($name_origin, 'UTF-8')) {
                $name_origin = '';
            }

            if (empty($name_origin) && empty($name_ru)) {
                continue;
            }

            /**
             * Unique search words.
             */
            $search = $this->repairText($row['words']);
            $wordList = explode(' ', $search);
            $temp = [];
            foreach ($wordList as $word) {
                if (false === stripos($name_origin, $word) && false === stripos($name_ru, $word)) {
                    if (!in_array($word, $temp)) {
                        $temp[] = $word;
                    }
                }
            }
            $search = $this->db_to->real_escape_string(implode(' ', $temp));

            $sex = '';
            if ('m' == $row['sex']) {
                $sex = 'male';
            } else if ('w' == $row['sex']) {
                $sex = 'female';
            }

            $origin = '';
            if ('Y' == $row['eng']) {
                $origin = 'foreign';
            } else if ('Y' == $row['rus']) {
                $origin = 'ru';
            }

            $actor = 'no';
            if ('Y' == $row['is_actor']) {
                $actor = 'yes';
            }

            $director = 'no';
            if ('Y' == $row['is_rej']) {
                $director = 'yes';
            }

            $screenwriter = 'no';
            if ('Y' == $row['is_scen']) {
                $screenwriter = 'yes';
            }

            $producer = 'no';
            if ('Y' == $row['is_prod']) {
                $producer = 'yes';
            }

            $composer = 'no';
            if ('Y' == $row['is_comp']) {
                $composer = 'yes';
            }

            $operator = 'no';
            if ('Y' == $row['is_oper']) {
                $operator = 'yes';
            }

            $day = 0;
            $month = 0;
            $birthday = $row['birthday'];
            if (false !== strpos($birthday, '-00')) {
                $birthday = '';
            }
            if (empty($birthday)) {
                $birthday = 'null';
            } else {
                $row['birthday'] = explode('-', $row['birthday']);
                $day = $row['birthday'][2] ?? 0;
                $month = $row['birthday'][1] ?? 0;
                $birthday = '\'' . $birthday . '\'';
            }
            $death = $row['deathday'];
            if (false !== strpos($death, '-00')) {
                $death = '';
            }
            if (empty($death)) {
                $death = 'null';
            } else {
                $death = '\'' . $death . '\'';
            }

            $birthplace_en = $this->db_to->real_escape_string($this->repairText($row['birthplace']));
            $birthplace_ru = $this->db_to->real_escape_string($this->repairText($row['birthplace_rus']));

            $height = intval($row['height']);

            /**
             * Education table.
             */
            $education = [];
            $education = implode('_;_', $education);
            $education = $this->db_to->real_escape_string($education);

            //$education_extra = $this->db_to->real_escape_string($this->repairText($row['dop_obraz']));

            /**
             * Theatre table.
             */
            $theater = [];
            $theater = implode('_;_', $theater);
            $theater = $this->db_to->real_escape_string($theater);

            //$theater_extra = $this->db_to->real_escape_string($this->repairText($row['dop_theat']));
            //$spectacle = $this->db_to->real_escape_string($this->repairText($row['performances']));

            $award = $this->db_to->real_escape_string($this->repairText($row['dop_prem']));
            $info = $this->db_to->real_escape_string($this->repairText($row['info']));

            $award_list = [];
            $award_list = implode(';', $award_list);
            $award_list = $this->db_to->real_escape_string($award_list);

            $note = '';

            $biography = '';

            $query = "INSERT INTO `person` SET 
                                `id` = {$id},
                                `s` = 0,
                                `image` = '{$image}',
                                `status` = '{$status}',
                                `name_origin` = '{$name_origin}',
                                `name_ru` = '{$name_ru}',
                                `search` = '{$search}',
                                `sex` = '{$sex}',
                                `origin` = '{$origin}',
                                `actor` = '{$actor}',
                                `director` = '{$director}',
                                `screenwriter` = '{$screenwriter}',
                                `producer` = '{$producer}',
                                `composer` = '{$composer}',
                                `operator` = '{$operator}',
                                `birthday` = {$birthday},
                                `death` = {$death},
                                `birthplace_en` = '{$birthplace_en}',
                                `birthplace_ru` = '{$birthplace_ru}',
                                `height` = '{$height}',
                                `education` = '{$education}',
                                `theater` = '{$theater}',
                                `award` = '{$award}',
                                `info` = '{$info}',
                                `biography` = '{$biography}',
                                `award_list` = '{$award_list}',
                                `match` = 0,
                                `id_imdb` = {$id_imdb},
                                `id_kp` = {$id_kp},
                                `id_kt` = {$id_kt},
                                `id_rk` = {$id_rk},
                                `note` = '{$note}',
                                `weight` = 0,
                                `check` = '{$check}',
                                `day` = {$day},
                                `month` = {$month}
                                ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query . ' <br>' . "\n";
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
}