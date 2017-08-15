<?php
namespace Kinomania\Control\Person\Parse;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Person\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Text\TText;

class Parse extends DB
{
    use TText;
    use TRepository;

    public function source($personId, $parserType)
    {
        $item = new Item();

        $personId = intval($personId);
        $result = $this->db->query("SELECT * FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $image = '';
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image/' . Path::PERSON . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $row['image'];
            }
            
            $cast = [];
            $result = $this->db->query("SELECT t2.`id_imdb`, t2.`name_origin`, t2.`name_ru` 
                                    FROM `film_cast` as `t1` JOIN (SELECT `id` FROM `film_cast` WHERE `personId` = {$personId} ORDER BY `order`) as `t` ON t.`id` = t1.`id` 
                                    JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                ");
            while ($row2 = $result->fetch_assoc()) {
                $name = $row2['name_origin'];
                if (empty($name)) {
                    $name = $row2['name_ru'];
                }
                $cast[$row2['id_imdb']] =  $name;
            }
   
            $crew = [
                'Режиссер' => [],
                'Сценарист' => [],
                'Продюсер' => [],
                'Оператор' => [],
                'Композитор' => [],
            ];
            $result = $this->db->query("SELECT t1.`type`, t2.`id_imdb`, t2.`name_origin`, t2.`name_ru`
                                    FROM `film_crew` as `t1` JOIN (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} ORDER BY `order`) as `t` ON t.`id` = t1.`id`
                                    JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                ");
            while ($row2 = $result->fetch_assoc()) {
                $name = $row2['name_origin'];
                if (empty($name)) {
                    $name = $row2['name_ru'];
                }
                $crew[$row2['type']][$row2['id_imdb']] =  $name;
            }

            $item->setImage($image);
            $item->setName_origin($row['name_origin']);
            $item->setName_ru($row['name_ru']);
            $item->setSex($row['sex']);
            $item->setBirthday($row['birthday']);
            $item->setDeath($row['death']);
            $item->setBirthplace_en($row['birthplace_en']);
            $item->setBirthplace_ru($row['birthplace_ru']);
            $item->setHeight($row['height']);
            $item->setCast($cast);
            $item->setCrew($crew);
        }

        return $item;
    }

    public function parsed($id, $parserType)
    {
        $item = new Item();

        $parser = new Parser(false);
        switch ($parserType) {
            case 'kp':
                $parser->kp_person($id);
                break;
            case 'kt':
                $parser->kt_person($id);
                break;
            default:
                $parser->imdb_person($id);
                break;
        }

        if (empty($parser->error())) {
            $data = $parser->data();

            $name_origin = $this->db->real_escape_string($this->clearText($data['name_original'] ?? ''));
            
            $sex = $data['sex'] ?? '';

            if (empty($data['born'] ?? '')) {
                $birthday = '';
            } else {
                $birthday = $data['born'] ?? '';
            }

            if (empty($data['die'] ?? '')) {
                $death = '';
            } else {
                $death = $data['die'] ?? '';
            }

            $birthplace_en = '';
            $birthplace_ru = '';

            if ('kp' == $parserType) {
                $birthplace_ru = $this->db->real_escape_string($this->clearText($data['place'] ?? ''));
            } else {
                $birthplace_en = $this->db->real_escape_string($this->clearText($data['place'] ?? ''));
            }

            $height = intval($data['height'] ?? '');

            if ('kt' == $parserType) {
                $image = '';
            } else {
                $image = $data['image'] ?? '';
                if ('imdb' == $parserType) {
                    if (!empty($image)) {
                        $image = explode('.jpg', $image);
                        $image = explode('.', $image[0]);
                        unset($image[count($image) - 1]);
                        $image = implode('.', $image);
                    }
                }
            }


            $cast = [];
            foreach ($data['Actor'] as $k => $castI) {
                if ('kp' == $parserType) {
                    $filmId = intval($castI[2]);
                    $name = $this->clearText($castI[1]);
                    $cast[$filmId] = [$name, $castI[4] ?? '', '', $castI[0] ?? '', $castI[5] ?? '', $castI[6] ?? '', $castI[7] ?? '', '', $castI[3] ?? ''];
                } else {
                    $filmId = intval($castI['id']);
                    $name = $this->clearText($castI['english_name']);
                    $cast[$filmId] = [$name, $castI['characterName'] ?? '', $castI['countOfEpisodes'] ?? '', $castI['year'] ?? '', $castI['characterVoice'] ?? '', $castI['characterUncredited'] ?? '', $castI['self'] ?? '', $castI['type'] ?? '', $castI['ru_name'] ?? ''];
                }
            }

            $crew = [
                'Режиссер' => [],
                'Сценарист' => [],
                'Продюсер' => [],
                'Оператор' => [],
                'Композитор' => [],
            ];
            foreach ($data['crew'] as $typeI => $crewList) {
                if (!in_array($typeI, ['Режиссер', 'Сценарист', 'Продюсер', 'Композитор', 'Оператор'])) {
                    continue;
                }
                foreach ($crewList as $k => $crewI) {
                    if ('kp' == $parserType) {
                        $filmId = intval($crewI[2]);
                        $name = $this->clearText($crewI[1]);
                        $cast[$filmId] = [$name, '', '', $crewI[0] ?? '', '', $crewI[4] ?? '', '', '', $crewI[3] ?? ''];
                    } else {
                        $filmId = intval($crewI['id']);
                        $name = $this->clearText($crewI['english_name']);
                        $crew[$typeI][$filmId] = [$name, $crewI['characterName'] ?? '', $crewI['countOfEpisodes'] ?? '', $crewI['year'] ?? '', $crewI['characterVoice'] ?? '', $crewI['characterUncredited'] ?? '', $crewI['self'] ?? '', $crewI['type'] ?? '', $crewI['ru_name'] ?? ''];
                    }
                }
            }


            $item->setImage($image);
            $item->setName_origin($name_origin);
            $item->setName_ru('');
            $item->setSex($sex);
            $item->setBirthday($birthday);
            $item->setDeath($death);
            $item->setBirthplace_en($birthplace_en);
            $item->setBirthplace_ru($birthplace_ru);
            $item->setHeight($height);
            $item->setCast($cast);
            $item->setCrew($crew);
        }

        return $item;
    }

    public function save()
    {
        $post = new PostBag();

        $isImage = $post->has('image'); 
        $isName_origin = $post->has('name_origin'); 
        $isName_ru = $post->has('name_ru'); 
        $isSex = $post->has('sex');
        $isBirthday = $post->has('birthday');
        $isDeath = $post->has('death');
        $isBirthplace_en = $post->has('birthplace_en');
        $isBirthplace_ru = $post->has('birthplace_ru');
        $isHeight = $post->has('height');
        $isCast = $post->has('cast');
        $isCrew_director = $post->has('crew_director');
        $isCrew_script = $post->has('crew_script');
        $isCrew_producer = $post->has('crew_producer');
        $isCrew_operator = $post->has('crew_operator');
        $isCrew_composer = $post->has('crew_composer');
        $parserType = $post->fetch('parserType');

        $id = $post->fetchInt('id');
        $parsed = $post->fetch('data');
        $parsed = unserialize(gzinflate(base64_decode($parsed)));

        if ($isName_origin || $isName_ru || $isSex || $isBirthday || $isDeath || $isBirthplace_en || $isHeight) {
            if (0 < $id) {
                $parse = new Parse($this->db);
                $source = $parse->source($id, $parserType);

                if ($isName_origin) {
                    $name_origin = $parsed->name_origin();
                } else {
                    $name_origin = $source->name_origin();
                }
                $name_origin = $this->db->real_escape_string($name_origin);

                if ($isName_ru) {
                    $name_ru = $parsed->name_ru();
                } else {
                    $name_ru = $source->name_ru();
                }
                $name_ru = $this->db->real_escape_string($name_ru);

                if ($isSex) {
                    $sex = $parsed->sex();
                } else {
                    $sex = $source->sex();
                }
                $sex = $this->db->real_escape_string($sex);

                if ($isBirthday) {
                    $birthday = $parsed->birthday();
                } else {
                    $birthday = $source->birthday();
                }
                if (empty($birthday)) {
                    $birthday = 'null';
                } else {
                    $birthday = $this->db->real_escape_string($birthday);
                    $birthday = '\'' . $birthday . '\'';
                }

                if ($isDeath) {
                    $death = $parsed->death();
                } else {
                    $death = $source->death();
                }
                if (empty($death)) {
                    $death = 'null';
                } else {
                    $death = $this->db->real_escape_string($death);
                    $death = '\'' . $death . '\'';
                }

                if ($isBirthplace_en) {
                    $birthplace_en = $parsed->birthplace_en();
                } else {
                    $birthplace_en = $source->birthplace_en();
                }
                $birthplace_en = $this->db->real_escape_string($birthplace_en);

                if ($isBirthplace_ru) {
                    $birthplace_ru = $parsed->birthplace_ru();
                } else {
                    $birthplace_ru = $source->birthplace_ru();
                }
                $birthplace_ru = $this->db->real_escape_string($birthplace_ru);

                if ($isHeight) {
                    $height = $parsed->height();
                } else {
                    $height = $source->height();
                }
                $height = intval($height);

                $query = "UPDATE `person` SET
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '{$name_ru}',
                    `sex` = '{$sex}',
                    `birthday` = {$birthday},
                    `death` = {$death},
                    `birthplace_en` = '{$birthplace_en}',
                    `birthplace_ru` = '{$birthplace_ru}',
                    `height` = {$height}
                    WHERE `id`  = {$id} LIMIT 1
                ";
                $this->db->query($query);
            }
        }

        $castListAccepted = $post->fetch('castList');
        if (!is_array($castListAccepted)) {
            $castListAccepted = [];
        }
        if ($isCast && 0 < $id) {
            $order = 0;
            foreach ($parsed->cast() as $filmId => $cast) {
                $order++;

                $filmId = intval($filmId);
                if (0 < count($castListAccepted) && !in_array($filmId, $castListAccepted)) {
                    continue;
                }
                $sourceId = $filmId;
                $name_origin = '';
                $name_ru = '';

                switch ($parserType) {
                    case 'kp':
                        $name_origin = $cast[0];
                        $name_ru = $cast[8];
                        break;
                    case 'kt':
                        $name_origin = $cast[0];
                        $name_ru = $cast[8];
                        break;
                    default:
                        $name_origin = $cast[0];
                }

                if (0 < $filmId) {
                    switch ($parserType) {
                        case 'kp':
                            $query = "SELECT `id` FROM `film` WHERE `id_kp` = {$filmId} LIMIT 1";
                            break;
                        case 'kt':
                            $query = "SELECT `id` FROM `film` WHERE `id_kt` = {$filmId} LIMIT 1";
                            break;
                        default:
                            $query = "SELECT `id` FROM `film` WHERE `id_imdb` = {$filmId} LIMIT 1";
                    }
                    $result = $this->db->query($query);
                    if ($row = $result->fetch_assoc()) {
                        $filmId = $row['id'];
                    } else {
                        if (empty($name_origin) && empty($name_ru)) {
                            continue;
                        }
                        $tempName = $name_origin;
                        if (empty($tempName)) {
                            $tempName = $name_ru;
                        }
                        $personIdTemp = $this->getFilmIdByName($tempName);
                        if (0 == $personIdTemp) {
                            $id_imdb = 0;
                            $id_kp = 0;
                            $id_kt = 0;
                            switch ($parserType) {
                                case 'kp':
                                    $id_kp = $filmId;
                                    break;
                                case 'kt':
                                    $id_kt = $filmId;
                                    break;
                                default:
                                    $id_imdb = $filmId;
                            }

                            $name_origin = $this->db->real_escape_string($name_origin);
                            $name_ru = $this->db->real_escape_string($name_ru);
                            $year = intval($cast[3]);
                            $type = '';
                            if (false !== stripos($cast[7], 'series')) {
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
                                            `id_imdb` = {$id_imdb},
                                            `id_kt` = {$id_kt},
                                            `id_rk` = 0,
                                            `id_kp` = {$id_kp},
                                            `weight` = 0
                                            ";
                            $this->db->query($query);
                            $filmId = $this->db->insert_id;
                            if (!empty($this->db->error)) {
                                $this->error = $this->db->error;
                                print_r($this->error);exit;
                                return false;
                            }
                        } else {
                            $filmId = $personIdTemp;
                        }
                    }

                    switch ($parserType) {
                        case 'kp':
                            $this->db->query("UPDATE `film` SET `id_kp` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                            break;
                        case 'kt':
                            $this->db->query("UPDATE `film` SET `id_kt` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                            break;
                        default:
                            $this->db->query("UPDATE `film` SET `id_imdb` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                    }

                    $role_ru = '';
                    $role_en = '';
                    switch ($parserType) {
                        case 'kp':
                            $role_en = $cast[1];
                            break;
                        case 'kt':
                            $role_ru = $cast[1];
                            break;
                        default:
                            $role_en = $cast[1];
                    }

                    $role_en = $this->db->real_escape_string($role_en);
                    $role_ru = $this->db->real_escape_string($role_ru);

                    $episodes = 0;
                    if ('imdb' == $parserType) {
                        $episodes = intval($cast[2]);
                    }
                    $year = $this->db->real_escape_string($this->clearText($cast[3]));

                    $voice = 'no';
                    $self = 'no';
                    $uncredited = 'no';

                    if (1 == $cast[4]) {
                        $voice = 'yes';
                    }
                    if (1 == $cast[5]) {
                        $uncredited = 'yes';
                    }
                    if (1 == $cast[6]) {
                        $self = 'yes';
                    }

                    $source = 'imdb';
                    switch ($parserType) {
                        case 'kp':
                            $source = 'kinopoisk';
                            break;
                        case 'kt':
                            $source = 'kinoteatr';
                            break;
                    }

                    $result = $this->db->query("SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} AND `personId` = {$id} LIMIT 1");
                    if (0 == $result->num_rows) {
                        $this->db->query("INSERT INTO `film_cast` SET 
                                          `filmId` = {$filmId}, `personId` = {$id}, `role_ru` = '{$role_ru}',
                                          `role_en` = '{$role_en}', `note` = '', `voice` = '{$voice}', `self` = '{$self}',
                                          `uncredited` = '{$uncredited}', `episodes` = {$episodes}, `year` = '{$year}', `source` = '{$source}', `order` = {$order}
                                          ");
                        if (!empty($this->db->error)) {
                            echo $this->db->error;exit;
                        }
                    }
                }
            }
        }

        $crewListAccepted = $post->fetch('crewList');
        if (!is_array($crewListAccepted)) {
            $crewListAccepted = [];
        }
        if (0 < $id && ($isCrew_director || $isCrew_script || $isCrew_producer || $isCrew_operator || $isCrew_composer)) {
            foreach ($parsed->crew() as $type => $crewList) {
                if (!in_array($type, ['Режиссер', 'Сценарист', 'Продюсер', 'Композитор', 'Оператор'])) {
                    continue;
                }
                if (('Режиссер' == $type && $isCrew_director) || ('Сценарист' == $type && $isCrew_script) || ('Продюсер' == $type && $isCrew_producer) || ('Композитор' == $type && $isCrew_composer) || ('Оператор' == $type && $isCrew_operator)) {
                    $order = 0;
                    foreach ($crewList as $filmId => $crew) {
                        $order++;

                        $filmId = intval($filmId);
                        if (0 < count($crewListAccepted) && !in_array($filmId, $crewListAccepted)) {
                            continue;
                        }
                        $sourceId = $filmId;
                        $name_origin = '';
                        $name_ru = '';

                        switch ($parserType) {
                            case 'kp':
                                $name_origin = $crew[0];
                                $name_ru = $crew[8];
                                break;
                            case 'kt':
                                $name_origin = $crew[0];
                                $name_ru = $crew[8];
                                break;
                            default:
                                $name_origin = $crew[0];
                        }

                        if (0 < $filmId) {
                            switch ($parserType) {
                                case 'kp':
                                    $query = "SELECT `id` FROM `film` WHERE `id_kp` = {$filmId} LIMIT 1";
                                    break;
                                case 'kt':
                                    $query = "SELECT `id` FROM `film` WHERE `id_kt` = {$filmId} LIMIT 1";
                                    break;
                                default:
                                    $query = "SELECT `id` FROM `film` WHERE `id_imdb` = {$filmId} LIMIT 1";
                            }
                            $result = $this->db->query($query);
                            if ($row = $result->fetch_assoc()) {
                                $filmId = $row['id'];
                            } else {
                                if (empty($name_origin) && empty($name_ru)) {
                                    continue;
                                }
                                $tempName = $name_origin;
                                if (empty($tempName)) {
                                    $tempName = $name_ru;
                                }
                                $personIdTemp = $this->getFilmIdByName($tempName);
                                if (0 == $personIdTemp) {
                                    $id_imdb = 0;
                                    $id_kp = 0;
                                    $id_kt = 0;
                                    switch ($parserType) {
                                        case 'kp':
                                            $id_kp = $filmId;
                                            break;
                                        case 'kt':
                                            $id_kt = $filmId;
                                            break;
                                        default:
                                            $id_imdb = $filmId;
                                    }

                                    $name_origin = $this->db->real_escape_string($name_origin);
                                    $name_ru = $this->db->real_escape_string($name_ru);
                                    $year = intval($crew[3]);
                                    $type = '';
                                    if (false !== stripos($crew[7], 'series')) {
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
                                            `id_imdb` = {$id_imdb},
                                            `id_kt` = {$id_kt},
                                            `id_rk` = 0,
                                            `id_kp` = {$id_kp},
                                            `weight` = 0
                                            ";
                                    $this->db->query($query);
                                    $filmId = $this->db->insert_id;
                                    if (!empty($this->db->error)) {
                                        $this->error = $this->db->error;
                                        print_r($this->error);exit;
                                        return false;
                                    }
                                } else {
                                    $filmId = $personIdTemp;
                                }
                            }

                            switch ($parserType) {
                                case 'kp':
                                    $this->db->query("UPDATE `film` SET `id_kp` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                                    break;
                                case 'kt':
                                    $this->db->query("UPDATE `film` SET `id_kt` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                                    break;
                                default:
                                    $this->db->query("UPDATE `film` SET `id_imdb` = {$sourceId} WHERE `id` = {$filmId} LIMIT 1");
                            }

                            $description = '';
                            if ('kp' != $parserType) {
                                $description = $this->db->real_escape_string($crew[1] ?? '');
                            }
                            $episodes = intval($crew[2] ?? '');
                            $year = $this->db->real_escape_string($crew[3] ?? '');

                            $source = 'imdb';
                            switch ($parserType) {
                                case 'kp':
                                    $source = 'kinopoisk';
                                    break;
                                case 'kt':
                                    $source = 'kinoteatr';
                                    break;
                            }

                            $result = $this->db->query("SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} AND `personId` = {$id} LIMIT 1");
                            if (0 == $result->num_rows) {
                                $this->db->query("INSERT INTO `film_crew` SET 
                                              `filmId` = {$filmId}, `personId` = {$id}, `type` = '{$type}',
                                              `description` = '{$description}', `episodes` = {$episodes}, `year` = '{$year}', `source` = '{$source}', `order` = {$order}
                                              ");
                            }
                        }
                    }
                }
            }
        }

        if (0 < $id && $isImage) {
            $static = new StaticS();
            if (!empty($parsed->image())) {
                $data = json_decode($static->upload('person', '1920x1920', $id, $parsed->image()), true);

                if (isset($data['ex'])) {
                    $post = new PostBag();
                    switch ($data['ex']) {
                        case 'png':
                        case 'jpeg':
                        case 'gif':
                            break;
                        default:
                            $data['ex'] = '';
                    }
                    $id = intval($post->fetchInt('id'));
                    if (!empty($data['ex'])) {
                        $s = intval(Server::STATIC_CURRENT);
                        $this->mysql()->query("UPDATE `person` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");
                    }
                }
            }
        }

        if (0 < $id) {
            $stat = new Stat($this->db);
            $stat->update($id);
        }

        return true;
    }

    private function getFilmIdByName($search)
    {
        iconv(mb_detect_encoding($search, mb_detect_order(), true), "UTF-8", $search);
        $search = preg_replace('/[^0-9a-zA-ZА-Яа-яёЁ_ -]+/u', '', $search);
        $search = str_replace('&nbsp;', ' ', $search);
        $search = trim($search);
        $search = trim($search, "\xC2\xA0");
        $search = trim($search, "\xC2\xA0\n");
        $search = $this->sphinx()->real_escape_string($search);
        $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        if (!empty($this->sphinx()->error)) {
            return 0;
        }
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            if (0 < $rowData['id']) {
                $idList[] = $rowData['id'];
            }
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }

        if (0 == count($idList)) {
            return 0;
        }

        $idList = implode(',', $idList);

        $result = $this->db->query("SELECT `id` FROM `film` WHERE `id` IN ($idList) ORDER BY `year` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }

        return 0;
    }
}