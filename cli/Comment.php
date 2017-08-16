<?php
require_once dirname(__FILE__) . '/IBase.php';

class Comment extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `comment`");
        $this->db_to->query("TRUNCATE `comment_stat`");
        $this->db_to->query("TRUNCATE `comment_vote`");
        
        $this->db_to->query("TRUNCATE `film_review`");
        $this->db_to->query("TRUNCATE `film_review_vote`");
        
        $this->db_to->query("TRUNCATE `person_review`");
        $this->db_to->query("TRUNCATE `person_review_vote`");
        
        $this->commentRun();
        $this->update_connection();
        $this->filmReview();
        $this->update_connection();
        $this->personReview();
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

    private function personReview()
    {
        $result = $this->db_from->query("SELECT t1.*, t2.`people_id` as `personId` FROM `user_review` as `t1` JOIN `user_review_people` as `t2` ON t1.`id` = t2.`user_review_id` ORDER BY t1.`id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $personId = intval($row['personId']);

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = intval($row2['id']);
            }

            $userId = intval($row['user_id']);
            $name = $this->db_to->real_escape_string($this->repairText($row['name_unregistred']));
            if (32 < mb_strlen($name, 'UTF-8')) {
                $name = mb_strcut($name, 0, 32, 'UTF-8');
            }
            $status = 'show';
            if (0 == $row['show']) {
                $status = 'hide';
            }
            $text = $this->db_to->real_escape_string($this->repairText($row['text'], false));
            $date = strtotime($row['created']);
            $rate = 0;

            $query = "INSERT INTO `person_review` SET
                `id` = {$id},
                `personId` = {$personId},
                `userId` = {$userId},
                `name` = '{$name}', 
                `status` = '{$status}',
                `text` = '{$text}',
                `date` = FROM_UNIXTIME('{$date}')
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

        $result = $this->db_from->query("SELECT t1.* FROM `user_review_vote` as `t1` JOIN `user_review_people` as `t2` ON t1.`user_review_id` = t2.`user_review_id` ORDER BY t1.`user_review_id`");
        while ($row = $result->fetch_assoc()) {
            $reviewId = intval($row['user_review_id']);
            $userId = intval($row['user_id']);
            $query = "INSERT INTO `person_review_vote` SET
                `reviewId` = {$reviewId},
                `userId` = {$userId}
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

        $result = $this->db_to->query("SELECT `reviewId`, COUNT(*) as `rate` FROM `person_review_vote` GROUP BY `reviewId`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['reviewId']);
            $rate = intval($row['rate']);
            $this->db_to_2->query("UPDATE `person_review` SET `rate` = {$rate} WHERE `id` = {$id} LIMIT 1");
        }
    }

    private function filmReview()
    {
        $result = $this->db_from->query("SELECT t1.*, t2.`film_id` as `filmId` FROM `user_review` as `t1` JOIN `user_review_film` as `t2` ON t1.`id` = t2.`user_review_id` ORDER BY t1.`id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $filmId = intval($row['filmId']);

            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = intval($row2['id']);
            }

            $userId = intval($row['user_id']);
            $name = $this->db_to->real_escape_string($this->repairText($row['name_unregistred']));
            if (32 < mb_strlen($name, 'UTF-8')) {
                $name = mb_strcut($name, 0, 32, 'UTF-8');
            }
            $status = 'show';
            if (0 == $row['show']) {
                $status = 'hide';
            }
            $text = $this->db_to->real_escape_string($this->repairText($row['text'], false));
            $date = strtotime($row['created']);

            $query = "INSERT INTO `film_review` SET
                `id` = {$id},
                `filmId` = {$filmId},
                `userId` = {$userId},
                `name` = '{$name}', 
                `status` = '{$status}',
                `text` = '{$text}',
                `date` = FROM_UNIXTIME('{$date}')
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

        $result = $this->db_from->query("SELECT t1.* FROM `user_review_vote` as `t1` JOIN `user_review_film` as `t2` ON t1.`user_review_id` = t2.`user_review_id` ORDER BY t1.`user_review_id`");
        while ($row = $result->fetch_assoc()) {
            $reviewId = intval($row['user_review_id']);
            $userId = intval($row['user_id']);
            $query = "INSERT INTO `film_review_vote` SET
                `reviewId` = {$reviewId},
                `userId` = {$userId}
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

        $result = $this->db_to->query("SELECT `reviewId`, COUNT(*) as `rate` FROM `film_review_vote` GROUP BY `reviewId`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['reviewId']);
            $rate = intval($row['rate']);
            $this->db_to_2->query("UPDATE `film_review` SET `rate` = {$rate} WHERE `id` = {$id} LIMIT 1");
        }
    }

    private function commentRun()
    {
        $result = $this->db_from->query("SELECT * FROM `a_Comments` ORDER BY `ID`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['ID']);
            $parent = intval($row['ParentID']);
            $status = 'hide';
            if (1 == $row['moderate']) {
                $status = 'show';
            }

            $text = $this->repairText($row['Text'], false);

            $text = $this->db_to->real_escape_string($text);

            $userId = intval($row['AccountID']);
            $name = $this->repairText($row['Name']);
            $name = $this->db_to->real_escape_string($name);

            if (0 == $userId && empty($name)) {
                continue;
            }

            $date = strtotime($row['DateComment']);

            $type = 'news';
            $relatedId = 0;

            $result2 = $this->db_from->query("SELECT `object_id`, `type` FROM `comment_type` WHERE `comment_id` = {$id} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $relatedId = intval($row2['object_id']);
                if (2 == $row2['type']) {
                    $type = 'trailer';
                } else if (1 == $row2['type']) {
                    $type = 'film';
                    $result3 = $this->db_from->query("SELECT 1 FROM `user_review_people` WHERE `user_review_id` = {$relatedId} LIMIT 1");
                    if (0 < $result3->num_rows) {
                        $type = 'person';
                    }
                }
            }

            $query = "
                INSERT INTO `comment` SET
                `id` = {$id},
                `parent` = {$parent},
                `status` = '{$status}',
                `relatedId` = {$relatedId},
                `type` = '{$type}',
                `userId` = {$userId},
                `name` = '{$name}',
                `text` = '{$text}',
                `date` = FROM_UNIXTIME('{$date}')
            ";
            $this->db_to->query($query);
            if (!empty($this->db_to->error)) {
                echo $query;
                echo "<br> \n";
                echo $this->db_to->error;
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "{$query}\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }

        $result = $this->db_from->query("SELECT COUNT(*) as `count`, SUM(`positive`) as `plus`, `comment_id` FROM `comment_vote` GROUP BY `comment_id`");
        while ($row = $result->fetch_assoc()) {
            $commentId = $row['comment_id'];
            $count = $row['count'];
            $like = $row['plus'];
            $dislike = $count - $like;

            $this->db_to->query("INSERT INTO `comment_stat` SET `commentId` = {$commentId}, `like` = {$like}, `dislike` = '{$dislike}'");
        }

        $result = $this->db_from->query("SELECT * FROM `comment_vote` ORDER BY `comment_id`");
        while ($row = $result->fetch_assoc()) {
            $userId = intval($row['user_id']);
            $commentId = intval($row['comment_id']);
            $vote = intval($row['positive']);
            $this->db_to->query("INSERT INTO `comment_vote` SET `userId` = {$userId}, `commentId` = {$commentId}, `vote` = {$vote}");
        }
    }
}