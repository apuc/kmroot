<?php
namespace Kinomania\Control\Film;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Film\Soundtrack\Soundtrack;
use Kinomania\Control\Server\StaticS;
use Kinomania\Control\Video\Video;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Parser\Film\ImdbFilm;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Text\TText;

class Film extends DB
{
    use TRepository;
    use TText;
    
    const FILM_EXIST = 'FILM_EXIST';
    const ID_NOT_FOUND = 'ID_NOT_FOUND';

    /**
     * @return int
     */
    public function insertedId()
    {
        return $this->insertedId;
    }

    public function merge()
    {
        $this->error = '';
        $post = new PostBag();
        $filmId = $post->fetchInt('filmId');
        $toId = $post->fetchInt('toId');

        $result = $this->db->query("SELECT * FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $result = $this->db->query("SELECT * FROM `film` WHERE `id` = {$toId} LIMIT 1");
            if ($row2 = $result->fetch_assoc()) {
                $name_origin = $row2['name_origin'];
                if (empty($name_origin)) {
                    $name_origin = $this->db->real_escape_string($row['name_origin']);
                }
                $name_ru = $row2['name_ru'];
                if (empty($name_ru)) {
                    $name_ru = $row['name_ru'];
                }
                $search = $row2['search'];
                if (empty($search)) {
                    $search = $row['search'];
                }
                $country = $row2['country'];
                if (empty($country)) {
                    $country = $row['country'];
                }
                $year = $row2['year'];
                if (empty($year)) {
                    $year = $row['year'];
                }
                $genre = $row2['genre'];
                if (empty($genre)) {
                    $genre = $row['genre'];
                }
                $type = $row2['type'];
                if (empty($type)) {
                    $type = $row['type'];
                }
                $arthouse = $row2['arthouse'];
                if (empty($arthouse)) {
                    $arthouse = $row['arthouse'];
                }
                $runtime = $row2['runtime'];
                if (empty($runtime)) {
                    $runtime = $row['runtime'];
                }
                $premiere_world = $row2['premiere_world'];
                if (empty($premiere_world)) {
                    $premiere_world = $row['premiere_world'];
                }
                if (empty($premiere_world)) {
                    $premiere_world = 'null';
                } else {
                    $premiere_world = '\'' . $premiere_world . '\'';
                }
                $premiere_ru = $row2['premiere_ru'];
                if (empty($premiere_ru)) {
                    $premiere_ru = $row['premiere_ru'];
                }
                if (empty($premiere_ru)) {
                    $premiere_ru = 'null';
                } else {
                    $premiere_ru = '\'' . $premiere_ru . '\'';
                }
                $premiere_usa = $row2['premiere_usa'];
                if (empty($premiere_usa)) {
                    $premiere_usa = $row['premiere_usa'];
                }
                if (empty($premiere_usa)) {
                    $premiere_usa = 'null';
                } else {
                    $premiere_usa = '\'' . $premiere_usa . '\'';
                }
                $limit_us = $row2['limit_us'];
                if (empty($limit_us)) {
                    $limit_us = $row['limit_us'];
                }
                $limit_ru = $row2['limit_ru'];
                if (empty($limit_ru)) {
                    $limit_ru = $row['limit_ru'];
                }
                $budget = $row2['budget'];
                if (empty($budget)) {
                    $budget = $row['budget'];
                }
                $season_count = $row2['season_count'];
                if (empty($season_count)) {
                    $season_count = $row['season_count'];
                }
                $series_count = $row2['series_count'];
                if (empty($series_count)) {
                    $series_count = $row['series_count'];
                }
                $year_finish = $row2['year_finish'];
                if (empty($year_finish)) {
                    $year_finish = $row['year_finish'];
                }
                if (empty($year_finish)) {
                    $year_finish = 'null';
                } else {
                    $year_finish = '\'' . $year_finish . '\'';
                }
                $review = $row2['review'];
                if (empty($review)) {
                    $review = $row['review'];
                }
                $preview = $row2['preview'];
                if (empty($preview)) {
                    $preview = $row['preview'];
                }
                $fact = $row2['fact'];
                if (empty($fact)) {
                    $fact = $row['fact'];
                }
                $id_imdb = $row2['id_imdb'];
                if (empty($id_imdb)) {
                    $id_imdb = $row['id_imdb'];
                }
                $id_kp = $row2['id_kp'];
                if (empty($id_kp)) {
                    $id_kp = $row['id_kp'];
                }
                $id_kt = $row2['id_kt'];
                if (empty($id_kt)) {
                    $id_kt = $row['id_kt'];
                }
                $id_rk = $row2['id_rk'];
                if (empty($id_rk)) {
                    $id_rk = $row['id_rk'];
                }
                $note = $row2['note'];
                if (empty($note)) {
                    $note = $row['note'];
                }
                $weight = $row2['weight'];
                if (empty($weight)) {
                    $weight = $row['weight'];
                }
                $check = $row2['check'];
                if (empty($check)) {
                    $check = $row['check'];
                }

                $name_origin = $this->db->real_escape_string($name_origin);
                $name_ru = $this->db->real_escape_string($name_ru);
                $search = $this->db->real_escape_string($search);
                $country = $this->db->real_escape_string($country);
                $year = $this->db->real_escape_string($year);
                $genre = $this->db->real_escape_string($genre);
                $type = $this->db->real_escape_string($type);
                $arthouse = $this->db->real_escape_string($arthouse);
                $runtime = $this->db->real_escape_string($runtime);

                $limit_us = $this->db->real_escape_string($limit_us);
                $limit_ru = $this->db->real_escape_string($limit_ru);
                $budget = $this->db->real_escape_string($budget);
                $season_count = $this->db->real_escape_string($season_count);
                $series_count = $this->db->real_escape_string($series_count);

                $review = $this->db->real_escape_string($review);
                $preview = $this->db->real_escape_string($preview);
                $fact = $this->db->real_escape_string($fact);
                $id_imdb = $this->db->real_escape_string($id_imdb);
                $id_kp = $this->db->real_escape_string($id_kp);
                $id_kt = $this->db->real_escape_string($id_kt);
                $id_rk = $this->db->real_escape_string($id_rk);
                $note = $this->db->real_escape_string($note);
                $weight = $this->db->real_escape_string($weight);
                $check = $this->db->real_escape_string($check);

                $this->db->query("UPDATE `film` SET
                  `name_origin` = '{$name_origin}',
                  `name_ru` = '{$name_ru}',
                  `search` = '{$search}',
                  `country` = '{$country}',
                  `year` = '{$year}',
                  `genre` = '{$genre}',
                  `type` = '{$type}',
                  `arthouse` = '{$arthouse}',
                  `runtime` = '{$runtime}',
                  `premiere_world` = {$premiere_world},
                  `premiere_ru` = {$premiere_ru},
                  `premiere_usa` = {$premiere_usa},
                  `limit_us` = '{$limit_us}',
                  `limit_ru` = '{$limit_ru}',
                  `budget` = '{$budget}',
                  `season_count` = '{$season_count}',
                  `series_count` = '{$series_count}',
                  `year_finish` = {$year_finish},
                  `review` = '{$review}',
                  `preview` = '{$preview}',
                  `fact` = '{$fact}',
                  `id_imdb` = '{$id_imdb}',
                  `id_kp` = '{$id_kp}',
                  `id_kt` = '{$id_kt}',
                  `id_rk` = '{$id_rk}',
                  `note` = '{$note}',
                  `weight` = '{$weight}',
                  `check` = '{$check}'
                  WHERE `id` = {$toId} LIMIT 1;
                ");
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }

                /**
                 * Merge awards.
                 */
                $result = $this->db->query("SELECT `awardId`, `year`, `nominationId`, `personId`, `win` FROM `awards_set` WHERE `filmId` = {$filmId}");
                while ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `awards_set` WHERE `awardId` = {$row['awardId']} AND `year` = '{$row['year']}' AND `nominationId` = {$row['nominationId']} AND `win` = '{$row['win']}' AND `filmId` = {$toId} LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $this->db->query("INSERT INTO `awards_set` SET
                                          `awardId` = {$row['awardId']},
                                          `year` = '{$row['year']}',
                                          `nominationId` = {$row['nominationId']},
                                          `filmId` = {$toId},
                                          `personId` = {$row['personId']},
                                          `win` = '{$row['win']}'
                                         ");
                    }
                }

                /**
                 * Merge boxoffice.
                 */
                $result = $this->db->query("SELECT * FROM `film_boxoffice` WHERE `filmId` = {$filmId}");
                while ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_boxoffice` WHERE `filmId` = {$toId} AND `date_from` = '{$row['date_from']}' AND `date_to` = '{$row['date_to']}' AND `type` = '{$row['type']}' LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $row['name_origin'] = $this->db->real_escape_string($row['name_origin']);
                        $row['name_ru'] = $this->db->real_escape_string($row['name_ru']);
                        $row['company_name'] = $this->db->real_escape_string($row['company_name']);
                        $this->db->query("INSERT INTO `film_boxoffice` SET 
                                            `type` = '{$row['type']}',
                                            `position` = '{$row['position']}',
                                            `previous` = '{$row['previous']}',
                                            `filmId` = '{$toId}',
                                            `name_origin` = '{$row['name_origin']}',
                                            `name_ru` = '{$row['name_ru']}',
                                            `company_name` = '{$row['company_name']}',
                                            `week` = '{$row['week']}',
                                            `copy` = '{$row['copy']}',
                                            `gross` = '{$row['gross']}',
                                            `gross_total` = '{$row['gross_total']}',
                                            `gross_rub` = '{$row['gross_rub']}',
                                            `gross_total_rub` = '{$row['gross_total_rub']}',
                                            `views` = '{$row['views']}',
                                            `views_total` = '{$row['views_total']}',
                                            `date_from` = '{$row['date_from']}',
                                            `date_to` = '{$row['date_to']}',
                                            `course` = '{$row['course']}'
                                         ");
                    }
                }

                /**
                 * Merge cast.
                 */
                $result = $this->db->query("SELECT * FROM `film_cast` WHERE `filmId` = {$filmId}");
                if ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_cast` WHERE `filmId` = {$toId} AND `personId` = {$row['personId']} LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $row['role_ru'] = $this->db->real_escape_string($row['role_ru']);
                        $row['role_en'] = $this->db->real_escape_string($row['role_en']);
                        $row['note'] = $this->db->real_escape_string($row['note']);
                        $this->db->query("INSERT INTO `film_cast` SET 
                                            `filmId` = '{$toId}',
                                            `personId` = '{$row['personId']}',
                                            `role_ru` = '{$row['role_ru']}',
                                            `role_en` = '{$row['role_en']}',
                                            `note` = '{$row['note']}',
                                            `voice` = '{$row['voice']}',
                                            `self` = '{$row['self']}',
                                            `uncredited` = '{$row['uncredited']}',
                                            `episodes` = '{$row['episodes']}',
                                            `year` = '{$row['year']}',
                                            `source` = '{$row['source']}',
                                            `order` = '{$row['order']}'
                                          ");
                    }
                }

                /**
                 * Merge company.
                 */
                $result = $this->db->query("SELECT * FROM `film_company_rel` WHERE `filmId` = {$filmId}");
                if ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_company_rel` WHERE `filmId` = {$toId} AND `companyId` = {$row['companyId']} LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $this->db->query("INSERT INTO `film_company_rel` SET 
                                            `filmId` = '{$toId}',
                                            `companyId` = '{$row['companyId']}',
                                            `type` = '{$row['type']}'
                                          ");
                    }
                }

                /**
                 * Merge country.
                 */
                $result = $this->db->query("SELECT * FROM `film_country` WHERE `filmId` = {$filmId}");
                if ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_country` WHERE `filmId` = {$toId} AND `country` = '{$row['country']}' LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $this->db->query("INSERT INTO `film_country` SET 
                                            `filmId` = '{$toId}',
                                            `country` = '{$row['country']}'
                                          ");
                    }
                }
                $country = [];
                $result = $this->db->query("SELECT `country` FROM `film_country` WHERE `filmId` = {$toId}");
                while ($row = $result->fetch_assoc()) {
                    $country[] = $row['country'];
                }
                $country = implode(',', $country);
                $country = $this->db->real_escape_string($country);
                $this->db->query("UPDATE `film` SET `country` = '{$country}' WHERE `id` = {$toId} LIMIT 1");

                /**
                 * Merge crew.
                 */
                $result = $this->db->query("SELECT * FROM `film_crew` WHERE `filmId` = {$filmId}");
                if ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_crew` WHERE `filmId` = {$toId} AND `personId` = {$row['personId']} LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $row['description'] = $this->db->real_escape_string($row['description']);
                        $row['year'] = $this->db->real_escape_string($row['year']);
                        $this->db->query("INSERT INTO `film_crew` SET 
                                            `filmId` = '{$toId}',
                                            `personId` = '{$row['personId']}',
                                            `type` = '{$row['type']}',
                                            `description` = '{$row['description']}',
                                            `episodes` = '{$row['episodes']}',
                                            `year` = '{$row['year']}',
                                            `source` = '{$row['source']}',
                                            `order` = '{$row['order']}'
                                          ");
                    }
                }

                /**
                 * Merge genre.
                 */
                $result = $this->db->query("SELECT * FROM `film_genre` WHERE `filmId` = {$filmId}");
                if ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `film_genre` WHERE `filmId` = {$toId} AND `genre` = '{$row['genre']}' LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $this->db->query("INSERT INTO `film_genre` SET 
                                            `filmId` = '{$toId}',
                                            `genre` = '{$row['genre']}'
                                          ");
                    }
                }
                $genre = [];
                $result = $this->db->query("SELECT `genre` FROM `film_genre` WHERE `filmId` = {$toId}");
                while ($row = $result->fetch_assoc()) {
                    $genre[] = $row['genre'];
                }
                $genre = implode(',', $genre);
                $genre = $this->db->real_escape_string($genre);
                $this->db->query("UPDATE `film` SET `genre` = '{$genre}' WHERE `id` = {$toId} LIMIT 1");

                $this->db->query("UPDATE `comment` SET `relatedId` = {$toId} WHERE `relatedId` = {$filmId} AND `type` = 'film'");
                $this->db->query("UPDATE `film_frame` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_gross` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_poster` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_review` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_script` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_sound_dir` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `film_wallpaper` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `moderate` SET `relatedId` = {$toId} WHERE `relatedId` = {$filmId} AND `type` = 'film'");
                $this->db->query("UPDATE `news` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `news_link` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `trailer` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `tv_program` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");
                $this->db->query("UPDATE `user_folder_film` SET `filmId` = {$toId} WHERE `filmId` = {$filmId}");

                $stat = new Stat($this->db);
                $stat->updateAwardCount($filmId);
                $stat->updatePosterCount($filmId);
                $stat->updateFrameCount($filmId);
                $stat->updateSoundtrackCount($filmId);
                $stat->updateTrailerCount($filmId);
                $stat->updateWallpaperCount($filmId);

                $stat->updateAwardCount($toId);
                $stat->updatePosterCount($toId);
                $stat->updateFrameCount($toId);
                $stat->updateSoundtrackCount($toId);
                $stat->updateTrailerCount($toId);
                $stat->updateWallpaperCount($toId);

                $this->db->query("UPDATE `film` SET `status` = 'hide' WHERE `id` = {$filmId} LIMIT 1");

                return true;
            }
        } else {
            $this->error = self::ID_NOT_FOUND;
        }

        return false;
    }
    
    public function add()
    {
        $this->error = '';
        $this->insertedId = 0;
        $post = new PostBag();
        
        $imdbId = $post->fetch('imdbId');
        $name = $this->clearText($post->fetch('name_ru'));
        $year = $post->fetchInt('year');
        
        if (!empty($imdbId)) {
            $id_imdb = intval((new ImdbFilm())->getClearFilmId($imdbId));
            $result = $this->db->query("SELECT 1 FROM `film` WHERE `id_imdb` = {$id_imdb} LIMIT 1");
            if (0 < $result->fetch_assoc()) {
                $this->error = self::FILM_EXIST;
                return false;
            }
            
            $parser = new Parser(false);
            $parser->imdb_film($imdbId);
            $parser->log($this->db);
            if (empty($parser->error())) {
                $data = $parser->data();

                $name_origin = $this->db->real_escape_string($this->clearText($data['original_name']));

                if (empty($name_origin)) {
                    $this->error = 'Empty name';
                    return false;
                }

                $year = intval($data['year']);
                if (1850 > $year || 2100 < $year) {
                    $year = 0;
                }

                $year_finish = intval($data['yearFinish']);
                if (0 == $year_finish) {
                    $year_finish = 'null';
                } else {
                    $year_finish = '\'' . $year_finish . '\'';
                }

                $type = '';
                if (false !== stripos($data['type'], 'series')) {
                    $type = 'series';
                }

                $runtime = intval($data['duration']);

                $limit_us = '';
                if (in_array($data['rate_mpaa'], ['G', 'PG', 'PG-13', 'R', 'NC-17'])) {
                    $limit_us = $data['rate_mpaa'];
                }

                $genre = [];
                foreach ($data['genre'] as $val) {
                    foreach (Genre::EN as $code => $item) {
                        if (false !== stripos($val, $item)) {
                            $genre[] = $code;
                            break;
                        }
                    }
                }
                $genre = implode(',', $genre);

                $country = [];
                foreach ($data['country'] as $val) {
                    foreach (Country::EN as $code => $item) {
                        if (false !== stripos($val, $item)) {
                            $country[] = $code;
                            break;
                        }
                    }
                }
                $country = implode(',', $country);

                if (empty($data['release_world'])) {
                    $premiere_world = 'null';
                } else {
                    $premiere_world = explode('.', $data['release_world']);
                    $premiere_world = $premiere_world[2] . '-' . $premiere_world[1] . '-' . $premiere_world[0];
                    $premiere_world = '\'' . $premiere_world . '\'';
                }

                if (empty($data['release_usa'])) {
                    $premiere_usa = 'null';
                } else {
                    $premiere_usa = explode('.', $data['release_usa']);
                    $premiere_usa = $premiere_usa[2] . '-' . $premiere_usa[1] . '-' . $premiere_usa[0];
                    $premiere_usa = '\'' . $premiere_usa . '\'';
                }

                if (empty($data['release_ru'])) {
                    $premiere_ru = 'null';
                } else {
                    $premiere_ru = explode('.', $data['release_ru']);
                    $premiere_ru = $premiere_ru[2] . '-' . $premiere_ru[1] . '-' . $premiere_ru[0];
                    $premiere_ru = '\'' . $premiere_ru . '\'';
                }

                $budget = floatval($data['budget']);

                $series_count = intval($data['episode']);

                $imdbId = intval($data['imdbId']);

                $image = $data['image'];

                $query = "INSERT INTO `film` SET
                    `s` = 0,
                    `image` = '',
                    `status` = 'new',
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '',
                    `search` = '',
                    `note` = '',
                    `country` = '{$country}',
                    `year` = {$year},
                    `genre` = '{$genre}',
                    `type` = '{$type}',
                    `arthouse` = 'no',
                    `runtime` = {$runtime},
                    `premiere_world` = {$premiere_world},
                    `premiere_ru` = {$premiere_ru},
                    `premiere_usa` = {$premiere_usa},
                    `limit_us` = '{$limit_us}',
                    `limit_ru` = '',
                    `budget` = '{$budget}',
                    `season_count` = 0,
                    `series_count` = {$series_count},
                    `year_finish` = {$year_finish},
                    `review` = 0,
                    `preview` = '',
                    `fact` = '',
                    `id_imdb` = {$imdbId},
                    `id_kt` = 0,
                    `id_rk` = 0,
                    `id_kp` = 0,
                    `weight` = 0
                ";

                $this->db->query($query);
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }
                $this->insertedId = $this->db->insert_id;
                $filmId = intval($this->insertedId);

                if (0 < $filmId) {
                    /**
                     * Country and genre.
                     */
                    $country = explode(',', $country);
                    foreach ($country as $code) {
                        $this->db->query("INSERT INTO `film_country` SET `filmId` = {$filmId}, `country` = '{$code}'");
                    }

                    $genre = explode(',', $genre);
                    foreach ($genre as $code) {
                        $this->db->query("INSERT INTO `film_genre` SET `filmId` = {$filmId}, `genre` = '{$code}'");
                    }

                    /**
                     * Image.
                     */
                    if (!empty($image)) {
                        $image = explode('.jpg', $image);
                        $image = explode('.', $image[0]);
                        unset($image[count($image) - 1]);
                        $image = implode('.', $image);
                        if (!empty($image)) {
                            $image .= '.jpg';
                            $static = new StaticS();
                            $imageData = json_decode($static->upload('film', '2400x2400', $filmId, $image), true);

                            if (isset($imageData['ex'])) {
                                switch ($imageData['ex']) {
                                    case 'png':
                                    case 'jpeg':
                                    case 'gif':
                                        break;
                                    default:
                                        $imageData['ex'] = '';
                                }
                                if (!empty($imageData['ex'])) {
                                    $s = intval(Server::STATIC_CURRENT);
                                    $this->db->query("UPDATE `film` SET `s` = {$s}, `image` = '{$imageData['ex']}' WHERE `id` = {$filmId} LIMIT 1");
                                }
                            }
                        }
                    }

                    /**
                     * Cast.
                     */
                    foreach ($data['cast'] as $k => $cast) {
                        $order = $k + 1;

                        $personId = intval($cast[0]);
                        if (0 < $personId) {
                            $result = $this->db->query("SELECT `id` FROM `person` WHERE `id_imdb` = {$personId} LIMIT 1");
                            if ($row = $result->fetch_assoc()) {
                                $personId = $row['id'];
                            } else {
                                $name = $this->db->real_escape_string($this->clearText($cast[1]));
                                if (empty($name)) {
                                    continue;
                                }
                                $query = "INSERT INTO `person` SET 
                                            `s` = 0,
                                            `image` = '',
                                            `status` = 'new',
                                            `name_origin` = '{$name}',
                                            `name_ru` = '',
                                            `search` = '',
                                            `sex` = '',
                                            `origin` = '',
                                            `actor` = 'yes',
                                            `director` = 'no',
                                            `screenwriter` = 'no',
                                            `producer` = 'no',
                                            `composer` = 'no',
                                            `operator` = 'no',
                                            `birthday` = null,
                                            `death` = null,
                                            `birthplace_en` = '',
                                            `birthplace_ru` = '',
                                            `height` = 0,
                                            `education` = '',
                                            `theater` = '',
                                            `award` = '',
                                            `info` = '',
                                            `biography` = '',
                                            `award_list` = '',
                                            `match` = 0,
                                            `id_imdb` = {$personId},
                                            `id_kp` = 0,
                                            `id_kt` = 0,
                                            `id_rk` = 0,
                                            `note` = '',
                                            `weight` = 0,
                                            `day` = 0,
                                            `month` = 0
                                            ";
                                $this->db->query($query);
                                $personId = $this->db->insert_id;
                                if (!empty($this->db->error)) {
                                    $this->error = $this->db->error;
                                    return false;
                                }
                            }

                            $role_en = $this->db->real_escape_string($this->clearText($cast[2]));

                            $voice = 'no';
                            $self = 'no';
                            $uncredited = 'no';
                            $episodes = intval($cast[3]);
                            $year = $this->db->real_escape_string($this->clearText($cast[4]));

                            if (1 == $cast[5]) {
                                $voice = 'yes';
                            }
                            if (1 == $cast[6]) {
                                $uncredited = 'yes';
                            }
                            if (1 == $cast[7]) {
                                $self = 'yes';
                            }

                            $this->db->query("INSERT INTO `film_cast` SET 
                                      `filmId` = {$filmId}, `personId` = {$personId}, `role_ru` = '',
                                      `role_en` = '{$role_en}', `note` = '', `voice` = '{$voice}', `self` = '{$self}',
                                      `uncredited` = '{$uncredited}', `episodes` = {$episodes}, `year` = '{$year}', `source` = 'imdb', `order` = {$order}
                                      ");
                        }
                    }

                    /**
                     * Crew.
                     */
                    foreach ($data['crew'] as $type => $crewList) {
                        if (!in_array($type, ['Режиссер', 'Сценарист', 'Продюсер', 'Композитор', 'Оператор'])) {
                            continue;
                        }
                        foreach ($crewList as $k => $crew) {
                            $order = $k + 1;

                            $personId = intval($crew[0]);
                            if (0 < $personId) {
                                $result = $this->db->query("SELECT `id` FROM `person` WHERE `id_imdb` = {$personId} LIMIT 1");
                                if ($row = $result->fetch_assoc()) {
                                    $personId = $row['id'];
                                } else {
                                    $name = $this->db->real_escape_string($this->clearText($crew[1]));
                                    if (empty($name)) {
                                        continue;
                                    }
                                    $director = 'no';
                                    if ('Режиссер' == $type) {
                                        $director = 'yes';
                                    }
                                    $screenwriter = 'no';
                                    if ('Сценарист' == $type) {
                                        $screenwriter = 'yes';
                                    }
                                    $producer = 'no';
                                    if ('Продюсер' == $type) {
                                        $producer = 'yes';
                                    }
                                    $composer = 'no';
                                    if ('Композитор' == $type) {
                                        $composer = 'yes';
                                    }
                                    $operator = 'no';
                                    if ('Оператор' == $type) {
                                        $operator = 'yes';
                                    }
                                    $query = "INSERT INTO `person` SET 
                                            `s` = 0,
                                            `image` = '',
                                            `status` = 'new',
                                            `name_origin` = '{$name}',
                                            `name_ru` = '',
                                            `search` = '',
                                            `sex` = '',
                                            `origin` = '',
                                            `actor` = 'no',
                                            `director` = '{$director}',
                                            `screenwriter` = '{$screenwriter}',
                                            `producer` = '{$producer}',
                                            `composer` = '{$composer}',
                                            `operator` = '{$operator}',
                                            `birthday` = null,
                                            `death` = null,
                                            `birthplace_en` = '',
                                            `birthplace_ru` = '',
                                            `height` = 0,
                                            `education` = '',
                                            `theater` = '',
                                            `award` = '',
                                            `info` = '',
                                            `biography` = '',
                                            `award_list` = '',
                                            `match` = 0,
                                            `id_imdb` = {$personId},
                                            `id_kp` = 0,
                                            `id_kt` = 0,
                                            `id_rk` = 0,
                                            `note` = '',
                                            `weight` = 0,
                                            `day` = 0,
                                            `month` = 0
                                            ";
                                    $this->db->query($query);
                                    $personId = $this->db->insert_id;
                                    if (!empty($this->db->error)) {
                                        $this->error = $this->db->error;
                                        return false;
                                    }
                                }

                                $description = $this->db->real_escape_string($this->clearText($crew[2][0] ?? ''));
                                $episodes = intval($crew[2][1] ?? '');
                                $year = $this->db->real_escape_string($this->clearText($crew[2][2] ?? ''));

                                $this->db->query("INSERT INTO `film_crew` SET 
                                      `filmId` = {$filmId}, `personId` = {$personId}, `type` = '{$type}',
                                      `description` = '{$description}', `episodes` = {$episodes}, `year` = '{$year}', `source` = 'imdb', `order` = {$order}
                                      ");
                            }
                        }
                    }

                    $stat = new Stat($this->db);
                    $stat->update($filmId);

                    $this->db->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'film' LIMIT 1");
                }
            }
        } else {
            if (empty($name)) {
                $this->error = 'Empty name';
                return false;
            }
            $name_ru = $this->db->real_escape_string($name);

            if (1850 > $year || 2100 < $year) {
                $year = 0;
            }

            $query = "INSERT INTO `film` SET
                `s` = 0,
                `image` = '',
                `status` = 'new',
                `name_origin` = '',
                `name_ru` = '{$name_ru}',
                `search` = '',
                `note` = '',
                `country` = '',
                `year` = {$year},
                `genre` = '',
                `type` = '',
                `arthouse` = 'no',
                `runtime` = 0,
                `premiere_world` = NULL,
                `premiere_ru` = NULL,
                `premiere_usa` = NULL,
                `limit_us` = '',
                `limit_ru` = '',
                `budget` = 0,
                `season_count` = 0,
                `series_count` = 0,
                `year_finish` = NULL,
                `review` = 0,
                `preview` = '',
                `fact` = '',
                `id_imdb` = 0,
                `id_kt` = 0,
                `id_rk` = 0,
                `id_kp` = 0,
                `weight` = 0
            ";
            $this->db->query($query);
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
            $this->insertedId = $this->db->insert_id;

            $this->db->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'film' LIMIT 1");
        }

        return true;
    }
    
    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $status = $post->fetchEscape('status', $this->db);
        $name_origin = $post->fetchEscape('name_origin', $this->db);
        $name_ru = $post->fetchEscape('name_ru', $this->db);
        $search = $post->fetchEscape('search', $this->db);
        $country = $post->fetchEscape('country', $this->db);
        $year = $post->fetchInt('year');
        $genre = $post->fetchEscape('genre', $this->db);
        $type = $post->fetchEscape('type', $this->db);
        $arthouse = $post->fetchEscape('arthouse', $this->db);
        $runtime = $post->fetchInt('runtime');

        $premiere_world = $post->fetch('premiere_world');
        if (empty($premiere_world)) {
            $premiere_world = 'null';
        } else {
            $premiere_world = explode('.', $premiere_world);
            $premiere_world[2] = $premiere_world[2] ?? '';
            $premiere_world[1] = $premiere_world[1] ?? '';
            $premiere_world[0] = $premiere_world[0] ?? '';
            $premiere_world  = $premiere_world[2] . '-' . $premiere_world[1] . '-' . $premiere_world[0];
            $premiere_world = '\'' . $premiere_world . '\'';
        }

        $premiere_ru = $post->fetch('premiere_ru');
        if (empty($premiere_ru)) {
            $premiere_ru = 'null';
        } else {
            $premiere_ru = explode('.', $premiere_ru);
            $premiere_ru[2] = $premiere_ru[2] ?? '';
            $premiere_ru[1] = $premiere_ru[1] ?? '';
            $premiere_ru[0] = $premiere_ru[0] ?? '';
            $premiere_ru  = $premiere_ru[2] . '-' . $premiere_ru[1] . '-' . $premiere_ru[0];
            $premiere_ru = '\'' . $premiere_ru . '\'';
        }

        $premiere_usa = $post->fetch('premiere_usa');
        if (empty($premiere_usa)) {
            $premiere_usa = 'null';
        } else {
            $premiere_usa = explode('.', $premiere_usa);
            $premiere_usa[2] = $premiere_usa[2] ?? '';
            $premiere_usa[1] = $premiere_usa[1] ?? '';
            $premiere_usa[0] = $premiere_usa[0] ?? '';
            $premiere_usa  = $premiere_usa[2] . '-' . $premiere_usa[1] . '-' . $premiere_usa[0];
            $premiere_usa = '\'' . $premiere_usa . '\'';
        }

        $limit_us = $post->fetchEscape('limit_us', $this->db);
        $limit_ru = $post->fetchEscape('limit_ru', $this->db);

        $budget = $post->fetch('budget');
        $budget = str_replace(',', '.', $budget);
        $budget = floatval($budget);

        $season_count = $post->fetchInt('season_count');
        $series_count = $post->fetchInt('series_count');
        $year_finish = $post->fetchEscape('year_finish', $this->db);
        if (empty($year_finish)) {
            $year_finish = 'null';
        } else {
            $year_finish = "'{$year_finish}'";
        }
        $review = $post->fetchInt('review');
        $preview = $post->fetchEscape('preview', $this->db);
        $fact = $post->fetchEscape('fact', $this->db);

        $this->db->query("UPDATE `film` SET
                          `status` = '{$status}',
                          `name_origin` = '{$name_origin}',
                          `name_ru` = '{$name_ru}',
                          `search` = '{$search}',
                          `country` = '{$country}',
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
                          `review` = {$review},
                          `preview` = '{$preview}',
                          `fact` = '{$fact}'
                          WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $filmId = $id;

        /**
         * Country.
         */
        $list = explode(',', $country);

        $currentList = [];
        $result = $this->db->query("SELECT `id`, `country` FROM `film_country` WHERE `filmId` = {$filmId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $currentList[$row['country']] = $row['id'];
        }

        // Delete
        foreach ($currentList as $key => $id) {
            if (!in_array($key, $list)) {
                $id = intval($id);
                if (0 < $id) {
                    $this->db->query("DELETE FROM `film_country` WHERE `id` = {$id} LIMIT 1");
                }
            }
        }

        // Add
        foreach ($list as $country) {
            if (!isset($currentList[$country])) {
                $country = $this->db->real_escape_string($country);
                if (!empty($country)) {
                    $this->db->query("INSERT INTO `film_country` SET `filmId` = {$filmId}, `country` = '{$country}'");
                }
            }
        }

        /**
         * Genre.
         */
        $list = explode(',', $genre);

        $currentList = [];
        $result = $this->db->query("SELECT `id`, `genre` FROM `film_genre` WHERE `filmId` = {$filmId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $currentList[$row['genre']] = $row['id'];
        }

        // Delete
        foreach ($currentList as $key => $id) {
            if (!in_array($key, $list)) {
                $id = intval($id);
                if (0 < $id) {
                    $this->db->query("DELETE FROM `film_genre` WHERE `id` = {$id} LIMIT 1");
                }
            }
        }

        // Add
        foreach ($list as $genre) {
            if (!isset($currentList[$genre])) {
                $genre = $this->db->real_escape_string($genre);
                if (!empty($genre)) {
                    $this->db->query("INSERT INTO `film_genre` SET `filmId` = {$filmId}, `genre` = '{$genre}'");
                }
            }
        }


        /**
         * Company rel.
         */
        $list = [];
        for ($i = 1; $i < 100; $i++) {
            if ($post->has('concern_type_' . $i) && $post->has('concern_name_' . $i)) {
                $name = $this->db->real_escape_string($post->fetch('concern_name_' . $i));
                $result = $this->db->query("SELECT `id` FROM `company` WHERE `name` = '{$name}' LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $key = md5($row['id'] . $post->fetch('concern_type_' . $i));
                    $list[$key] = [$row['id'], $post->fetch('concern_type_' . $i)];
                }
            }
        }

        $currentList = [];
        $result = $this->db->query("SELECT `id`, `companyId`, `type` FROM `film_company_rel` WHERE `filmId` = {$filmId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $key = md5($row['companyId'] . $row['type']);
            $currentList[$key] = $row['id'];
        }

        // Delete
        foreach ($currentList as $key => $id) {
            if (!isset($list[$key])) {
                $id = intval($id);
                if (0 < $id) {
                    $this->db->query("DELETE FROM `film_company_rel` WHERE `id` = {$id} LIMIT 1");
                }
            }
        }

        // Add
        foreach ($list as $key => $item) {
            if (!isset($currentList[$key])) {
                $companyId = intval($item[0] ?? 0);
                $type = $this->db->real_escape_string($item[1] ?? '');

                if (0 < $companyId && !empty($type)) {
                    $this->db->query("INSERT INTO `film_company_rel` SET `filmId` = {$filmId}, `companyId` = {$companyId}, `type` = '{$type}'");
                }
            }
        }

        /**
         * Letters.
         */
        $articleList = ["the", "a", "an", "der", "ein", "die", "eine", "das", "le", "un", "la", "une", "el", "una", "il"];

        $string = $name_ru;
        foreach ($articleList as $article) {
            $string = str_ireplace($article . ' ', '', $string);
        }
        $string = preg_replace("/[^A-Za-zА-Яа-яёЁ]/u", ' ', $string);
        if (!empty($string)) {
            $letter = trim(mb_substr($string, 0, 1, 'UTF-8'));
            $result = $this->db->query("SELECT `id`, `letter` FROM `film_letter` WHERE `filmId` = {$filmId} AND `lang` = 'ru'");
            $insertLetter = false;
            if ($row = $result->fetch_assoc()) {
                if (mb_strtolower($row['letter'], 'UTF-8') != mb_strtolower($letter, 'UTF-8')) {
                    $this->db->query("DELETE FROM `film_letter` WHERE `id` = {$row['id']} LIMIT 1");
                    $insertLetter = true;
                }
            } else {
                $insertLetter = true;
            }
            if ($insertLetter) {
                $letter = $this->db->real_escape_string($letter);
                $this->db->query("INSERT INTO `film_letter` SET `filmId` = {$filmId}, `lang` = 'ru', `letter` = '{$letter}'");
            }
        }

        $string = $name_origin;
        foreach ($articleList as $article) {
            $string = str_ireplace($article . ' ', '', $string);
        }
        $string = preg_replace("/[^A-Za-zА-Яа-яёЁ]/u", ' ', $string);
        if (!empty($string)) {
            $letter = trim(mb_substr($string, 0, 1, 'UTF-8'));
            $result = $this->db->query("SELECT `id`, `letter` FROM `film_letter` WHERE `filmId` = {$filmId} AND `lang` = 'foreign'");
            $insertLetter = false;
            if ($row = $result->fetch_assoc()) {
                if (mb_strtolower($row['letter'], 'UTF-8') != mb_strtolower($letter, 'UTF-8')) {
                    $this->db->query("DELETE FROM `film_letter` WHERE `id` = {$row['id']} LIMIT 1");
                    $insertLetter = true;
                }
            } else {
                $insertLetter = true;
            }
            if ($insertLetter) {
                $letter = $this->db->real_escape_string($letter);
                $this->db->query("INSERT INTO `film_letter` SET `filmId` = {$filmId}, `lang` = 'foreign', `letter` = '{$letter}'");
            }
        }

        if ('show' == $status) {
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('film:' . $filmId)) {
                $redis->delete('film:' . $filmId);
                if ($redis->exists('film:' . $filmId . ':min')) {
                    $redis->delete('film:' . $filmId . ':min');
                }
                if ($redis->exists('film:' . $filmId . ':stat')) {
                    $redis->delete('film:' . $filmId . ':stat');
                }
            }
        }
        
        $stat = new Stat($this->db);
        $stat->update($filmId);
        
        return true;
    }
    
    /**
     * @return bool
     */
    public function editSys()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');

        $id_imdb = $post->fetchInt('id_imdb');
        $id_kp = $post->fetchInt('id_kp');
        $id_kt = $post->fetchInt('id_kt');
        $id_rk = $post->fetchInt('id_rk');

        $check = $post->fetchEscape('check', $this->db);
        $note = $this->db->real_escape_string($this->clearText($post->fetch('note')));

        $query = "UPDATE `film` SET 
                    `id` = {$id},
                    `id_imdb` = {$id_imdb},
                    `id_kp` = {$id_kp},
                    `id_kt` = {$id_kt},
                    `id_rk` = {$id_rk},
                    `note` = '{$note}',
                    `check` = '{$check}'
                    WHERE `id` = {$id} LIMIT 1
                    ";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('film:' . $id)) {
            $redis->delete('film:' . $id);
        }

        return true;
    }

    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT t1.*, t2.`rate`, t2.`rate_count`, t2.`imdb`, t2.`imdb_count`, t2.`kp`, t2.`kp_count`, 
                                    t2.`poster`, t2.`frame`, t2.`wallpaper`, t2.`trailer`, t2.`soundtrack`, t2.`award` 
                                    FROM `film` as `t1`
                                    LEFT JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId`
                                    WHERE t1.`id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * Get json data for DataTable plugin. List of companies.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

        $year = $get->fetchInt('year');
        if (1850 > $year || 2100 < $year) {
            $year = 0;
        }

        $useSphinx = false;
        $search = $get->fetch('search');
        if (!preg_match('/^[1-9][0-9]*$/', $search['value'])) {
            $search = trim($search['value']);
            if (!empty($search)) {
                $useSphinx = true;
            }
        } else {
            $search = intval($search['value']);
        }

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'id';
                break;
            case 2:
                $order = 'year';
                break;
            default:
                $order = 'id';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        $total = 0;
        if ($useSphinx) {
            $search = explode(' ', $search);
            $search = array_map(function($search){
                return $search . '*';
            }, $search);
            $search = $this->db->real_escape_string(implode(' ', $search));

            $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$search}') LIMIT 50 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }

            $total = $map['total'];

            $idList = implode(',', $idList);
            if (empty($idList)) {
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year` FROM `film` WHERE `id` = 0";
            } else {
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year` FROM `film` WHERE 1 ";
                $query .= " AND `id` IN ($idList)";
                if (0 < $year) {
                    $query .= " AND `year` = ($year)";
                }

                $query .= " ORDER BY `{$order}` {$direction}";
            }
        } else {
            $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year` FROM `film` WHERE 1 ";
            if (!empty($search)) {
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year` FROM (
                                  SELECT * FROM `film` WHERE `id` = {$search}
                                  UNION SELECT * FROM `film` WHERE `id_imdb` = {$search}
                                  UNION SELECT * FROM `film` WHERE `id_kp` = {$search}
                                  UNION SELECT * FROM `film` WHERE `id_kt` = {$search}
                                  UNION SELECT * FROM `film` WHERE `id_rk` = {$search}) T WHERE 1 ";
            }
            if (0 < $year) {
                $query .= " AND `year` = ($year)";
            }
        }

        /**
         * Total.
         */
        if (!$useSphinx) {
            $total = 0;
            if (!empty($search)) {
                $result = $this->db->query(str_replace('`id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year`', 'COUNT(*) as `count`', $query));
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                }
            } else {
                $result = $this->db->query("SELECT `count` FROM `count` WHERE `key` = 'film'");
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                } else {
                    $result = $this->db->query(str_replace('`id`, `s`, `image`, `status`, `name_origin`, `name_ru`, `year`', 'COUNT(*) as `count`', $query));
                    if ($row = $result->fetch_assoc()) {
                        $total = $row['count'];
                    }
                }
            }

            $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";
        }

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            if (0 == $row['year']) {
                $row['year'] = '';
            }
            $item[0] = $row['id'];
            $item[1] = '';
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $path = str_split($iName);
                $item[1] = Server::STATIC[$row['s']] . '/image' . Path::FILM . $path[0] . '/' . $path[1] . $path[2] . '/' . $iName . '.88.130.' . $row['image'];
            } else {
                $item[1] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            $item[2] = $row['year'];
            $item[3] = $row['name_ru'] . '<br />' . $row['name_origin'];
            $item[4] = $row['status'];

            $data[] = $item;
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];

        return json_encode($data);
    }



    public function delete()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $static = new StaticS();
        $static->delete('film', 0, $id, 'jpeg');

        $this->db->query("DELETE FROM `film` WHERE `id` = {$id} LIMIT 1");
        $this->db->query("DELETE FROM `film_cast` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_company_rel` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_country` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_crew` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_letter` WHERE `filmId` = {$id}");

        $result = $this->mysql()->query("SELECT `id`, `s` FROM `film_frame` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $static->deleteList('film_frame', $row['s'], [$row['id']]);
            $this->db->query("DELETE FROM `film_frame_person` WHERE `frameId` = {$row['id']}");
        }
        $this->db->query("DELETE FROM `film_frame` WHERE `filmId` = {$id}");
        
        $this->db->query("DELETE FROM `film_genre` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_gross` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `film_last_rate_update` WHERE `filmId` = {$id}");

        $result = $this->mysql()->query("SELECT `id`, `s` FROM `film_poster` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $static->deleteList('film_poster', $row['s'], [$row['id']]);
        }
        $this->db->query("DELETE FROM `film_poster` WHERE `filmId` = {$id}");
        
        $soundtrack = new Soundtrack($this->db);
        $result = $this->mysql()->query("SELECT `id` FROM `film_sound_dir` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $soundtrack->deleteDir($row['id']);
        }

        $result = $this->db->query("SELECT `id` FROM `film_wallpaper` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $this->db->query("DELETE FROM `film_wallpaper_person` WHERE `wallpaperId` = {$row['id']}");
        }
        $result = $this->mysql()->query("SELECT `id`, `s` FROM `film_wallpaper` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $static->deleteList('film_wallpaper', $row['s'], [$row['id']]);
        }
        $this->db->query("DELETE FROM `film_wallpaper` WHERE `filmId` = {$id}");

        $comment = new Comment($this->db);
        $result = $this->db->query("SELECT `id` FROM `film_review` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $result = $this->db->query("SELECT `id` FROM `comment` WHERE `relatedId` = {$row['id']} AND `type` = 'film' AND `parent` = 0");
            while ($row = $result->fetch_assoc()) {
                $comment->delete($row['id']);
            }

            $this->db->query("DELETE FROM `film_review_stat` WHERE `reviewId` = {$row['id']}");
            $this->db->query("DELETE FROM `film_review_vote` WHERE `reviewId` = {$row['id']}");
        }
        $this->db->query("DELETE FROM `film_review` WHERE `filmId` = {$id}");

        $video = new Video($this->db);
        $result = $this->db->query("SELECT `id`, `m` FROM `trailer` WHERE `filmId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $video->deleteVideo($row['m'], $row['id'], '480');
            $video->deleteVideo($row['m'], $row['id'], '720');
            $video->deleteVideo($row['m'], $row['id'], '1080');
            $video->delete($row['id']);
        }

        $this->db->query("DELETE FROM `film_stat` WHERE `filmId` = {$id}");

        $this->db->query("DELETE FROM `user_folder_film` WHERE `filmId` = {$id}");
        $this->db->query("DELETE FROM `moderate` WHERE `type` = 'film' AND `relatedId` = {$id}");
        $this->db->query("UPDATE `tv_program` SET `filmId` = 0 WHERE `filmId` = {$id}");
        $this->db->query("UPDATE `film_boxoffice` SET `filmId` = 0 WHERE `filmId` = {$id}");
        $this->db->query("UPDATE `news_link` SET `filmId` = 0 WHERE `filmId` = {$id}");


        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('film:' . $id)) {
            $redis->delete('film:' . $id);
            if ($redis->exists('film:' . $id . ':min')) {
                $redis->delete('film:' . $id . ':min');
            }
            if ($redis->exists('film:' . $id . ':stat')) {
                $redis->delete('film:' . $id . ':stat');
            }
        }

        return true;
    }


    private $insertedId;
}