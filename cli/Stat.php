<?php
require_once dirname(__FILE__) . '/IBase.php';

class Stat extends IBase
{
    public function run()
    {
        //$this->db_to->query("TRUNCATE `film_stat`");
        //$this->db_to->query("TRUNCATE `news_stat`");
        //$this->db_to->query("TRUNCATE `person_stat`");
        $this->db_to->query("TRUNCATE `film_review_stat`");
        $this->db_to->query("TRUNCATE `person_review_stat`");
        $this->db_to->query("TRUNCATE `trailer_stat`");

        //$this->user();
        //$this->update_connection();
        //$this->news();
        //$this->update_connection();
        $this->trailer();
        $this->update_connection();
        $this->feedback();
        $this->update_connection();
        $this->review();
        //$this->update_connection();
        //$this->person();
        //$this->update_connection();
        //$this->film();
    }

    private function update_connection()
    {
        $this->db_from->close();
        $this->db_from_2->close();
        $this->db_to->close();
        $this->db_to_2->close();

        $this->db_from = mysqli_connect("127.0.0.1", "root", "", "kinomania");
        $this->db_from->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_from);
        $this->db_from_2 = mysqli_connect("127.0.0.1", "root", "", "kinomania");
        $this->db_from_2->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_from_2);

        $this->db_to = mysqli_connect("127.0.0.1", "root", "", "kmmain");
        $this->db_to->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_to);
        $this->db_to_2 = mysqli_connect("127.0.0.1", "root", "", "kmmain");
        $this->db_to_2->query("SET NAMES 'UTF8'");
        setTimeZone($this->db_to_2);
    }

    private function review()
    {
        $result = $this->db_to->query("SELECT `id` FROM `film_review`");
        while ($row = $result->fetch_assoc()) {
            $reviewId = $row['id'];
            $vote = 0;
            $comment = 0;

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `comment` WHERE `relatedId` = {$reviewId} AND `type` = 'film'");
            if ($row2 = $result2->fetch_assoc()) {
                $comment = $row2['count'];
            }

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_review_vote` WHERE `reviewId` = {$reviewId}");
            if ($row2 = $result2->fetch_assoc()) {
                $vote = $row2['count'];
            }

            $this->db_to_2->query("INSERT INTO `film_review_stat` SET `reviewId` = {$reviewId}, `vote` = {$vote}, `comment` = {$comment}");
        }
    }

    private function feedback()
    {
        $result = $this->db_to->query("SELECT `id` FROM `person_review`");
        while ($row = $result->fetch_assoc()) {
            $reviewId = $row['id'];
            $vote = 0;
            $comment = 0;

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `comment` WHERE `relatedId` = {$reviewId} AND `type` = 'person'");
            if ($row2 = $result2->fetch_assoc()) {
                $comment = $row2['count'];
            }

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `person_review_vote` WHERE `reviewId` = {$reviewId}");
            if ($row2 = $result2->fetch_assoc()) {
                $vote = $row2['count'];
            }

            $this->db_to_2->query("INSERT INTO `person_review_stat` SET `reviewId` = {$reviewId}, `vote` = {$vote}, `comment` = {$comment}");
        }
    }

    private function trailer()
    {
        $result = $this->db_to->query("SELECT `id` FROM `trailer`");
        while ($row = $result->fetch_assoc()) {
            $trailerId = $row['id'];
            $vote = 0;
            $comment = 0;

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `comment` WHERE `relatedId` = {$trailerId} AND `type` = 'trailer'");
            if ($row2 = $result2->fetch_assoc()) {
                $comment = $row2['count'];
            }

            /**
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `trailer_vote` WHERE `trailerId` = {$trailerId}");
            if ($row2 = $result2->fetch_assoc()) {
                $vote = $row2['count'];
            }
             * **/

            $this->db_to_2->query("INSERT INTO `trailer_stat` SET `trailerId` = {$trailerId}, `vote` = {$vote}, `comment` = {$comment}");
        }
    }

    public function film()
    {
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `user_film_vote`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT SUM(`rate`) as `rate`, COUNT(`rate`) as `count` FROM `user_film_vote` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $rate = round($row2['rate'] / $count, 1);

                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `rate` = {$rate}, `rate_count` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = {$rate}, `rate_count` = {$count}, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                    `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0
                                   ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Trailer.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `trailer`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `trailer` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `trailer` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                    `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = {$count}, `soundtrack` = 0, `award` = 0
                                   ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Soundtrack.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `film_sound_dir`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_sound_dir` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `soundtrack` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                    `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = {$count}, `award` = 0
                                   ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Frame.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `film_frame`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_frame` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `frame` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                        `poster` = 0, `frame` = {$count}, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Wallpaper.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `film_wallpaper`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_wallpaper` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `wallpaper` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                        `poster` = 0, `frame` = 0, `wallpaper` = {$count}, `trailer` = 0, `soundtrack` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();


        /**
         * Poster.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `film_poster`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_poster` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `poster` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                        `poster` = {$count}, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Award.
         */
        $result = $this->db_to->query("SELECT DISTINCT `filmId` FROM `awards_set`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $filmId = intval($row['filmId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `filmId` = {$filmId} GROUP BY `filmId`");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `film_stat` SET `award` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `film_stat` SET `filmId` = {$filmId}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = 0, `kp_count` = 0, 
                                        `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = {$count}
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

    }

    private function person()
    {
        /**
         * Photo.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `person_photo`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `person_photo` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `photo` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = {$count}, `wallpaper` = 0, `frame` = 0, `news` = 0, `video` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Frame.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `film_frame_person`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_frame_person` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `frame` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = 0, `wallpaper` = 0, `frame` = {$count}, `news` = 0, `video` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Wallpaper.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `person_wallpaper`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `person_wallpaper` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `wallpaper` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = 0, `wallpaper` = {$count}, `frame` = 0, `news` = 0, `video` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Video.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `trailer_person`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `trailer_person` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `video` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = 0, `wallpaper` = 0, `frame` = 0, `news` = 0, `video` = {$count}, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * News.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `news_link`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `news_link` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `news` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = 0, `wallpaper` = 0, `frame` = 0, `news` = {$count}, `video` = 0, `award` = 0
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();

        /**
         * Award.
         */
        $result = $this->db_to->query("SELECT DISTINCT `personId` FROM `awards_set`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $personId = intval($row['personId']);

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `awards_set` WHERE `personId` = {$personId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count = intval($row2['count']);
                if (0 < $count) {
                    $result3 = $this->db_to_2->query("SELECT `id` FROM `person_stat` WHERE `personId` = {$personId} LIMIT 1");
                    if ($row3 = $result3->fetch_assoc()) {
                        $this->db_to_2->query("UPDATE `person_stat` SET `award` = {$count} WHERE `id` = {$row3['id']}");
                    } else {
                        $this->db_to_2->query("INSERT INTO `person_stat` SET `personId` = {$personId}, `photo` = 0, `wallpaper` = 0, `frame` = 0, `news` = 0, `video` = 0, `award` = {$count}
                                       ");
                    }
                    if (!empty($this->db_to_2->error)) {
                        echo $this->db_to_2->error;
                        $result->close();
                        $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                        fwrite($fh, "\n{$this->db_to_2->error}");
                        fclose($fh);
                        exit;
                    }
                }
            }
        }
        $result->close();
    }

    private function news()
    {
        $result = $this->db_to->query("SELECT COUNT(*) as `count`, `relatedId` FROM `comment` WHERE `type` = 'news' GROUP BY `relatedId`");
        while ($row = $result->fetch_assoc()) {
            $this->db_to_2->query("INSERT INTO `news_stat` SET `newsId` = {$row['relatedId']}, `comment` = {$row['count']}");
        }
    }

    private function user()
    {
        $result = $this->db_to->query("SELECT `id` FROM `user` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $userId = intval($row['id']);

            $count_review = 0;
            $count_feedback = 0;
            $count_comment = 0;
            $count_rate = 0;
            $count_film = 0;
            $count_person = 0;
            $count_film_pub = 0;
            $count_person_pub = 0;

            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `film_review` WHERE `userId` = {$userId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count_review = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `person_review` WHERE `userId` = {$userId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count_feedback = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `comment` WHERE `userId` = {$userId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count_comment = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `user_film_vote` WHERE `userId` = {$userId}");
            if ($row2 = $result2->fetch_assoc()) {
                $count_rate = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'film'");
            if ($row2 = $result2->fetch_assoc()) {
                $count_film = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'film' AND `status` = 'public'");
            if ($row2 = $result2->fetch_assoc()) {
                $count_film_pub = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'person'");
            if ($row2 = $result2->fetch_assoc()) {
                $count_person = $row2['count'];
            }
            $result2 = $this->db_to_2->query("SELECT COUNT(*) as `count` FROM `user_folder` WHERE `userId` = {$userId} AND `type` = 'person' AND `status` = 'public'");
            if ($row2 = $result2->fetch_assoc()) {
                $count_person_pub = $row2['count'];
            }

            $this->db_to_2->query("UPDATE `user` SET `count_review` = {$count_review}, `count_feedback` = {$count_feedback}, 
                                  `count_comment` = {$count_comment}, `count_rate` = {$count_rate}, `count_film` = {$count_film}, 
                                  `count_person` = {$count_person}, `count_film_pub` = {$count_film_pub}, `count_person_pub` = {$count_person_pub}
                                  WHERE `id` = {$userId}");
        }
        $result->close();
    }
}