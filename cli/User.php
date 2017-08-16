<?php
require_once dirname(__FILE__) . '/IBase.php';

class User extends IBase
{
    public function run()
    {
        //$this->db_to->query("TRUNCATE `user`");
        $this->db_to->query("TRUNCATE `user_film_vote`");
        $this->db_to->query("TRUNCATE `user_folder`");
        $this->db_to->query("TRUNCATE `user_folder_film`");
        $this->db_to->query("TRUNCATE `user_folder_person`");

        //$this->userRun();
        //$this->update_connection();
        $this->folder();
        $this->update_connection();
        $this->vote();
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

    private function vote()
    {
        $result2 = $this->db_from->query("SELECT `user_id`, `film_id`, `rating`, `created_date`, `updated_date` FROM `user_rating_film` ORDER BY `created_date`", MYSQLI_USE_RESULT);
        while ($row2 = $result2->fetch_assoc()) {
            $userId = intval($row2['user_id']);
            $filmId = intval($row2['film_id']);
            $rating = intval($row2['rating']);
            if (!empty($row2['updated_date'])) {
                $date = strtotime($row2['updated_date']);
            } else {
                $date = strtotime($row2['created_date']);
            }

            if (0 < $rating && 11 > $rating) {
                $result = $this->db_to->query("SELECT 1 FROM `user` WHERE `id` = {$userId} LIMIT 1");
                if (0 == $result->num_rows) {
                    $userId = 0;
                }
                $result = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $filmId = $row['id'];

                    $query = "INSERT INTO `user_film_vote` SET `userId` = {$userId}, `filmId` = {$filmId}, `rate` = {$rating}, `date` = FROM_UNIXTIME('{$date}')";
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
            }
        }
        $result2->close();
    }
    
    private function folder()
    {
        $result = $this->db_from->query("SELECT * FROM `folder_user` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $userId = intval($row['user_id']);
            $type = 'film';
            if (1 == $row['type']) {
                $type = 'person';
            }
            $order = intval($row['position']);
            $status = 'public';
            if (1 == $row['is_private']) {
                $status = 'private';
            }

            if (1 > $userId) {
                continue;
            }

            $default = '';
            switch ($row['folder_id']) {
                case 1:
                    $default = 'Избранное';
                    break;
                case 2:
                    $default = 'Смотреть в кино';
                    break;
                case 3:
                    $default = 'Найти в интернете';
                    break;
                case 4:
                    $default = 'Купить на DVD';
                    break;
                case 5:
                    $default = 'Актеры';
                    break;
                case 6:
                    $default = 'Актрисы';
                    break;
                case 7:
                    $default = 'Режиссеры';
                    break;

            }

            $name = '';
            if (empty($default)) {
                $result2 = $this->db_from_2->query("SELECT `title` FROM `folder` WHERE `id` = {$row['folder_id']} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $name = $row2['title'];
                }
            }

            $name = $this->db_to->real_escape_string($name);

            $query = "INSERT INTO `user_folder` SET
                        `id` = {$id},
                        `userId` = {$userId},
                        `type` = '{$type}',
                        `order` = {$order},
                        `status` = '{$status}',
                        `name` = '{$name}',
                        `default` = '{$default}'
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

        $result = $this->db_from->query("SELECT * FROM `folder_user_film` ORDER BY `folder_user_id`");
        while ($row = $result->fetch_assoc()) {
            $folderId = intval($row['folder_user_id']);
            $order = intval($row['position']);
            $filmId = intval($row['film_id']);

            if (9 > $folderId) {
                continue;
            }

            $result2 = $this->db_from->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                continue;
            }

            $this->db_to->query("INSERT INTO `user_folder_film` SET
                                `folderId` = {$folderId},
                                `order` = {$order},
                                `filmId` = {$filmId}
            ");
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }

        $result = $this->db_from->query("SELECT * FROM `folder_user_people` ORDER BY `folder_user_id`");
        while ($row = $result->fetch_assoc()) {
            $folderId = intval($row['folder_user_id']);
            $order = intval($row['position']);
            $personId = intval($row['people_id']);

            if (9 > $folderId) {
                continue;
            }

            $result2 = $this->db_from->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $personId = $row2['id'];
            } else {
                continue;
            }

            $this->db_to->query("INSERT INTO `user_folder_person` SET
                                `folderId` = {$folderId},
                                `order` = {$order},
                                `personId` = {$personId}
            ");
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                $result->close();
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "\n{$this->db_to->error}");
                fclose($fh);
                exit;
            }
        }
    }

    private function getPassword($password)
    {
        $out = '';
        $key = '111';

        $password = base64_decode($password);
        for ($i = 0; $i < strlen($password); $i++) {
            $keyChar = 0;
            if ($i % 4 != 3) {
                $keyChar = ord($key[$i % 4]);
            }
            $passChar = ord($password[$i]);
            $out .= chr($keyChar ^ $passChar);
        }

        return password_hash($out, PASSWORD_DEFAULT);
    }

    private function userRun()
    {
        $last = strtotime('now') - 60 * 60 * 24;
        $result = $this->db_from->query("SELECT * FROM `a_Accounts` WHERE `ID` >= 99400  ORDER BY `ID`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['ID']);
            $login = $this->db_to->real_escape_string($this->repairText($row['NicName']));
            $email = $this->db_to->real_escape_string($this->repairText($row['Mail']));

            $image = '';
            if (0 < $row['image']) {
                $image = 'jpeg';
            }

            /**
             * Optimize.
             */
            $tempPass = $this->db_to->real_escape_string($row['Password']);
            $result2 = $this->db_to->query("SELECT `password` FROM `user_temp_password` WHERE `row` = '{$tempPass}' LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $password = $row2['password'];
            } else {
                $password = $this->getPassword($row['Password']);
            }



            $name = $this->db_to->real_escape_string($this->repairText($row['Name1']));
            $surname = mb_substr($this->repairText($row['Name2']), 0, 40, 'UTF-8');
            $surname = $this->db_to->real_escape_string($surname);
            $sex = '';
            switch ($row['Sex']) {
                case 1:
                    $sex = 'male';
                    break;
                case 2:
                    $sex = 'female';
                    break;
            }
            $status = 'active';
            if (0 == $row['Status']) {
                $status = 'new';
            }
            $city = $this->db_to->real_escape_string($this->repairText($row['Town']));
            $about = $this->db_to->real_escape_string($this->repairText($row['About']));
            $interest = $this->db_to->real_escape_string($this->repairText($row['Interes']));
            $hash = '';
            $hashChange = strtotime('now') - 86400;

            if ('0000-00-00 00:00:00' == $row['DateReg']) {
                $registration = 0;
            } else {
                $registration = strtotime($row['DateReg']);
            }
            $birthday = $row['BirthDay'];
            if ('0000-00-00' == $birthday) {
                $birthday = '';
            }
            if (empty($birthday)) {
                $birthday = 'null';
            } else {
                $birthday = '\'' . $birthday . '\'';
            }

            $myMail = $this->repairText($row['my_mail_ru']);
            $skype = $this->repairText($row['Skype']);
            $icq = $this->repairText($row['ICQ']);

            /**
             * Filter vkontakte.
             */
            $vk = $this->db_to->real_escape_string($this->vk($row['VKontakte']));

            /**
             * Filter facebook.
             */
            $fb = $this->db_to->real_escape_string($this->fb($row['facebook']));

            /**
             * Filter odnoklassniki.
             */
            $ok = $this->db_to->real_escape_string($this->ok($row['Odnoklassniki']));

            /**
             * Filter twitter.
             */
            $twitter = $this->db_to->real_escape_string($this->tw($row['twitter']));

            /**
             * Filter googlePlus.
             */
            $googlePlus = $this->db_to->real_escape_string($this->gp($row['google_plus']));

            /**
             * Filter LiveJournal.
             */
            $liveJournal = $this->db_to->real_escape_string($this->lj($row['LiveJournal']));

            /**
             * Filter LiveInternet.
             */
            $tg = '';

            if (false !== filter_var($skype, FILTER_VALIDATE_URL)) {
                $skype = '';
            } else {
                $skype = preg_replace('/[^a-zA-Z0-9\.,\-_]/', '', $skype);
            }

            if (false !== filter_var($icq, FILTER_VALIDATE_URL)) {
                $icq = '';
            } else {
                $icq = preg_replace('/[^0-9]/', '', $icq);
            }


            if (32 < mb_strlen($skype, 'UTF-8')) {
                $skype = mb_strcut($skype, 0, 32, 'UTF-8');
            }

            if (32 < mb_strlen($name, 'UTF-8')) {
                $name = mb_strcut($name, 0, 32, 'UTF-8');
            }

            $query = "
                INSERT INTO `user` SET 
                `id` = {$id},
                `s` = 0,
                `image` = '{$image}',
                `login` = '{$login}',
                `email` = '{$email}',
                `password` = '{$password}',
                `status` = '{$status}',
                `name` = '{$name}',
                `surname` = '{$surname}',
                `sex` = '{$sex}',
                `city` = '{$city}',
                `about` = '{$about}',
                `interest` = '{$interest}',
                `hash` = '{$hash}',
                `hashChange` = FROM_UNIXTIME('{$hashChange}'),
                `registration` = FROM_UNIXTIME('{$registration}'),
                `birthday` = {$birthday},
                `vk` = '{$vk}',
                `fb` = '{$fb}',
                `ok` = '{$ok}',
                `twitter` = '{$twitter}',
                `googlePlus` = '{$googlePlus}',
                `liveJournal` = '{$liveJournal}',
                `tg` = '{$tg}',
                `myMail` = '{$myMail}',
                `instagram` = '',
                `skype` = '{$skype}',
                `icq` = '{$icq}',
                `count_review` = 0,
                `count_feedback` = 0,
                `count_comment` = 0,
                `count_rate` = 0,
                `count_film` = 0,
                `count_person` = 0,
                `count_film_pub` = 0,
                `count_person_pub` = 0,
                `last` = FROM_UNIXTIME('{$last}')
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