<?php
namespace Kinomania\Control\Person;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Parser\Person\ImdbPerson;
use Kinomania\System\Text\TText;

class Person extends DB
{
    use TRepository;
    use TText;

    const PERSON_EXIST = 'PERSON_EXIST';
    const ID_NOT_FOUND = 'ID_NOT_FOUND';

    public function merge()
    {
        $this->error = '';
        $post = new PostBag();
        $personId = $post->fetchInt('personId');
        $toId = $post->fetchInt('toId');

        $result = $this->db->query("SELECT * FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $result = $this->db->query("SELECT * FROM `person` WHERE `id` = {$toId} LIMIT 1");
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
                $sex = $row2['sex'];
                if (empty($sex)) {
                    $sex = $row['sex'];
                }
                $origin = $row2['origin'];
                if (empty($origin)) {
                    $origin = $row['origin'];
                }
                $actor = $row2['actor'];
                if ('no' == $actor) {
                    $actor = $row['actor'];
                }
                $director = $row2['director'];
                if ('no' == $director) {
                    $director = $row['director'];
                }
                $screenwriter = $row2['screenwriter'];
                if ('no' == $screenwriter) {
                    $screenwriter = $row['screenwriter'];
                }
                $producer = $row2['producer'];
                if ('no' == $producer) {
                    $producer = $row['producer'];
                }
                $composer = $row2['composer'];
                if ('no' == $composer) {
                    $composer = $row['composer'];
                }
                $operator = $row2['operator'];
                if ('no' == $operator) {
                    $operator = $row['operator'];
                }
                $birthday = $row2['birthday'];
                if (empty($birthday)) {
                    $birthday = $row['birthday'];
                }
                if (empty($birthday)) {
                    $birthday = 'null';
                } else {
                    $birthday = '\'' . $birthday . '\'';
                }
                $death = $row2['death'];
                if (empty($death)) {
                    $death = $row['death'];
                }
                if (empty($death)) {
                    $death = 'null';
                } else {
                    $death = '\'' . $death . '\'';
                }
                $birthplace_en = $row2['birthplace_en'];
                if (empty($birthplace_en)) {
                    $birthplace_en = $row['birthplace_en'];
                }
                $birthplace_ru = $row2['birthplace_ru'];
                if (empty($birthplace_ru)) {
                    $birthplace_ru = $row['birthplace_ru'];
                }
                $height = $row2['height'];
                if (empty($height)) {
                    $height = $row['height'];
                }
                $education = $row2['education'];
                if (empty($education)) {
                    $education = $row['education'];
                }
                $theater = $row2['theater'];
                if (empty($theater)) {
                    $theater = $row['theater'];
                }
                $award = $row2['award'];
                if (empty($award)) {
                    $award = $row['award'];
                }
                $info = $row2['info'];
                if (empty($info)) {
                    $info = $row['info'];
                }
                $biography = $row2['biography'];
                if (empty($biography)) {
                    $biography = $row['biography'];
                }
                $award_list = $row2['award_list'];
                if (empty($award_list)) {
                    $award_list = $row['award_list'];
                }
                $match = $row2['match'];
                if (empty($match)) {
                    $match = $row['match'];
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
                $sex = $this->db->real_escape_string($sex);
                $origin = $this->db->real_escape_string($origin);
                $actor = $this->db->real_escape_string($actor);
                $director = $this->db->real_escape_string($director);
                $screenwriter = $this->db->real_escape_string($screenwriter);
                $producer = $this->db->real_escape_string($producer);
                $composer = $this->db->real_escape_string($composer);
                $operator = $this->db->real_escape_string($operator);

                $birthplace_en = $this->db->real_escape_string($birthplace_en);
                $birthplace_ru = $this->db->real_escape_string($birthplace_ru);
                $height = $this->db->real_escape_string($height);
                $education = $this->db->real_escape_string($education);
                $theater = $this->db->real_escape_string($theater);
                $award = $this->db->real_escape_string($award);
                $info = $this->db->real_escape_string($info);
                $biography = $this->db->real_escape_string($biography);
                $award_list = $this->db->real_escape_string($award_list);
                $match = $this->db->real_escape_string($match);
                $id_imdb = $this->db->real_escape_string($id_imdb);
                $id_kp = $this->db->real_escape_string($id_kp);
                $id_kt = $this->db->real_escape_string($id_kt);
                $id_rk = $this->db->real_escape_string($id_rk);
                $note = $this->db->real_escape_string($note);
                $weight = $this->db->real_escape_string($weight);
                $check = $this->db->real_escape_string($check);

                $this->db->query("UPDATE `person` SET
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
                  `match` = '{$match}',
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
                $result = $this->db->query("SELECT `awardId`, `year`, `nominationId`, `filmId`, `win` FROM `awards_set` WHERE `personId` = {$personId}");
                while ($row = $result->fetch_assoc()) {
                    $result2 = $this->db->query("SELECT `id` FROM `awards_set` WHERE `awardId` = {$row['awardId']} AND `year` = '{$row['year']}' AND `nominationId` = {$row['nominationId']} AND `win` = '{$row['win']}' AND `filmId` = {$toId} LIMIT 1");
                    if (!$row2 = $result2->fetch_assoc()) {
                        $this->db->query("INSERT INTO `awards_set` SET
                                          `awardId` = {$row['awardId']},
                                          `year` = '{$row['year']}',
                                          `nominationId` = {$row['nominationId']},
                                          `filmId` = {$row['filmId']},
                                          `personId` = {$toId},
                                          `win` = '{$row['win']}'
                                         ");
                    }
                }

                $this->db->query("UPDATE `comment` SET `relatedId` = {$toId} WHERE `relatedId` = {$personId} AND `type` = 'person'");
                $this->db->query("UPDATE `film_cast` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `film_crew` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `film_frame_person` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `film_wallpaper_person` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_dance` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_ethnic` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_language` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_music_instrument` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_sing` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_casting_sport` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_photo` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_review` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `person_wallpaper` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `moderate` SET `relatedId` = {$toId} WHERE `relatedId` = {$personId} AND `type` = 'person'");
                $this->db->query("UPDATE `news_link` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `trailer_person` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `user_folder_person` SET `personId` = {$toId} WHERE `personId` = {$personId}");
                $this->db->query("UPDATE `tv_program_person` SET `personId` = {$toId} WHERE `personId` = {$personId}");

                $stat = new Stat($this->db);
                $stat->updateWallpaperCount($personId);
                $stat->updatePhotoCount($personId);
                $stat->updateFrameCount($personId);
                $stat->updateAwardCount($personId);
                $stat->updateNewsCount($personId);
                $stat->updateVideoCount($personId);
                
                $stat->updateWallpaperCount($toId);
                $stat->updatePhotoCount($toId);
                $stat->updateFrameCount($toId);
                $stat->updateAwardCount($toId);
                $stat->updateNewsCount($toId);
                $stat->updateVideoCount($toId);

                $this->db->query("UPDATE `person` SET `status` = 'hide' WHERE `id` = {$personId} LIMIT 1");

                return true;
            }
        } else {
            $this->error = self::ID_NOT_FOUND;
        }

        return false;
    }

    /**
     * @return int
     */
    public function insertedId()
    {
        return $this->insertedId;
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
            $id_imdb = intval((new ImdbPerson())->getClearPersonId($imdbId));
            $result = $this->db->query("SELECT 1 FROM `person` WHERE `id_imdb` = {$id_imdb} LIMIT 1");
            if (0 < $result->fetch_assoc()) {
                $this->error = self::PERSON_EXIST;
                return false;
            }

            $parser = new Parser(false);
            $parser->imdb_person($imdbId);
            $parser->log($this->db);
            if (empty($parser->error())) {
                $data = $parser->data();

                $name_origin = $this->db->real_escape_string($this->clearText($data['name_original']));

                if (empty($name_origin)) {
                    $this->error = 'Empty name';
                    return false;
                }

                $sex = $data['sex'];

                $actor = 'no';
                if (0 < count($data['Actor'])) {
                    $actor = 'yes';
                }

                $director = 'no';
                if (0 < count($data['crew']['Режиссер'])) {
                    $director = 'yes';
                }

                $screenwriter = 'no';
                if (0 < count($data['crew']['Сценарист'])) {
                    $screenwriter = 'yes';
                }

                $producer = 'no';
                if (0 < count($data['crew']['Продюсер'])) {
                    $producer = 'yes';
                }

                $composer = 'no';
                if (0 < count($data['crew']['Композитор'])) {
                    $composer = 'yes';
                }

                $operator = 'no';
                if (0 < count($data['crew']['Оператор'])) {
                    $operator = 'yes';
                }

                $day = 0;
                $month = 0;
                if (empty($data['born'])) {
                    $birthday = 'null';
                } else {
                    $tempDate = explode('-', $data['born']);
                    $day = $tempDate[2] ?? 0;
                    $month = $tempDate[1] ?? 0;
                    $birthday = '\'' . $data['born'] . '\'';
                }

                if (empty($data['die'])) {
                    $death = 'null';
                } else {
                    $death = '\'' . $data['die'] . '\'';
                }

                $birthplace_en = $this->db->real_escape_string($this->clearText($data['place']));

                $height = intval($data['height']);

                $imdbId = intval($data['imdbId']);

                $image = $data['image'];

                $query = "INSERT INTO `person` SET
                    `s` = 0,
                    `image` = '',
                    `status` = 'new',
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '',
                    `search` = '',
                    `sex` = '{$sex}',
                    `origin` = '',
                    `actor` = '{$actor}',
                    `director` = '{$director}',
                    `screenwriter` = '{$screenwriter}',
                    `producer` = '{$producer}',
                    `composer` = '{$composer}',
                    `operator` = '{$operator}',
                    `birthday` = {$birthday},
                    `death` = {$death},
                    `birthplace_en` = '{$birthplace_en}',
                    `birthplace_ru` = '',
                    `height` = '{$height}',
                    `education` = '',
                    `theater` = '',
                    `award` = '',
                    `info` = '',
                    `biography` = '',
                    `award_list` = '',
                    `match` = 0,
                    `id_imdb` = {$imdbId},
                    `id_kt` = 0,
                    `id_rk` = 0,
                    `id_kp` = 0,
                    `note` = '',
                    `weight` = 0,
                    `day` = {$day},
                    `month` = {$month}
                ";

                $this->db->query($query);
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }
                $this->insertedId = $this->db->insert_id;
                $personId = intval($this->insertedId);

                if (0 < $personId) {
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
                            $imageData = json_decode($static->upload('person', '2400x2400', $personId, $image), true);

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
                                    $this->db->query("UPDATE `person` SET `s` = {$s}, `image` = '{$imageData['ex']}' WHERE `id` = {$personId} LIMIT 1");
                                }
                            }
                        }
                    }

                    /**
                     * Cast.
                     */
                    foreach ($data['Actor'] as $k => $cast) {
                        $order = $k + 1;

                        $filmId = intval($cast['id']);
                        if (0 < $filmId) {
                            $result = $this->db->query("SELECT `id`, `status` FROM `film` WHERE `id_imdb` = {$filmId} LIMIT 1");
                            if ($row = $result->fetch_assoc()) {
                                $filmId = $row['id'];
                            } else {
                                $name = $this->db->real_escape_string($this->clearText($cast['english_name']));
                                if (empty($name)) {
                                    continue;
                                }
                                $name_origin = '';
                                $name_ru = '';
                                if (preg_match('/[А-Яа-яЁё]/u', $name)) {
                                    $name_ru = $name;
                                } else {
                                    $name_origin = $name;
                                }

                                $year = explode('-', $cast['year']);
                                $year = trim($year[0]);
                                $year = intval($year);

                                $type = '';
                                if (false !== stripos($cast['type'], 'series')) {
                                    $type = 'series';
                                }

                                $query = "INSERT INTO `film` SET 
                                            `s` = 0,
                                            `image` = '',
                                            `status` = 'new',
                                            `name_origin` = '{$name_origin}',
                                            `name_ru` = '{$name_ru}',
                                            `search` = '',
                                            `note` = '',
                                            `country` = '',
                                            `year` = {$year},
                                            `genre` = '',
                                            `type` = '{$type}',
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
                                            `id_imdb` = {$filmId},
                                            `id_kt` = 0,
                                            `id_rk` = 0,
                                            `id_kp` = 0,
                                            `weight` = 0
                                            ";
                                $this->db->query($query);
                                $filmId = $this->db->insert_id;
                                if (!empty($this->db->error)) {
                                    $this->error = $this->db->error;
                                    return false;
                                }
                            }

                            $role_en = $this->db->real_escape_string($this->clearText($cast['characterName']));

                            $voice = 'no';
                            $self = 'no';
                            $uncredited = 'no';
                            $episodes = intval($cast['countOfEpisodes']);
                            $year = $this->db->real_escape_string($this->clearText($cast['year']));

                            if (1 == $cast['characterVoice']) {
                                $voice = 'yes';
                            }
                            if (1 == $cast['characterUncredited']) {
                                $uncredited = 'yes';
                            }
                            if (1 == $cast['self']) {
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

                            $filmId = intval($crew['id']);
                            if (0 < $filmId) {
                                $result = $this->db->query("SELECT `id` FROM `film` WHERE `id_imdb` = {$filmId} LIMIT 1");
                                if ($row = $result->fetch_assoc()) {
                                    $filmId = $row['id'];
                                } else {
                                    $name = $this->db->real_escape_string($this->clearText($crew['english_name']));
                                    if (empty($name)) {
                                        continue;
                                    }
                                    $name_origin = '';
                                    $name_ru = '';
                                    if (preg_match('/[А-Яа-яЁё]/u', $name)) {
                                        $name_ru = $name;
                                    } else {
                                        $name_origin = $name;
                                    }

                                    $year = explode('-', $crew['year']);
                                    $year = trim($year[0]);
                                    $year = intval($year);

                                    $type = '';
                                    if (false !== stripos($crew['type'], 'series')) {
                                        $type = 'series';
                                    }

                                    $query = "INSERT INTO `film` SET 
                                            `s` = 0,
                                            `image` = '',
                                            `status` = 'new',
                                            `name_origin` = '{$name_origin}',
                                            `name_ru` = '{$name_ru}',
                                            `search` = '',
                                            `note` = '',
                                            `country` = '',
                                            `year` = {$year},
                                            `genre` = '',
                                            `type` = '{$type}',
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
                                            `id_imdb` = {$filmId},
                                            `id_kt` = 0,
                                            `id_rk` = 0,
                                            `id_kp` = 0,
                                            `weight` = 0
                                            ";
                                    $this->db->query($query);
                                    $filmId = $this->db->insert_id;
                                    if (!empty($this->db->error)) {
                                        $this->error = $this->db->error;
                                        return false;
                                    }
                                }

                                $description = '';
                                $episodes = intval($crew['countOfEpisodes']);
                                $year = $this->db->real_escape_string($this->clearText($crew['year']));

                                $this->db->query("INSERT INTO `film_crew` SET 
                                      `filmId` = {$filmId}, `personId` = {$personId}, `type` = '{$type}',
                                      `description` = '{$description}', `episodes` = {$episodes}, `year` = '{$year}', `source` = 'imdb', `order` = {$order}
                                      ");
                            }
                        }
                    }

                    $stat = new Stat($this->db);
                    $stat->update($personId);

                    $this->db->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'person' LIMIT 1");
                }
            }
        } else {
            if (empty($name)) {
                $this->error = 'Empty name';
                return false;
            }
            $name_ru = $this->db->real_escape_string($name);

            $query = "INSERT INTO `person` SET
                    `s` = 0,
                    `image` = '',
                    `status` = 'new',
                    `name_origin` = '',
                    `name_ru` = '{$name_ru}',
                    `search` = '',
                    `sex` = '',
                    `origin` = '',
                    `actor` = 'no',
                    `director` = 'no',
                    `screenwriter` = 'no',
                    `producer` = 'no',
                    `composer` = 'no',
                    `operator` = 'no',
                    `birthday` = NULL,
                    `death` = NULL,
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
                    `id_imdb` = 0,
                    `id_kt` = 0,
                    `id_rk` = 0,
                    `id_kp` = 0,
                    `note` = '',
                    `weight` = 0,
                    `day` = 0,
                    `month` = 0
                ";
            $this->db->query($query);
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }
            $this->insertedId = $this->db->insert_id;

            $this->db->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'person' LIMIT 1");
        }

        return true;
    }

    /**
     * @return bool
     */
    public function updatePhotoId()
    {
        $post = new PostBag();

        $personId = $post->fetchInt('personId');
        $photoId = $post->fetchInt('photoId');

        $query = "UPDATE `person` SET `photoId` = {$photoId} WHERE `id` = {$personId} LIMIT 1";

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    public function edit()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');

        $status = 'hide';
        if ('show' == $post->fetch('status')) {
            $status = 'show';
        }

        $name_origin = $this->db->real_escape_string($this->clearText($post->fetch('name_origin')));
        $name_ru = $this->db->real_escape_string($this->clearText($post->fetch('name_ru')));
        $search = $this->db->real_escape_string($this->clearText($post->fetch('search')));

        $sex = '';
        switch ($post->fetch('sex')) {
            case 'male':
                $sex = 'male';
                break;
            case 'female':
                $sex = 'female';
                break;
        }

        $origin = '';
        switch ($post->fetch('origin')) {
            case 'ru':
                $origin = 'ru';
                break;
            case 'foreign':
                $origin = 'foreign';
                break;
        }

        $actor = 'no';
        if ($post->has('actor')) {
            $actor = 'yes';
        }
        $director = 'no';
        if ($post->has('director')) {
            $director = 'yes';
        }
        $screenwriter = 'no';
        if ($post->has('screenwriter')) {
            $screenwriter = 'yes';
        }
        $producer = 'no';
        if ($post->has('producer')) {
            $producer = 'yes';
        }
        $composer = 'no';
        if ($post->has('composer')) {
            $composer = 'yes';
        }
        $operator = 'no';
        if ($post->has('operator')) {
            $operator = 'yes';
        }

        $birthday = $post->fetch('birthday');
        if (empty($birthday)) {
            $day = 0;
            $month = 0;
            $birthday = 'null';
        } else {
            $birthday = explode('.', $birthday);
            $birthday[2] = $birthday[2] ?? '';
            $birthday[1] = $birthday[1] ?? '';
            $birthday[0] = $birthday[0] ?? '';
            $day = $birthday[0];
            $month = $birthday[1];
            $birthday  = $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0];
            $birthday = '\'' . $birthday . '\'';
        }

        $death = $post->fetch('death');
        if (empty($death)) {
            $death = 'null';
        } else {
            $death = explode('.', $death);
            $death[2] = $death[2] ?? '';
            $death[1] = $death[1] ?? '';
            $death[0] = $death[0] ?? '';
            $death  = $death[2] . '-' . $death[1] . '-' . $death[0];
            $death = '\'' . $death . '\'';
        }

        $birthplace_en = $this->db->real_escape_string($this->clearText($post->fetch('birthplace_en')));
        $birthplace_ru = $this->db->real_escape_string($this->clearText($post->fetch('birthplace_ru')));

        $height = $post->fetchInt('height');

        $biography = $this->db->real_escape_string($post->fetch('biography'));
        $education = $this->db->real_escape_string($this->clearText($post->fetch('education')));
        $theater = $this->db->real_escape_string($this->clearText($post->fetch('theater')));
        $award = $this->db->real_escape_string($this->clearText($post->fetch('award')));
        $info = $this->db->real_escape_string($this->clearText($post->fetch('info')));

        $match = $post->fetchInt('match');

        $query = "UPDATE `person` SET 
                    `id` = {$id},
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
                    `match` = {$match},
                    `day` = {$day},
                    `month` = {$month}
                    WHERE `id` = {$id} LIMIT 1
                    ";

        $personId = $id;

        /**
         * Education key => val.
         */
        $education = explode('_;_', $education);
        foreach ($education as $item) {
            $item = explode('_:_', $item);
            $university = $this->db->real_escape_string(trim($item[0]));
            $department = $this->db->real_escape_string(trim($item[1] ?? ''));
            $studio = $this->db->real_escape_string(trim($item[2] ?? ''));

            if (!empty($university)) {
                $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'university' AND `value` = '{$university}' LIMIT 1");
                if (!$row = $result->fetch_assoc()) {
                    $this->db->query("INSERT INTO `eav_storage` SET `key` = 'university', `value` = '{$university}'");
                }
            }

            if (!empty($department)) {
                $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'department' AND `value` = '{$department}' LIMIT 1");
                if (!$row = $result->fetch_assoc()) {
                    $this->db->query("INSERT INTO `eav_storage` SET `key` = 'department', `value` = '{$department}'");
                }
            }

            if (!empty($studio)) {
                $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'studio' AND `value` = '{$studio}' LIMIT 1");
                if (!$row = $result->fetch_assoc()) {
                    $this->db->query("INSERT INTO `eav_storage` SET `key` = 'studio', `value` = '{$studio}'");
                }
            }
        }
        
        /**
         * Theatre key => val.
         */
        $theater = explode('_;_', $theater);
        foreach ($theater as $item) {
            $item = explode('_:_', $item);
            $theatre = $this->db->real_escape_string(trim($item[0]));

            if (!empty($theatre)) {
                $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'theatre' AND `value` = '{$theatre}' LIMIT 1");
                if (!$row = $result->fetch_assoc()) {
                    $this->db->query("INSERT INTO `eav_storage` SET `key` = 'theatre', `value` = '{$theatre}'");
                }
            }
        }

        $this->db->query($query);
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
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
            $result = $this->db->query("SELECT `id`, `letter` FROM `person_letter` WHERE `personId` = {$personId} AND `lang` = 'ru'");
            $insertLetter = false;
            if ($row = $result->fetch_assoc()) {
                if (mb_strtolower($row['letter'], 'UTF-8') != mb_strtolower($letter, 'UTF-8')) {
                    $this->db->query("DELETE FROM `person_letter` WHERE `id` = {$row['id']} LIMIT 1");
                    $insertLetter = true;
                }
            } else {
                $insertLetter = true;
            }
            if ($insertLetter) {
                $letter = $this->db->real_escape_string($letter);
                $this->db->query("INSERT INTO `person_letter` SET `personId` = {$personId}, `lang` = 'ru', `letter` = '{$letter}'");
            }
        }

        $string = $name_origin;
        foreach ($articleList as $article) {
            $string = str_ireplace($article . ' ', '', $string);
        }
        $string = preg_replace("/[^A-Za-zА-Яа-яёЁ]/u", ' ', $string);
        if (!empty($string)) {
            $letter = trim(mb_substr($string, 0, 1, 'UTF-8'));
            $result = $this->db->query("SELECT `id`, `letter` FROM `person_letter` WHERE `personId` = {$personId} AND `lang` = 'foreign'");
            $insertLetter = false;
            if ($row = $result->fetch_assoc()) {
                if (mb_strtolower($row['letter'], 'UTF-8') != mb_strtolower($letter, 'UTF-8')) {
                    $this->db->query("DELETE FROM `person_letter` WHERE `id` = {$row['id']} LIMIT 1");
                    $insertLetter = true;
                }
            } else {
                $insertLetter = true;
            }
            if ($insertLetter) {
                $letter = $this->db->real_escape_string($letter);
                $this->db->query("INSERT INTO `person_letter` SET `personId` = {$personId}, `lang` = 'foreign', `letter` = '{$letter}'");
            }
        }

        if ('show' == $status) {
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('person:' . $personId)) {
                $redis->delete('person:' . $personId);
                if ($redis->exists('person:' . $personId . ':min')) {
                    $redis->delete('person:' . $personId . ':min');
                }
                if ($redis->exists('person:' . $personId . ':stat')) {
                    $redis->delete('person:' . $personId . ':stat');
                }
            }
        }

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

        $query = "UPDATE `person` SET 
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

        $result = $this->db->query("SELECT t1.*, t2.`photo`, t2.`wallpaper`, t2.`video`, t2.`award`, t2.`frame`, t2.`news`
                                    FROM `person` as `t1` 
                                    LEFT JOIN `person_stat` as `t2` ON t1.`id` = t2.`personId`
                                    WHERE t1.`id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    /**
     * @param $id
     * @return \Kinomania\Control\Person\Casting\Item
     */
    public function getCastingById($id)
    {
        $id = intval($id);
        $item = new \Kinomania\Control\Person\Casting\Item();

        $result = $this->db->query("SELECT * FROM `person_casting` WHERE `personId` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $ethnic = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_ethnic` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'ethnic' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $ethnic[] = $row2['value'];
            }

            $sport = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_sport` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'sport' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $sport[] = $row2['value'];
            }

            $language = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_language` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'language' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $language[] = $row2['value'];
            }

            $music_instrument = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_music_instrument` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'music_instrument' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $music_instrument[] = $row2['value'];
            }

            $dance = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_dance` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'dance' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $dance[] = $row2['value'];
            }

            $sing = [];
            $result2 = $this->db->query("SELECT t2.`value` FROM `person_casting_sing` as `t1` JOIN `eav_storage` as `t2` ON t1.`keyId` = t2.`id` WHERE t1.`personId` = {$id} AND t2.`key` = 'sing' ORDER BY t1.`id`");
            while ($row2 = $result2->fetch_assoc()) {
                $sing[] = $row2['value'];
            }

            $row['ethnic'] = implode(',', $ethnic);
            $row['sport'] = implode(',', $sport);
            $row['language'] = implode(',', $language);
            $row['music_instrument'] = implode(',', $music_instrument);
            $row['dance'] = implode(',', $dance);
            $row['sing'] = implode(',', $sing);
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
            case 1:
                $order = 'name';
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

            $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$search}') LIMIT 50 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
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
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru` FROM `person` WHERE `id` = 0";
            } else {
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru` FROM `person` WHERE 1 ";
                $query .= " AND `id` IN ($idList)";
                $query .= " ORDER BY `{$order}` {$direction}";
            }
        } else {
            $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru` FROM `person` WHERE 1 ";
            if (!empty($search)) {
                $query = "SELECT `id`, `s`, `image`, `status`, `name_origin`, `name_ru` FROM (
                                  SELECT * FROM `person` WHERE `id` = {$search}
                                  UNION SELECT * FROM `person` WHERE `id_imdb` = {$search}
                                  UNION SELECT * FROM `person` WHERE `id_kp` = {$search}
                                  UNION SELECT * FROM `person` WHERE `id_kt` = {$search}
                                  UNION SELECT * FROM `person` WHERE `id_rk` = {$search}) T WHERE 1 ";
            }
        }

        /**
         * Total.
         */
        if (!$useSphinx) {
            $total = 0;
            if (!empty($search)) {
                $result = $this->db->query(str_replace('`id`, `s`, `image`, `status`, `name_origin`, `name_ru`', 'COUNT(*) as `count`', $query));
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                }
            } else {
                $result = $this->db->query("SELECT `count` FROM `count` WHERE `key` = 'person'");
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                } else {
                    $result = $this->db->query(str_replace('`id`, `s`, `image`, `status`, `name_origin`, `name_ru`', 'COUNT(*) as `count`', $query));
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
            $item[0] = $row['id'];
            $item[1] = '';
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $path = str_split($iName);
                $item[1] = Server::STATIC[$row['s']] . '/image' . Path::PERSON . $path[0] . '/' . $path[1] . $path[2] . '/' . $iName . '.88.116.' . $row['image'];
            } else {
                $item[1] = Server::STATIC[0] . '/app/img/content/nop.jpg';
            }
            $item[2] = $row['name_ru'] . '<br />' . $row['name_origin'];
            $item[3] = $row['status'];

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
        $static->delete('person', 0, $id, 'jpeg');

        $this->db->query("DELETE FROM `person` WHERE `id` = {$id} LIMIT 1");
        $this->db->query("DELETE FROM `person_letter` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_dance` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_ethnic` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_language` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_music_instrument` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_sing` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `person_casting_sport` WHERE `personId` = {$id}");

        $result = $this->db->query("SELECT `id`, `s` FROM `person_photo` WHERE `personId` = {$id} LIMIT 1");
        while ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $static->deleteList('person_photo', $row['s'], [$row['id']]);
        }
        $this->db->query("DELETE FROM `person_photo` WHERE `personId` = {$id}");

        $result = $this->db->query("SELECT `id`, `s` FROM `person_wallpaper` WHERE `personId` = {$id} LIMIT 1");
        while ($row = $result->fetch_assoc()) {
            $static = new StaticS();
            $static->deleteList('person_wallpaper', $row['s'], [$row['id']]);
        }
        $this->db->query("DELETE FROM `person_wallpaper` WHERE `personId` = {$id}");

        $comment = new Comment($this->db);
        $result = $this->db->query("SELECT `id` FROM `person_review` WHERE `personId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $result = $this->db->query("SELECT `id` FROM `comment` WHERE `relatedId` = {$row['id']} AND `type` = 'person' AND `parent` = 0");
            while ($row = $result->fetch_assoc()) {
                $comment->delete($row['id']);
            }

            $this->db->query("DELETE FROM `person_review_stat` WHERE `reviewId` = {$row['id']}");
            $this->db->query("DELETE FROM `person_review_vote` WHERE `reviewId` = {$row['id']}");
        }

        $this->db->query("DELETE FROM `film_crew` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `film_cast` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `film_frame_person` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `film_wallpaper_person` WHERE `personId` = {$id}");

        $this->db->query("DELETE FROM `person_stat` WHERE `personId` = {$id}");

        $this->db->query("DELETE FROM `user_folder_person` WHERE `personId` = {$id}");
        $this->db->query("DELETE FROM `moderate` WHERE `type` = 'person' AND `relatedId` = {$id}");
        $this->db->query("UPDATE `news_link` SET `personId` = 0 WHERE `personId` = {$id}");

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('person:' . $id)) {
            $redis->delete('person:' . $id);
            if ($redis->exists('person:' . $id . ':min')) {
                $redis->delete('person:' . $id . ':min');
            }
            if ($redis->exists('person:' . $id . ':stat')) {
                $redis->delete('person:' . $id . ':stat');
            }
        }

        return true;
    }

    private $insertedId;
}