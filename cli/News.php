<?php
require_once dirname(__FILE__) . '/IBase.php';

class News extends IBase
{
    public function run()
    {
        $this->db_to->query("TRUNCATE `news`");
            $this->db_to->query("TRUNCATE `news_file`");
        $this->db_to->query("TRUNCATE `news_gallery`");
        $this->db_to->query("TRUNCATE `news_gallery_image`");
        $this->db_to->query("TRUNCATE `news_link`");
            $this->db_to->query("TRUNCATE `news_stat`");
        $this->db_to->query("TRUNCATE `news_tag`");
        $this->db_to->query("TRUNCATE `news_tag_value`");

        $this->newsRun();
        $this->tag();
        $this->gallery();
        $this->links();
    }

    private function links()
    {
        $result = $this->db_from->query("SELECT * FROM `newslinks` ORDER BY `id`");
        while ($row =  $result->fetch_assoc()) {
            $newsId = intval($row['news_id']);
            $filmId = intval($row['_films_id']);
            $personId = intval($row['_peoples_id']);

            if (0 < $filmId) {
                $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $filmId = $row2['id'];
                }
            }

            if (0 < $personId) {
                $result2 = $this->db_from_2->query("SELECT `id` FROM `_peoples` WHERE `imdb_key` = {$personId} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $personId = $row2['id'];
                }
            }

            if (0 == $personId && 0 == $filmId) {
                continue;
            }

            $query = "INSERT INTO `news_link` SET `newsId` = {$newsId}, `personId` = {$personId}, `filmId` = {$filmId}";
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
    }

    private function gallery()
    {
        $result = $this->db_from->query("SELECT `id`, `news_id`, `trailer_id` FROM `news_gellary` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);
            $newsId = intval($row['news_id']);
            $trailerId = intval($row['trailer_id']);

            $query = "
                INSERT INTO `news_gallery` SET
                `id` = {$id},
                `newsId` = {$newsId},
                `trailerId` = {$trailerId}
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

            $result_2 = $this->db_from_2->query("SELECT `id`, `news_gellary_id` FROM `news_gellary_image` WHERE `news_gellary_id` = {$id} ORDER BY `id`");
            $cnt = 0;
            while ($row2 = $result_2->fetch_assoc()) {
                $imageId = intval($row2['id']);
                $galleryId = intval($row2['news_gellary_id']);
                $s = 0;
                $image = 'jpeg';
                $cnt++;
                $order = $cnt;
                $this->db_to->query("
                    INSERT INTO `news_gallery_image` SET `id` = {$imageId}, `galleryId` = {$galleryId}, `s` = {$s}, `image` = '{$image}', `order` = {$order}
                ");
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
        }
        $result->close();
    }

    private function tag()
    {
        $result = $this->db_from_2->query("SELECT * FROM `tags` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $tag = $this->repairText($row['name']);
            if (empty($tag)) {
                continue;
            }

            $id = intval($row['id']);
            $tag = $this->db_to->real_escape_string($tag);


            $query = "INSERT INTO `news_tag_value` SET `id` = {$id}, `tag` = '{$tag}'";
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

        $result = $this->db_from_2->query("SELECT * FROM `news2tags` ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $newsId = intval($row['nid']);
            $tagId = intval($row['tid']);
            $query = "INSERT INTO `news_tag` SET `newsId` = {$newsId}, `tagId` = {$tagId}";
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

    }

    private function newsRun()
    {
        $result = $this->db_from->query("SELECT * FROM `news` ORDER BY `id`", MYSQLI_USE_RESULT);
        while ($row = $result->fetch_assoc()) {
            $id = intval($row['id']);

            $status = 'show';
            if (0 ==  $row['view']) {
                $status = 'hide';
            }

            $filmId = intval($row['review_film_id']);
            $result2 = $this->db_from_2->query("SELECT `id` FROM `_films` WHERE `imdb_key` = {$filmId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $filmId = $row2['id'];
            } else {
                $filmId = 0;
            }

            $image = '';
            if (0 < $row['big_image']) {
                $image = 'jpeg';
            }

            $category = 'Новости кино';
            switch ($row['serial']) {
                case 2:
                    $category = 'Российские сериалы';
                    break;
                case 3:
                    $category = 'Зарубежные сериалы';
                    break;
                case 4:
                    $category = 'Российские сериалы';
                    break;
                case 5:
                    $category = 'Зарубежные сериалы';
                    break;
                case 6:
                    $category = 'Блог';
                    break;
                case 7:
                    $category = 'Арткиномания';
                    break;
                case 8:
                    $category = 'Был бы повод';
                    break;
                case 9:
                    $category = 'Ожидания';
                    break;
                case 10:
                    $category = 'BOOM';
                    break;
                case 11:
                    $category = 'В десятку';
                    break;
                case 12:
                    $category = 'Бокс-офис';
                    break;
                case 13:
                    $category = 'Пресс-обзор';
                    break;
                case 14:
                    break;
                case 15:
                    $category = 'Short';
                    break;
                case 16:
                    $category = 'Инсайд';
                    break;
                case 17:
                    $category = 'Интервью';
                    break;
                case 18:
                    $category = 'Рецензии';
                    break;
            }

            if (empty($row['publish'])) {
                $publish = strtotime($row['post']);
            } else {
                $publish = strtotime($row['publish']);
            }

            $authorId = intval($row['user_id']);

            $title = $this->repairText($row['title']);
            $title_html = $this->repairText($row['html_title']);
            $title_short = $this->repairText($row['title_short']);
            if (empty($title_short)) {
                $title_short = $this->repairText($row['title2']);
            }

            $center = 'no';
            if (1 == $row['inmain']) {
                $center = 'yes';
            }

            $popular = 'no';
            if (1 == $row['recommended']) {
                $popular = 'yes';
            }

            $text = $this->repairText($row['txt'], false);
            $anons = $this->repairText($row['text_main'], false);
            if (empty($anons)) {
                $anons = $this->repairText($row['anons'], false);
                if (empty($anons)) {
                    $anons = $this->repairText($row['anons_site'], false);
                    if (empty($anons)) {
                        $anons = $this->repairText($row['anons_main_mini'], false);
                        if (empty($anons)) {
                            $anons = $this->repairText($row['anons_main'], false);
                        }
                    }
                }
            }
            $text_short = $this->repairText($row['short_article_text']);
            if (empty($anons)) {
                $anons = $text_short;
            }
            
            $text = str_replace('http://www.kinomania.ru/', '/', $text);
            $anons = str_replace('http://www.kinomania.ru/', '/', $anons);
            if (false === strpos($text, '<p>')) {
                $text = '<p>' . $text . '</p>';
            }

            $title = $this->db_to->real_escape_string($title);
            $title_html = $this->db_to->real_escape_string($title_html);
            $title_short = $this->db_to->real_escape_string($title_short);
            $text = $this->db_to->real_escape_string($text);
            $text_short = $this->db_to->real_escape_string($text_short);
            $anons = $this->db_to->real_escape_string($anons);

            $query = "INSERT INTO `news` SET
                `id` = {$id},
                `s` = 0,
                `image` = '{$image}',
                `status` = '{$status}',
                `category` = '{$category}',
                `publish` = FROM_UNIXTIME('{$publish}'),
                `authorId` = {$authorId},
                `title` = '{$title}',
                `title_html` = '{$title_html}',
                `title_short` = '{$title_short}',
                `center` = '{$center}',
                `popular` = '{$popular}',
                `text` = '{$text}',
                `text_short` = '{$text_short}',
                `anons` = '{$anons}',
                `filmId` = {$filmId}
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
    }

}