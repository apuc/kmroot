<?php
require_once dirname(__FILE__) . '/IBase.php';

class Award extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `awards`");
        $this->db_to->query("INSERT INTO `awards` (`id`, `code`, `name_ru`, `name_en`, `type`, `description`, `year`) VALUES
(1, 'oscar', 'Оскар', 'Academy Awards', 'award', 'Премия Академии кинематографических искусств и наук США. Ежегодно вручается в Лос-Анджелесе. По праву считается самой престижной кинопремией мира.', ''),
(2, 'mtv', 'MTV (США)', 'MTV (USA)', 'award', 'Кинопремия телеканала MTV. Вручается с 1992 года. Победители определяются зрительским голосованием. Главный приз — «Золотой стакан попкорна».', ''),
(3, 'globe', 'Золотой Глобус', 'Golden Globe', 'award', 'Премия Голливудской ассоциации иностранной прессы за кино- и телевизионные фильмы, вручается с 1944 года. В голосовании участвуют около 90 международных журналистов, проживающих в Голливуде.', ''),
(4, 'nika', 'Ника', '-', 'hidden', '', ''),
(5, 'emmy', 'ЭММИ', 'EMMY', 'hidden', 'Американская телевизионная премия. Вручается с 1949 года. Считается телевизионным аналогом премии \"Оскар\".', ''),
(6, 'razzie', 'Золотая Малина', 'Razzie Awards', 'award', 'Антинаграда, вручаемая худшим представителям кинематографического сообщества США. Год основания — 1981-й. Лауреаты становятся известны за день до оскаровской церемонии.', ''),
(7, 'berlin', 'Берлинский кинофестиваль', 'Berlin International Film Festival', 'festival', 'Ежегодный международный кинофестиваль. Главный приз — «Золотой медведь» (медведь — геральдический символ Берлина). Первый фестиваль прошел в 1951 году.', ''),
(8, 'venice', 'Венецианский кинофестиваль', 'Venice International Film Festival', 'festival', 'Старейший международный кинофестиваль. Основан по инициативе Бенито Муссолини в 1932 году. Главный приз — «Золотой лев».', ''),
(9, 'miff', 'Московский кинофестиваль', 'Moscow International Film Festival', 'festival', 'Флагман фестивального движения в России. Впервые прошел в 1935 году под председательством Сергея Эйзенштейна, на постоянной основе (раз в два года)  стал проводиться с 1959-го. С 1997-го стал ежегодным.', ''),
(10, 'cannes', 'Каннский кинофестиваль', 'Cannes International Film Festival', 'festival', 'Ежегодный международный кинофестиваль, проводимый в мае на Лазурном побережье Франции. Впервые смотр состоялся в 1946 году. Главный приз — «Золотая Пальмовая ветвь».', ''),
(11, 'orel', 'Золотой Орел', '', 'hidden', '', '');");

        $this->db_to->query("TRUNCATE `awards_year`");
        $this->db_to->query("TRUNCATE `awards_nomination`");
        $this->db_to->query("TRUNCATE `awards_set`");

        /**
         * Awards
         */
        $result_2 = $this->db_from->query("SELECT `id`, `aw_id`, `year` FROM `awards_place` ORDER BY `id`");
        while ($row_2 = $result_2->fetch_assoc()) {
            $this->db_to->query("INSERT INTO `awards_year` SET `id` = {$row_2['id']}, `awardId` = {$row_2['aw_id']}, `year` = '{$row_2['year']}'");
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                echo "\n\n";
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "\n{$this->db_to->error}");
                fclose($fh);
                exit();
            }
        }

        $result = $this->db_from->query("SELECT `id`, `name_eng`, `name_rus`, `aw_id`, `view` FROM `awards_nominations` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $name_en = $this->db_to->real_escape_string($row['name_eng']);
            $name_ru = $this->db_to->real_escape_string($row['name_rus']);
            $awardId = intval($row['aw_id']);
            $view = 'film';
            switch ($row['view']) {
                case 1:
                    $view = 'person_film';
                    break;
            }
            $this->db_to->query("INSERT INTO `awards_nomination` SET `id` = {$id}, `name_ru` = '{$name_ru}', `name_en` = '{$name_en}', `awardId` = {$awardId}, `type` = '{$view}'");
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                echo "\n\n";
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "\n{$this->db_to->error}");
                fclose($fh);
                exit();
            }
        }

        $result = $this->db_from->query("SELECT t1.`set`, t1.`f_id`, t1.`p_id`, t1.`vin`, t2.`year`, t3.`id` as `awardId`, t4.`id`, t4.`view` FROM `aw_set` as `t1` INNER JOIN `awards_place` as `t2` ON t1.`pl_id` = t2.`id` INNER JOIN `awards_name` as `t3` ON(t2.`aw_id` = t3.`id`) JOIN `awards_nominations` as `t4` ON(t1.`aw_id` = t4.`id`) WHERE t1.`f_id` IS NOT NULL ORDER BY t3.`id`, t2.`year` desc");
        while ($row = $result->fetch_assoc()) {
            $set = intval($row['set']);
            $awardId = intval($row['awardId']);
            $year = intval($row['year']);
            $nominationId = intval($row['id']);
            $filmId = intval($row['f_id']);
            $personId = intval($row['p_id']);
            $win = 'false';
            if ('Y' == $row['vin']) {
                $win = 'true';
            }

            if (0 == $filmId && 0 == $personId) {
                continue;
            }

            $result2 = $this->db_to->query("SELECT GROUP_CONCAT(`year` ORDER BY `year` DESC SEPARATOR ',') as `year` FROM `awards_year` WHERE `awardId` = {$awardId} GROUP BY `awardId`");
            if ($row2 = $result2->fetch_assoc()) {
                $year2 = $this->db_to->real_escape_string($row2['year']);
                $this->db_to->query("UPDATE `awards` SET `year` = '{$year2}' WHERE `id` = {$awardId} LIMIT 1");
            }

            if (2 == $row['view']) {
                $personId = 0;
            } else {
                $result_2 = $this->db_from->query("SELECT t1.`p_id` FROM `aw_set` as `t1` INNER JOIN `awards_place` as `t2` ON t1.`pl_id` = t2.`id` INNER JOIN `awards_name` as `t3` ON (t2.`aw_id` = t3.`id`) JOIN `awards_nominations` as `t4` ON(t1.`aw_id` = t4.`id`) 
                      WHERE t1.`set` = {$set} AND t2.`year` = {$year} AND t3.`id` = {$awardId} AND t4.`id` = {$nominationId}");
                if ($row_2 = $result_2->fetch_assoc()) {
                    $personId = intval($row_2['p_id']);
                }
            }

            if (0 < $filmId) {
                $result2 = $this->db_from->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $filmId = $row2['id'];
                }
            }
            if (0 < $personId) {
                $result2 = $this->db_from->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $personId = $row2['id'];
                }
            }

            $this->db_to->query("INSERT INTO `awards_set` SET `awardId` = {$awardId}, `year` = {$year}, `nominationId` = {$nominationId}, `filmId` = {$filmId}, `personId` = {$personId}, `win` = '{$win}'");
            if (!empty($this->db_to->error)) {
                echo $this->db_to->error;
                echo "\n\n";
                $fh = fopen(dirname(__FILE__) . '/error.txt', 'ab');
                fwrite($fh, "\n{$this->db_to->error}");
                fclose($fh);
                exit();
            }
        }
    }
}