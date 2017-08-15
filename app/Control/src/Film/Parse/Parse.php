<?php
namespace Kinomania\Control\Film\Parse;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Film\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Text\TText;

class Parse extends DB
{
    use TText;
    use TDate;
    use TRepository;

    public function source($filmId, $parserType)
    {
        $item = new Item();

        $filmId = intval($filmId);
        $result = $this->db->query("SELECT * FROM `film` WHERE `id` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $image = '';
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image/' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $row['image'];
            }

            $country = [];
            $row['country'] = explode(',', $row['country']);
            $temp = Country::RU;
            foreach ($row['country'] as $code) {
                if (isset($temp[$code])) {
                    $country[] = $temp[$code];
                }
            }

            $genre = [];
            $row['genre'] = explode(',', $row['genre']);
            $temp = Genre::RU;
            foreach ($row['genre'] as $code) {
                if (isset($temp[$code])) {
                    $genre[] = $temp[$code];
                }
            }

            $stat = [
                'imdb' => '',
                'imdb_count' => '',
            ];
            switch ($parserType) {
                case 'kp':
                    $result = $this->db->query("SELECT `kp`, `kp_count` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row2 = $result->fetch_assoc()) {
                        $stat['imdb'] = $row2['kp'];
                        $stat['imdb_count'] = $row2['kp_count'];
                    }
                    break;
                default:
                    $result = $this->db->query("SELECT `imdb`, `imdb_count` FROM `film_stat` WHERE `filmId` = {$filmId} LIMIT 1");
                    if ($row2 = $result->fetch_assoc()) {
                        $stat['imdb'] = $row2['imdb'];
                        $stat['imdb_count'] = $row2['imdb_count'];
                    }
            }
            
            $cast = [];
            switch ($parserType) {
                case 'kp':
                    $result = $this->db->query("SELECT t2.`id_kp`, t2.`name_origin`, t2.`name_ru` 
                                    FROM `film_cast` as `t1` JOIN (SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id` 
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
                    while ($row2 = $result->fetch_assoc()) {
                        $name = $row2['name_origin'];
                        if (empty($name)) {
                            $name = $row2['name_ru'];
                        }
                        $cast[$row2['id_kp']] =  $name;
                    }
                    break;
                case 'kt':
                    $result = $this->db->query("SELECT t2.`id_kt`, t2.`name_origin`, t2.`name_ru` 
                                    FROM `film_cast` as `t1` JOIN (SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id` 
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
                    while ($row2 = $result->fetch_assoc()) {
                        $name = $row2['name_origin'];
                        if (empty($name)) {
                            $name = $row2['name_ru'];
                        }
                        $cast[$row2['id_kt']] =  $name;
                    }
                    break;
                default:
                    $result = $this->db->query("SELECT t2.`id_imdb`, t2.`name_origin`, t2.`name_ru` 
                                    FROM `film_cast` as `t1` JOIN (SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id` 
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
                    while ($row2 = $result->fetch_assoc()) {
                        $name = $row2['name_origin'];
                        if (empty($name)) {
                            $name = $row2['name_ru'];
                        }
                        $cast[$row2['id_imdb']] =  $name;
                    }
            }
   
            $crew = [
                'Режиссер' => [],
                'Сценарист' => [],
                'Продюсер' => [],
                'Оператор' => [],
                'Композитор' => [],
            ];
            $result = $this->db->query("SELECT t1.`type`, t2.`id_imdb`, t2.`name_origin`, t2.`name_ru`
                                    FROM `film_crew` as `t1` JOIN (SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} ORDER BY `order`) as `t` ON t.`id` = t1.`id`
                                    JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                ");
            while ($row2 = $result->fetch_assoc()) {
                $name = $row2['name_origin'];
                if (empty($name)) {
                    $name = $row2['name_ru'];
                }
                $crew[$row2['type']][$row2['id_imdb']] =  $name;
            }

            $item->setImage($image);
            $item->setYear($row['year']);
            $item->setName_origin($row['name_origin']);
            $item->setName_ru($row['name_ru']);
            $item->setType($row['type']);
            $item->setCountry($country);
            $item->setGenre($genre);
            $item->setRuntime($row['runtime']);
            $item->setImdb($stat['imdb']);
            $item->setImdb_count($stat['imdb_count']);
            $item->setBudget($row['budget']);
            $item->setPremiere_world($row['premiere_world']);
            $item->setPremiere_ru($row['premiere_ru']);
            $item->setPremiere_usa($row['premiere_usa']);
            $item->setLimit_us($row['limit_us']);
            $item->setSeries_count($row['series_count']);
            $item->setYear_finish($row['year_finish']);
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
                $parser->kp_film($id);
                break;
            case 'kt':
                $parser->kt_film($id);
                break;
            default:
                $parser->imdb_film($id);
                break;
        }

        if (empty($parser->error())) {
            $data = $parser->data();

            $name_origin = $this->db->real_escape_string($this->clearText($data['original_name'] ?? ''));

            if (empty($name_origin)) {
                //$this->error = 'Empty name';
                //return false;
            }

            $year = intval($data['year'] ?? '');
            if (1850 > $year || 2100 < $year) {
                $year = 0;
            }

            $year_finish = intval($data['yearFinish'] ?? '');
            if (0 == $year_finish) {
                $year_finish = '';
            }

            $type = '';
            if (false !== stripos($data['type'] ?? '', 'series')) {
                $type = 'series';
            }

            $runtime = intval($data['duration'] ?? '');

            $limit_us = '';
            if (in_array($data['rate_mpaa'] ?? '', ['G', 'PG', 'PG-13', 'R', 'NC-17'])) {
                $limit_us = $data['rate_mpaa'];
            }

            $genre = [];
            foreach ($data['genre'] ?? [] as $val) {
                $found = false;
                foreach (Genre::EN as $code => $item1) {
                    if (false !== stripos($item1, $val)) {
                        $genre[] = $code;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    foreach (Genre::RU as $code => $item1) {
                        if (false !== stripos($item1, $val)) {
                            $genre[] = $code;
                            break;
                        }
                    }
                }
            }
            $genre = implode(',', $genre);
            $row['genre'] = explode(',', $genre);
            $genre = [];
            $temp = Genre::RU;
            foreach ($row['genre'] as $code) {
                if (isset($temp[$code])) {
                    $genre[] = $temp[$code];
                }
            }

            $country = [];
            foreach ($data['country'] ?? [] as $val) {
                $found = false;
                foreach (Country::EN as $code => $item1) {
                    if (false !== stripos($item1, $val)) {
                        $country[] = $code;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    foreach (Country::RU as $code => $item1) {
                        if (false !== stripos($item1, $val)) {
                            $country[] = $code;
                            break;
                        }
                    }
                }
            }
            $country = implode(',', $country);
            $row['country'] = explode(',', $country);
            $country = [];
            $temp = Country::RU;
            foreach ($row['country'] as $code) {
                if (isset($temp[$code])) {
                    $country[] = $temp[$code];
                }
            }

            if (empty($data['release_world'] ?? '')) {
                $premiere_world = '';
            } else {
                if ('kp' == $parserType) {
                    $premiere_world = explode(' ', $data['release_world']);
                    $premiere_world[1] = $this->getMonthByName($premiere_world[1]);
                    if (0 < $premiere_world[1]) {
                        $premiere_world = $premiere_world[2] . '-' . $premiere_world[1] . '-' . $premiere_world[0];
                    } else {
                        $premiere_world = '';
                    }
                } else {
                    $premiere_world = explode('.', $data['release_world']);
                    $premiere_world = $premiere_world[2] . '-' . $premiere_world[1] . '-' . $premiere_world[0];
                }
            }

            if (empty($data['release_usa'] ?? '')) {
                $premiere_usa = '';
            } else {
                $premiere_usa = explode('.', $data['release_usa']);
                $premiere_usa = $premiere_usa[2] . '-' . $premiere_usa[1] . '-' . $premiere_usa[0];
            }

            if (empty($data['release_ru'] ?? '')) {
                $premiere_ru = '';
            } else {
                if ('kp' == $parserType) {
                    $premiere_ru = explode(' ', $data['release_ru']);
                    $premiere_ru[1] = $this->getMonthByName($premiere_ru[1]);
                    if (0 < $premiere_ru[1]) {
                        $premiere_ru = $premiere_ru[2] . '-' . $premiere_ru[1] . '-' . $premiere_ru[0];
                    } else {
                        $premiere_ru = '';
                    }
                } else {
                    $premiere_ru = explode('.', $data['release_ru']);
                    $premiere_ru = $premiere_ru[2] . '-' . $premiere_ru[1] . '-' . $premiere_ru[0];
                }
            }

            $budget = floatval($data['budget'] ?? '');

            $series_count = intval($data['episode'] ?? '');

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
            foreach ($data['cast'] as $k => $castI) {
                $personId = intval($castI[0]);
                $name = $this->clearText($castI[1]);
                if (empty($name)) {
                    continue;
                }
                $character = $castI[2];
                $episode = $castI[3];
                $year_ = $castI[4];
                $voice = $castI[5];
                $uncredited = $castI[6];
                $self = $castI[7];
                $cast[$personId] = [$name, $character, $episode, $year_, $voice, $uncredited, $self];
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
                    $personId = intval($crewI[0]);
                    $name = $this->clearText($crewI[1]);
                    $description = '';
                    $episode = '';
                    $year_ = '';
                    if (isset($crewI[2])) {
                        $description = $crewI[2][0] ?? '';
                        $episode = $crewI[2][1] ?? '';
                        $year_ = $crewI[2][2] ?? '';
                    }
                    $crew[$typeI][$personId] = [$name, $description, $episode, $year_];
                }
            }


            $item->setImage($image);
            $item->setYear($year);
            $item->setName_origin($name_origin);
            $item->setName_ru('');
            $item->setType($type);
            $item->setCountry($country);
            $item->setGenre($genre);
            $item->setRuntime($runtime);
            $item->setImdb($data['rating_value'] ?? '');
            $item->setImdb_count($data['rating_count'] ?? '');
            $item->setBudget($budget);
            $item->setPremiere_world($premiere_world);
            $item->setPremiere_ru($premiere_ru);
            $item->setPremiere_usa($premiere_usa);
            $item->setLimit_us($limit_us);
            $item->setSeries_count($series_count);
            $item->setYear_finish($year_finish);
            $item->setCast($cast);
            $item->setCrew($crew);
        }

        return $item;
    }

    public function save()
    {
        $post = new PostBag();

        $isImage = $post->has('image');
        $isYear = $post->has('year');
        $isName_origin = $post->has('name_origin'); //
        $isName_ru = $post->has('name_ru'); //
        $isType = $post->has('type');
        $isCountry = $post->has('country');
        $isGenre = $post->has('genre');
        $isRuntime = $post->has('runtime');
        $isImdb = $post->has('imdb');
        $isImdb_count = $post->has('imdb_count');
        $isBudget = $post->has('budget');
        $isPremiere_world = $post->has('premiere_world');
        $isPremiere_usa = $post->has('premiere_usa');
        $isPremiere_ru = $post->has('premiere_ru');
        $isLimit_us = $post->has('limit_us');
        $isSeries_count = $post->has('series_count');
        $isYear_finish = $post->has('year_finish');
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
        
        if ($isYear || $isName_origin || $isName_ru || $isType || $isCountry || $isGenre || $isRuntime || $isBudget || $isPremiere_world ||
            $isPremiere_usa || $isPremiere_ru || $isLimit_us || $isSeries_count || $isYear_finish || $isYear_finish) {

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

                if ($isCountry) {
                    $country = $parsed->country();
                    $temp = [];
                    foreach ($country as $needle) {
                        $needle = trim($needle);
                        if (empty($needle)) {
                            continue;
                        }
                        foreach (Country::RU as $code => $name) {
                            if (false !== stripos($name, $needle)) {
                                $temp[] = $code;
                                break;
                            }
                        }
                    }

                    $country = implode(',', $temp);
                } else {
                    $country = '';
                    $result2 = $this->db->query("SELECT `country` FROM `film` WHERE `id` = {$id} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        $country = $row2['country'];
                    }
                }
                $country = $this->db->real_escape_string($country);

                if ($isYear) {
                    $year = $parsed->year();
                } else {
                    $year = $source->year();
                }
                $year = intval($year);

                if ($isGenre) {
                    $genre = $parsed->genre();
                    $temp = [];
                    foreach ($genre as $needle) {
                        $needle = trim($needle);
                        if (empty($needle)) {
                            continue;
                        }
                        foreach (Genre::RU as $code => $name) {
                            if (false !== stripos($name, $needle)) {
                                $temp[] = $code;
                                break;
                            }
                        }
                    }
                    $genre = implode(',', $temp);
                } else {
                    $genre = '';
                    $result2 = $this->db->query("SELECT `genre` FROM `film` WHERE `id` = {$id} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        $genre = $row2['genre'];
                    }
                }
                $genre = $this->db->real_escape_string($genre);

                if ($isType) {
                    $type = $parsed->type();
                } else {
                    $type = $source->type();
                }
                $type = $this->db->real_escape_string($type);

                if ($isRuntime) {
                    $runtime = $parsed->runtime();
                } else {
                    $runtime = $source->runtime();
                }
                $runtime = intval($runtime);

                if ($isPremiere_world) {
                    $premiere_world = $parsed->premiere_world();
                } else {
                    $premiere_world = $source->premiere_world();
                }
                if (empty($premiere_world)) {
                    $premiere_world = 'null';
                } else {
                    $premiere_world = $this->db->real_escape_string($premiere_world);
                    $premiere_world = '\'' . $premiere_world . '\'';
                }

                if ($isPremiere_ru) {
                    $premiere_ru = $parsed->premiere_ru();
                } else {
                    $premiere_ru = $source->premiere_ru();
                }
                if (empty($premiere_ru)) {
                    $premiere_ru = 'null';
                } else {
                    $premiere_ru = $this->db->real_escape_string($premiere_ru);
                    $premiere_ru = '\'' . $premiere_ru . '\'';
                }

                if ($isPremiere_usa) {
                    $premiere_usa = $parsed->premiere_usa();
                } else {
                    $premiere_usa = $source->premiere_usa();
                }
                if (empty($premiere_usa)) {
                    $premiere_usa = 'null';
                } else {
                    $premiere_usa = $this->db->real_escape_string($premiere_usa);
                    $premiere_usa = '\'' . $premiere_usa . '\'';
                }

                if ($isLimit_us) {
                    $limit_us = $parsed->limit_us();
                } else {
                    $limit_us = $source->limit_us();
                }
                $limit_us = $this->db->real_escape_string($limit_us);

                if ($isBudget) {
                    $budget = $parsed->budget();
                } else {
                    $budget = $source->budget();
                }
                $budget = floatval($budget);

                if ($isSeries_count) {
                    $series_count = $parsed->series_count();
                } else {
                    $series_count = $source->series_count();
                }
                $series_count = intval($series_count);

                if ($isYear_finish) {
                    $year_finish = $parsed->year_finish();
                } else {
                    $year_finish = $source->year_finish();
                }
                $year_finish = intval($year_finish);

                $query = "UPDATE `film` SET
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '{$name_ru}',
                    `country` = '{$country}',
                    `year` = {$year},
                    `genre` = '{$genre}',
                    `type` = '{$type}',
                    `runtime` = {$runtime},
                    `premiere_world` = {$premiere_world},
                    `premiere_ru` = {$premiere_ru},
                    `premiere_usa` = {$premiere_usa},
                    `limit_us` = '{$limit_us}',
                    `budget` = '{$budget}',
                    `series_count` = {$series_count},
                    `year_finish` = {$year_finish}
                    WHERE `id`  = {$id} LIMIT 1
                ";
                $this->db->query($query);

                $this->db->query("DELETE FROM `film_country` WHERE `filmId` = {$id}}");
                $country = explode(',', $country);
                foreach ($country as $code) {
                    $code = trim($code);
                    if (!empty($code)) {
                        $this->db->query("INSERT INTO `film_country` SET `filmId` = {$id}, `country` = '{$code}'");
                    }
                }

                $this->db->query("DELETE FROM `film_genre` WHERE `filmId` = {$id}}");
                $genre = explode(',', $genre);
                foreach ($genre as $code) {
                    $code = trim($code);
                    if (!empty($code)) {
                        $this->db->query("INSERT INTO `film_genre` SET `filmId` = {$id}, `genre` = '{$code}'");
                    }
                }
            }
        }

        if (0 < $id && ($isImdb || $isImdb_count)) {
            if ('kp' == $parserType) {
                $result = $this->db->query("SELECT `kp`, `kp_count` FROM `film_stat` WHERE `filmId` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $value = $row['kp'];
                    if ($isImdb) {
                        $value = $parsed->imdb();
                    }
                    $value = floatval($value);

                    $count = $row['kp_count'];
                    if ($isImdb_count) {
                        $count = $parsed->imdb_count();
                    }
                    $count = intval($count);

                    $this->db->query("UPDATE `film_stat` SET `kp` = {$value}, `kp_count` = {$count} WHERE `filmId` = {$id} LIMIT 1");
                } else {
                    $value = 0;
                    if ($isImdb) {
                        $value = $parsed->imdb();
                    }
                    $value = floatval($value);

                    $count = 0;
                    if ($isImdb_count) {
                        $count = $parsed->imdb_count();
                    }
                    $count = intval($count);

                    $this->db->query("INSERT INTO `film_stat` SET `filmId` = {$id}, `rate` = 0, `rate_count` = 0, `imdb` = 0, `imdb_count` = 0, `kp` = {$value}, `kp_count` = {$count}, 
                                      `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0");
                }
            } elseif ('imdb' == $parserType) {
                $result = $this->db->query("SELECT `imdb`, `imdb_count` FROM `film_stat` WHERE `filmId` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $value = $row['imdb'];
                    if ($isImdb) {
                        $value = $parsed->imdb();
                    }
                    $value = floatval($value);

                    $count = $row['imdb_count'];
                    if ($isImdb_count) {
                        $count = $parsed->imdb_count();
                    }
                    $count = intval($count);

                    $this->db->query("UPDATE `film_stat` SET `imdb` = {$value}, `imdb_count` = {$count} WHERE `filmId` = {$id} LIMIT 1");
                } else {
                    $value = 0;
                    if ($isImdb) {
                        $value = $parsed->imdb();
                    }
                    $value = floatval($value);

                    $count = 0;
                    if ($isImdb_count) {
                        $count = $parsed->imdb_count();
                    }
                    $count = intval($count);

                    $this->db->query("INSERT INTO `film_stat` SET `filmId` = {$id}, `rate` = 0, `rate_count` = 0, `imdb` = {$value}, `imdb_count` = {$count}, `kp` = 0, `kp_count` = 0, 
                                      `poster` = 0, `frame` = 0, `wallpaper` = 0, `trailer` = 0, `soundtrack` = 0, `award` = 0");
                }
            }
        }

        $castListAccepted = $post->fetch('castList');
        if (!is_array($castListAccepted)) {
            $castListAccepted = [];
        }
        if ($isCast && 0 < $id) {
            $order = 0;
            foreach ($parsed->cast() as $personId => $cast) {
                $order++;

                $personId = intval($personId);
                if (0 < count($castListAccepted) && !in_array($personId, $castListAccepted)) {
                    continue;
                }
                $sourceId = $personId;
                $name_origin = '';
                $name_ru = '';

                switch ($parserType) {
                    case 'kp':
                        $name_origin = $cast[2];
                        $name_ru = $cast[0];
                        break;
                    case 'kt':
                        $name_ru = $cast[0];
                        break;
                    default:
                        $name_origin = $cast[0];
                }

                if (0 < $personId) {
                    switch ($parserType) {
                        case 'kp':
                            $query = "SELECT `id` FROM `person` WHERE `id_kp` = {$personId} LIMIT 1";
                            break;
                        case 'kt':
                            $query = "SELECT `id` FROM `person` WHERE `id_kt` = {$personId} LIMIT 1";
                            break;
                        default:
                            $query = "SELECT `id` FROM `person` WHERE `id_imdb` = {$personId} LIMIT 1";
                    }
                    $result = $this->db->query($query);
                    if ($row = $result->fetch_assoc()) {
                        $personId = $row['id'];
                    } else {
                        if (empty($name_origin) && empty($name_ru)) {
                            continue;
                        }
                        $tempName = $name_origin;
                        if (empty($tempName)) {
                            $tempName = $name_ru;
                        }
                        $personIdTemp = $this->getPersonIdByName($tempName);
                        if (0 == $personIdTemp) {
                            $id_imdb = 0;
                            $id_kp = 0;
                            $id_kt = 0;
                            switch ($parserType) {
                                case 'kp':
                                    $id_kp = $personId;
                                    break;
                                case 'kt':
                                    $id_kt = $personId;
                                    break;
                                default:
                                    $id_imdb = $personId;
                            }

                            $name_origin = $this->db->real_escape_string($name_origin);
                            $name_ru = $this->db->real_escape_string($name_ru);
                            $query = "INSERT INTO `person` SET 
                                            `s` = 0,
                                            `image` = '',
                                            `status` = 'new',
                                            `name_origin` = '{$name_origin}',
                                            `name_ru` = '{$name_ru}',
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
                                            `id_imdb` = {$id_imdb},
                                            `id_kp` = {$id_kp},
                                            `id_kt` = {$id_kt},
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
                                print_r($this->error);exit;
                                return false;
                            }
                        } else {
                            $personId = $personIdTemp;
                        }
                    }

                    switch ($parserType) {
                        case 'kp':
                            $this->db->query("UPDATE `person` SET `id_kp` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
                            break;
                        case 'kt':
                            $this->db->query("UPDATE `person` SET `id_kt` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
                            break;
                        default:
                            $this->db->query("UPDATE `person` SET `id_imdb` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
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
                    
                    $result = $this->db->query("SELECT `id` FROM `film_cast` WHERE `filmId` = {$id} AND `personId` = {$personId} LIMIT 1");
                    if (0 == $result->num_rows) {
                        $this->db->query("INSERT INTO `film_cast` SET 
                                          `filmId` = {$id}, `personId` = {$personId}, `role_ru` = '{$role_ru}',
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
                    foreach ($crewList as $personId => $crew) {
                        $order++;

                        $personId = intval($personId);
                        if (0 < count($crewListAccepted) && !in_array($personId, $crewListAccepted)) {
                            continue;
                        }
                        $sourceId = $personId;
                        $name_origin = '';
                        $name_ru = '';

                        switch ($parserType) {
                            case 'kp':
                                $name_origin = $crew[1];
                                $name_ru = $crew[0];
                                break;
                            case 'kt':
                                $name_ru = $crew[0];
                                break;
                            default:
                                $name_origin = $crew[0];
                        }

                        if (0 < $personId) {
                            switch ($parserType) {
                                case 'kp':
                                    $query = "SELECT `id` FROM `person` WHERE `id_kp` = {$personId} LIMIT 1";
                                    break;
                                case 'kt':
                                    $query = "SELECT `id` FROM `person` WHERE `id_kt` = {$personId} LIMIT 1";
                                    break;
                                default:
                                    $query = "SELECT `id` FROM `person` WHERE `id_imdb` = {$personId} LIMIT 1";
                            }
                            $result = $this->db->query($query);
                            if ($row = $result->fetch_assoc()) {
                                $personId = $row['id'];
                            } else {
                                if (empty($name_origin) && empty($name_ru)) {
                                    continue;
                                }
                                $tempName = $name_origin;
                                if (empty($tempName)) {
                                    $tempName = $name_ru;
                                }
                                $personIdTemp = $this->getPersonIdByName($tempName);
                                if (0 == $personIdTemp) {
                                    $id_imdb = 0;
                                    $id_kp = 0;
                                    $id_kt = 0;
                                    switch ($parserType) {
                                        case 'kp':
                                            $id_kp = $personId;
                                            break;
                                        case 'kt':
                                            $id_kt = $personId;
                                            break;
                                        default:
                                            $id_imdb = $personId;
                                    }

                                    $name_origin = $this->db->real_escape_string($name_origin);
                                    $name_ru = $this->db->real_escape_string($name_ru);
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
                                            `name_origin` = '{$name_origin}',
                                            `name_ru` = '{$name_ru}',
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
                                            `id_imdb` = {$id_imdb},
                                            `id_kp` = {$id_kp},
                                            `id_kt` = {$id_kt},
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
                                } else {
                                    $personId = $personIdTemp;
                                }
                            }

                            switch ($parserType) {
                                case 'kp':
                                    $this->db->query("UPDATE `person` SET `id_kp` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
                                    break;
                                case 'kt':
                                    $this->db->query("UPDATE `person` SET `id_kt` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
                                    break;
                                default:
                                    $this->db->query("UPDATE `person` SET `id_imdb` = {$sourceId} WHERE `id` = {$personId} LIMIT 1");
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

                            $result = $this->db->query("SELECT `id` FROM `film_crew` WHERE `filmId` = {$id} AND `personId` = {$personId} LIMIT 1");
                            if (0 == $result->num_rows) {
                                $this->db->query("INSERT INTO `film_crew` SET 
                                              `filmId` = {$id}, `personId` = {$personId}, `type` = '{$type}',
                                              `description` = '{$description}', `episodes` = {$episodes}, `year` = '{$year}', `source` = '{$source}', `order` = {$order}
                                              ");
                            }
                        }
                    }
                }
            }
        }

        if (0 < $id && $isImage) {
            if (!empty($parsed->image())) {
                $static = new StaticS();
                $data = json_decode($static->upload('film', '1920x1920', $id, $parsed->image()), true);

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
                        $this->mysql()->query("UPDATE `film` SET `s` = {$s}, `image` = '{$data['ex']}' WHERE `id` = {$id} LIMIT 1");
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

    private function getPersonIdByName($search)
    {
        iconv(mb_detect_encoding($search, mb_detect_order(), true), "UTF-8", $search);
        $search = preg_replace('/[^0-9a-zA-ZА-Яа-яёЁ_ -]+/u', '', $search);
        $search = str_replace('&nbsp;', ' ', $search);
        $search = trim($search);
        $search = trim($search, "\xC2\xA0");
        $search = trim($search, "\xC2\xA0\n");
        $search = $this->sphinx()->real_escape_string($search);
        $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
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

        $result = $this->db->query("SELECT `id` FROM `person` WHERE `id` IN ({$idList}) ORDER BY `id` LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }

        return 0;
    }
}