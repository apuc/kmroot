<?php
namespace Kinomania\Original\Logic\Film;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Film
 * @package Kinomania\Original\Film
 */
class Film
{
    use TRepository;
    use TDate;

    /**
     * @param int  $filmId
     * @return array
     */
    public function get($filmId)
    {
        $this->item = [];

        $filmId = intval($filmId);
        $result = $this->mysql()->query("SELECT 
                                            t1.`id`, t1.`s`, t1.`image`, t1.`status`, t1.`name_origin`, t1.`name_ru`, t1.`type`, 
                                            t1.`country`, t1.`year`, t1.`genre`, t1.`runtime`, t1.`premiere_world`, t1.`premiere_ru`, t1.`premiere_usa`,
                                            t1.`limit_us`, t1.`limit_ru`, t1.`budget`, t1.`season_count`, t1.`series_count`, t1.`year_finish`, t1.`preview`, t1.`fact`, t1.`id_kp`, 
                                            t2.`rate`, t2.`rate_count`, t2.`imdb`, t2.`imdb_count`, t2.`kp`, t2.`kp_count`
                                            FROM `film` as `t1`
                                            LEFT JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId` 
                                            WHERE t1.`id` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (Wrap::$debugEnabled || 'show' == $row['status']) {
                $this->item[\Kinomania\Original\Key\Film\Film::S] = $row['s'];
                $this->item[\Kinomania\Original\Key\Film\Film::IMAGE] = $row['image'];
                $this->item[\Kinomania\Original\Key\Film\Film::NAME_ORIGIN] = $row['name_origin'];
                $this->item[\Kinomania\Original\Key\Film\Film::NAME_RU] = $row['name_ru'];
                $this->item[\Kinomania\Original\Key\Film\Film::COUNTRY] = $row['country'];
                $this->item[\Kinomania\Original\Key\Film\Film::YEAR] = $row['year'];
                $this->item[\Kinomania\Original\Key\Film\Film::GENRE] = $row['genre'];
                $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME] = $row['runtime'];
                $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_WORLD] = $row['premiere_world'];
                $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_RU] = $row['premiere_ru'];
                $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_USA] = $row['premiere_usa'];
                $this->item[\Kinomania\Original\Key\Film\Film::LIMIT_US] = $row['limit_us'];
                $this->item[\Kinomania\Original\Key\Film\Film::LIMIT_RU] = $row['limit_ru'];
                $this->item[\Kinomania\Original\Key\Film\Film::BUDGET] = $row['budget'];
                $this->item[\Kinomania\Original\Key\Film\Film::SEASON_COUNT] = $row['season_count'];
                $this->item[\Kinomania\Original\Key\Film\Film::SERIES_COUNT] = $row['series_count'];
                $this->item[\Kinomania\Original\Key\Film\Film::YEAR_FINISH] = $row['year_finish'];
                $this->item[\Kinomania\Original\Key\Film\Film::TITLE] = $row['name_ru'];
                $this->item[\Kinomania\Original\Key\Film\Film::TYPE] = $row['type'];

                $this->item[\Kinomania\Original\Key\Film\Film::RATE] = $row['rate'];
                $this->item[\Kinomania\Original\Key\Film\Film::RATE_COUNT] = $row['rate_count'];
                $this->item[\Kinomania\Original\Key\Film\Film::IMDB] = $row['imdb'];
                $this->item[\Kinomania\Original\Key\Film\Film::IMDB_COUNT] = $row['imdb_count'];
                $this->item[\Kinomania\Original\Key\Film\Film::KP] = $row['kp'];
                $this->item[\Kinomania\Original\Key\Film\Film::KP_COUNT] = $row['kp_count'];
                $this->item[\Kinomania\Original\Key\Film\Film::ID_KP] = $row['id_kp'];

                /**
                 * Text.
                 */
                $this->preview($row);
                $this->fact($row);

                /**
                 * Gross.
                 */
                $this->gross($filmId);

                /**
                 * Budget.
                 */
                if (!empty($this->item[\Kinomania\Original\Key\Film\Film::BUDGET])) {
                    $this->item[\Kinomania\Original\Key\Film\Film::BUDGET] = number_format($this->item[\Kinomania\Original\Key\Film\Film::BUDGET] * 1000000, 0, '', ' ');
                }

                /**
                 * Company.
                 */
                $this->company($filmId);

                /**
                 * Title.
                 */
                if (!empty($this->item[\Kinomania\Original\Key\Film\Film::NAME_ORIGIN])) {
                    if (empty($this->item[\Kinomania\Original\Key\Film\Film::TITLE])) {
                        $this->item[\Kinomania\Original\Key\Film\Film::TITLE] = $this->item[\Kinomania\Original\Key\Film\Film::NAME_ORIGIN];
                    } else {
                        $this->item[\Kinomania\Original\Key\Film\Film::TITLE] .= ' | ' . $this->item[\Kinomania\Original\Key\Film\Film::NAME_ORIGIN];
                    }
                }

                /**
                 * Country.
                 */
                $this->item[\Kinomania\Original\Key\Film\Film::COUNTRY] = explode(',', $this->item[\Kinomania\Original\Key\Film\Film::COUNTRY]);

                /**
                 * Genre.
                 */
                $this->item[\Kinomania\Original\Key\Film\Film::GENRE] = explode(',', $this->item[\Kinomania\Original\Key\Film\Film::GENRE]);

                /**
                 * Run time.
                 */
                $this->runtime();

                /**
                 * Premier.
                 */
                $this->premier();

                /**
                 * Block.
                 */
                $this->block();

                /**
                 * Trailer.
                 */
                $this->trailer($filmId);
            }
        }

        return $this->item;
    }

    /**
     * Film cast.
     * @param $filmId
     * @return array
     */
    public function cast($filmId)
    {
        $filmId = intval($filmId);

        $cast = [];
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_cast` WHERE `filmId` = {$filmId} ORDER BY `order` LIMIT 16) as `t` 
                                         JOIN `film_cast` as `t1` ON t.`id` = t1.`id` 
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t2.`status` = 'show' LIMIT 8");
        while ($row = $result->fetch_assoc()) {
            $actor = [];

            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.34.44.' . $row['image'];
            }

            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }

            $actor[0] = $row['id'];
            $actor[1] = $image;
            $actor[2] = $name;
            $cast[] = $actor;
        }

        return $cast;
    }

    /**
     * Film crew.
     * @param $filmId
     * @return array
     */
    public function crew($filmId)
    {
        $filmId = intval($filmId);

        $crew = [];

        $typeList = ['Режиссер', 'Сценарист', 'Продюсер', 'Оператор', 'Композитор'];

        foreach ($typeList as $type) {
            $result = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                         FROM (SELECT `id` FROM `film_crew` WHERE `filmId` = {$filmId} AND `type` = '{$type}' ORDER BY `order` LIMIT 9) as `t` 
                                         JOIN `film_crew` as `t1` ON t.`id` = t1.`id`
                                         JOIN `person` as `t2` ON t1.`personId` = t2.`id` 
                                         WHERE t2.`status` = 'show' LIMIT 3");
            $cnt = 0;
            while ($row = $result->fetch_assoc()) {
                $cnt++;
                $actor = [];

                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $actor[0] = $row['id'];
                if (3 == $cnt) {
                    $actor[0] = 0;
                }
                $actor[1] = $name;
                $crew[$type][] = $actor;
            }
        }

        return $crew;
    }

    /**
     * @param int $filmId
     */
    private function company($filmId)
    {
        $this->item[\Kinomania\Original\Key\Film\Film::COMPANY] = [];
        $result = $this->mysql()->query("SELECT `id`, `companyId`, `type` FROM `film_company_rel` WHERE `filmId` = {$filmId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $name = '';
            $result2 = $this->mysql()->query("SELECT `short_name`, `name` FROM `company` WHERE `id` = {$row['companyId']} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $name = $row2['short_name'];
                if (empty($name)) {
                    $name = $row2['name'];
                }
            }
            $this->item[\Kinomania\Original\Key\Film\Film::COMPANY][$row['id']] = [$row['type'], $row['companyId'], $name];
        }
    }

    /**
     * @param int $filmId
     */
    private function gross($filmId)
    {
        $this->item[\Kinomania\Original\Key\Film\Film::GROSS_WORLD] = 0;
        $this->item[\Kinomania\Original\Key\Film\Film::GROSS_RU] = 0;
        $this->item[\Kinomania\Original\Key\Film\Film::GROSS_USA] = 0;
        $result = $this->mysql()->query("SELECT `world`, `ru`, `usa` FROM `film_gross` WHERE `filmId` = {$filmId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (0 < $row['world']) {
                $this->item[\Kinomania\Original\Key\Film\Film::GROSS_WORLD] = number_format($row['world'], 0, '', ' ');
            }
            if (0 < $row['ru']) {
                $this->item[\Kinomania\Original\Key\Film\Film::GROSS_RU] = number_format($row['ru'], 0, '', ' ');
            }
            if (0 < $row['usa']) {
                $this->item[\Kinomania\Original\Key\Film\Film::GROSS_USA] = number_format($row['usa'], 0, '', ' ');
            }
        }
    }

    /**
     *
     */
    private function runtime()
    {
        if (0 < $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME]) {
            $minutes = $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME];
            $num = $minutes % 100;
            if ($num > 19) {
                $num = $num % 10;
            }
            switch ($num) {
                case 1:
                    $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME] .= ' минута';
                    break;
                case 2:
                case 3:
                case 4:
                    $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME] .= ' минуты';
                    break;
                default:
                    $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME] .= ' минут';
            }
            $hours = floor($minutes / 60);
            $minutes = ($minutes % 60);
            if (1 <= $hours) {
                if (10 > $minutes) {
                    $minutes = '0' . $minutes;
                }
                $this->item[\Kinomania\Original\Key\Film\Film::RUNTIME] .= ' (' . $hours . ':' . $minutes . ')';
            }
        }
    }

    /**
     *
     */
    private function premier()
    {
        if (!empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_WORLD])) {
            $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_WORLD] = $this->formatDate($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_WORLD]);
        }
        if (!empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_RU])) {
            $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_RU] = $this->formatDate($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_RU]);
        }
        if (!empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_USA])) {
            $this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_USA] = $this->formatDate($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_USA]);
        }
    }

    /**
     *
     */
    private function block()
    {
        $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_2] = true;
        $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_3] = true;
        $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_4] = true;

        if (empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_WORLD]) && empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_RU]) && empty($this->item[\Kinomania\Original\Key\Film\Film::PREMIERE_USA]) && empty($this->item[\Kinomania\Original\Key\Film\Film::LIMIT_RU]) && empty($this->item[\Kinomania\Original\Key\Film\Film::LIMIT_US]) && 0 == count($this->item[\Kinomania\Original\Key\Film\Film::COMPANY])) {
            $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_2] = false;
        }

        if (empty($this->item[\Kinomania\Original\Key\Film\Film::BUDGET]) && empty($this->item[\Kinomania\Original\Key\Film\Film::GROSS_WORLD]) && empty($this->item[\Kinomania\Original\Key\Film\Film::GROSS_RU]) && empty($this->item[\Kinomania\Original\Key\Film\Film::GROSS_USA])) {
            $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_3] = false;
        }

        if (empty($this->item[\Kinomania\Original\Key\Film\Film::SEASON_COUNT]) && empty($this->item[\Kinomania\Original\Key\Film\Film::SERIES_COUNT]) && empty($this->item[\Kinomania\Original\Key\Film\Film::YEAR_FINISH])) {
            $this->item[\Kinomania\Original\Key\Film\Film::IS_BLOCK_4] = false;
        }
    }



    /**
     * @param $filmId
     */
    private function trailer($filmId)
    {
        $filmId = intval($filmId);

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`filmId`, t1.`s`, t1.`image`, t1.`date`,
                                            t1.`hd480`, t1.`hd720`, t1.`hd1080`, t2.`name`, t4.`comment`
                                            FROM `trailer` AS `t1`
                                            JOIN `trailer_type` AS `t2` ON t1.`type` = t2.`id`
                                            LEFT JOIN `trailer_stat` AS `t4` ON t1.`id` = t4.`trailerId`
                                            WHERE t1.`filmId` = {$filmId} AND t1.`status` = 'show' ORDER BY t1.`local` DESC, t1.`id` DESC LIMIT 1
                                        ");
        if ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $item['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.750.425.' . $row['image'];
            } else {
                $item['image'] = Server::STATIC[0] . '/app/img/content/nl_nopic.jpg';
            }
            $item['id'] = $row['id'];
            $item['date'] = str_replace('-', '.', $row['date']);
            $item['name'] = $row['name'];
            $item['comment'] = $row['comment'];
            $item['hd480'] = $row['hd480'];
            $item['hd720'] = $row['hd720'];
            $item['hd1080'] = $row['hd1080'];

            if (0 == $item['comment']) {
                $item['comment'] = '';
            }

            $this->item[\Kinomania\Original\Key\Film\Film::TRAILER] = $item;
        }
    }

    /**
     * @param $row
     */
    private function preview(&$row)
    {
        $this->item[\Kinomania\Original\Key\Film\Film::PREVIEW] = '';
        $this->item[\Kinomania\Original\Key\Film\Film::PREVIEW_MORE] = false;

        $text = $row['preview'];
        if (empty(strip_tags($text))) {
            $text = '';
        }

        $more = mb_strlen(strip_tags($text), 'UTF-8');
        if ($more > 775) {
            $this->item[\Kinomania\Original\Key\Film\Film::PREVIEW_MORE] = true;
        }

        $this->item[\Kinomania\Original\Key\Film\Film::PREVIEW] = $text;
    }

    /**
     * @param $row
     */
    private function fact(&$row)
    {
        $this->item[\Kinomania\Original\Key\Film\Film::FACT] = '';
        $this->item[\Kinomania\Original\Key\Film\Film::FACT_MORE] = false;

        $text = $row['fact'];
        if (empty(strip_tags($text))) {
            $text = '';
        }

        $more = mb_strlen(strip_tags($text), 'UTF-8');
        if ($more > 775) {
            $this->item[\Kinomania\Original\Key\Film\Film::FACT_MORE] = true;
        }

        $this->item[\Kinomania\Original\Key\Film\Film::FACT] = $text;
    }

    private $item;
}