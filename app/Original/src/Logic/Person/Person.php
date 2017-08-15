<?php
namespace Kinomania\Original\Logic\Person;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Person\Filmography;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Person
 * @package Kinomania\Original\Person
 */
class Person
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @return array
     */
    public function get($personId)
    {
        $this->item = [];
        $personId = intval($personId);

        $result = $this->mysql()->query("SELECT 
                                            `s`, `image`, `status`, `name_origin`, `name_ru`, 
                                            `actor`, `director`, `screenwriter`, `producer`, `composer`, `operator`,
                                            `birthday`, `death`, `birthplace_en`, `birthplace_ru`, `height`,
                                             `education`, `theater`, `award`, `info`, `biography`, `award_list`, `match`
                                            FROM `person` WHERE `id` = {$personId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (Wrap::$debugEnabled || 'show' == $row['status']) {
                if (empty($row['birthplace_ru'])) {
                    $row['birthplace_ru'] = $row['birthplace_en'];
                }

                $this->item[\Kinomania\Original\Key\Person\Person::S] = $row['s'];
                $this->item[\Kinomania\Original\Key\Person\Person::IMAGE] = $row['image'];
                $this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN] = $row['name_origin'];
                $this->item[\Kinomania\Original\Key\Person\Person::NAME_RU] = $row['name_ru'];
                $this->item[\Kinomania\Original\Key\Person\Person::ACTOR] = $row['actor'];
                $this->item[\Kinomania\Original\Key\Person\Person::DIRECTOR] = $row['director'];
                $this->item[\Kinomania\Original\Key\Person\Person::SCREENWRITER] = $row['screenwriter'];
                $this->item[\Kinomania\Original\Key\Person\Person::PRODUCER] = $row['producer'];
                $this->item[\Kinomania\Original\Key\Person\Person::COMPOSER] = $row['composer'];
                $this->item[\Kinomania\Original\Key\Person\Person::OPERATOR] = $row['operator'];
                $this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY] = $row['birthday'];
                $this->item[\Kinomania\Original\Key\Person\Person::DEATH] = $row['death'];
                $this->item[\Kinomania\Original\Key\Person\Person::BIRTHPLACE_RU] = $row['birthplace_ru'];
                $this->item[\Kinomania\Original\Key\Person\Person::HEIGHT] = $row['height'];
                $this->item[\Kinomania\Original\Key\Person\Person::AWARD_LIST] = [];
                $this->item[\Kinomania\Original\Key\Person\Person::MATCH_ID] = 0;
                $this->item[\Kinomania\Original\Key\Person\Person::TITLE] = $row['name_ru'];
                $this->item[\Kinomania\Original\Key\Person\Person::NEWS] = [];

                /**
                 * Award list.
                 */
                $this->awardList($row['award_list']);

                /**
                 * Title.
                 */
                if (3 > mb_strlen($this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN], 'UTF-8')) {
                    $this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN] = '';
                }
                if (!empty($this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN])) {
                    if (empty($this->item[\Kinomania\Original\Key\Person\Person::TITLE])) {
                        $this->item[\Kinomania\Original\Key\Person\Person::TITLE] =  $this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN];
                    } else {
                        $this->item[\Kinomania\Original\Key\Person\Person::TITLE] .= ' / ' . $this->item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN] . ' / ';
                    }
                }

                /**
                 * Match.
                 */
                $this->match($row['match']);

                /**
                 * Profession.
                 */
                $this->item[\Kinomania\Original\Key\Person\Person::IS_PROFESSION] = false;
                if ('yes' == $row['actor'] || 'yes' == $row['director'] || 'yes' == $row['screenwriter'] || 'yes' == $row['producer'] || 'yes' == $row['composer'] || 'yes' == $row['operator']) {
                    $this->item[\Kinomania\Original\Key\Person\Person::IS_PROFESSION] = true;
                }

                /**
                 * Birthday.
                 */
                if (!empty($this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY])) {
                    $this->birthday();
                }

                /**
                 * Death.
                 */
                if (!empty($this->item[\Kinomania\Original\Key\Person\Person::DEATH])) {
                    $this->death($row['birthday']);
                }

                /**
                 * Text.
                 */
                $this->text($row);
            }
        }

        return $this->item;
    }

    /**
     * @param int $personId
     * @return array
     */
    public function filmography($personId)
    {
        $list = [];
        $list['Актер'] = [];
        $result = $this->mysql()->query("SELECT t1.`role_ru`, t1.`role_en`, t2.`id`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t2.`s`, t2.`image`, t3.`rate`, t3.`rate_count` 
                                        FROM (SELECT `id` FROM `film_cast` WHERE `personId` = {$personId}) as `t` 
                                        JOIN `film_cast` as `t1` ON t.`id` = t1.`id` 
                                        JOIN `film` as `t2` ON t1.`filmId` = t2.`id`  
                                        LEFT JOIN `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_row()) {
            if ('' != $row[7]) {
                $imageName = md5($row[2]);
                $row[7] = Server::STATIC[$row[6]] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row[7];
            } else {
                $row[7] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row[9]) {
                $row[8] = 0;
            }

            if (0 == $row[5]) {
                $row[5] = '&nbsp;';
            }

            $list['Актер'][] = $row;
        }

        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` FROM 
                                        (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} AND `type` = 'Режиссер') as `t` JOIN 
                                        `film_crew` as `t1` ON t1.`id` = t.`id` JOIN
                                        `film` as `t2` ON t1.`filmId` = t2.`id` LEFT JOIN 
                                        `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }

            if (0 == $row['year']) {
                $row['year'] = '&nbsp;';
            }

            $item = [];
            $item[Filmography::ID] = $row['id'];
            $item[Filmography::NAME_ORIGIN] = $row['name_origin'];
            $item[Filmography::NAME_RU] = $row['name_ru'];
            $item[Filmography::YEAR] = $row['year'];
            $item[Filmography::IMAGE] = $row['image'];
            $item[Filmography::RATE] = $row['rate'];
            $list['Режиссер'][] = $item;
        }
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` FROM 
                                        (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} AND `type` = 'Сценарист') as `t` JOIN 
                                        `film_crew` as `t1` ON t1.`id` = t.`id` JOIN
                                        `film` as `t2` ON t1.`filmId` = t2.`id` LEFT JOIN 
                                        `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }

            if (0 == $row['year']) {
                $row['year'] = '&nbsp;';
            }

            $item = [];
            $item[Filmography::ID] = $row['id'];
            $item[Filmography::NAME_ORIGIN] = $row['name_origin'];
            $item[Filmography::NAME_RU] = $row['name_ru'];
            $item[Filmography::YEAR] = $row['year'];
            $item[Filmography::IMAGE] = $row['image'];
            $item[Filmography::RATE] = $row['rate'];
            $list['Сценарист'][] = $item;
        }
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` FROM 
                                        (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} AND `type` = 'Продюсер') as `t` JOIN 
                                        `film_crew` as `t1` ON t1.`id` = t.`id` JOIN
                                        `film` as `t2` ON t1.`filmId` = t2.`id` LEFT JOIN 
                                        `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }

            if (0 == $row['year']) {
                $row['year'] = '&nbsp;';
            }

            $item = [];
            $item[Filmography::ID] = $row['id'];
            $item[Filmography::NAME_ORIGIN] = $row['name_origin'];
            $item[Filmography::NAME_RU] = $row['name_ru'];
            $item[Filmography::YEAR] = $row['year'];
            $item[Filmography::IMAGE] = $row['image'];
            $item[Filmography::RATE] = $row['rate'];
            $list['Продюсер'][] = $item;
        }
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` FROM 
                                        (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} AND `type` = 'Оператор') as `t` JOIN 
                                        `film_crew` as `t1` ON t1.`id` = t.`id` JOIN
                                        `film` as `t2` ON t1.`filmId` = t2.`id` LEFT JOIN 
                                        `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }

            if (0 == $row['year']) {
                $row['year'] = '&nbsp;';
            }

            $item = [];
            $item[Filmography::ID] = $row['id'];
            $item[Filmography::NAME_ORIGIN] = $row['name_origin'];
            $item[Filmography::NAME_RU] = $row['name_ru'];
            $item[Filmography::YEAR] = $row['year'];
            $item[Filmography::IMAGE] = $row['image'];
            $item[Filmography::RATE] = $row['rate'];
            $list['Оператор'][] = $item;
        }
        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` FROM 
                                        (SELECT `id` FROM `film_crew` WHERE `personId` = {$personId} AND `type` = 'Композитор') as `t` JOIN 
                                        `film_crew` as `t1` ON t1.`id` = t.`id` JOIN
                                        `film` as `t2` ON t1.`filmId` = t2.`id` LEFT JOIN 
                                        `film_stat` as `t3` ON t2.`id` = t3.`filmId`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }

            if (0 == $row['year']) {
                $row['year'] = '&nbsp;';
            }

            $item = [];
            $item[Filmography::ID] = $row['id'];
            $item[Filmography::NAME_ORIGIN] = $row['name_origin'];
            $item[Filmography::NAME_RU] = $row['name_ru'];
            $item[Filmography::YEAR] = $row['year'];
            $item[Filmography::IMAGE] = $row['image'];
            $item[Filmography::RATE] = $row['rate'];
            $list['Композитор'][] = $item;
        }

        return $list;
    }

    /**
     * @param string $award_list
     */
    private function awardList($award_list)
    {
        $awardList = explode(';', $award_list);
        $this->item[\Kinomania\Original\Key\Person\Person::AWARD_TOTAL] = 0;
        foreach ($awardList as $award) {
            $award = explode(':', $award);
            if (!isset($award[1])) {
                break;
            }
            $awardId = intval($award[0]);
            $this->item[\Kinomania\Original\Key\Person\Person::AWARD_TOTAL] += $award[2];
            $name_ru = '';
            $name_en = '';

            $result2 = $this->mysql()->query("SELECT `name_ru`, `name_en` FROM `awards` WHERE `id` = {$awardId} LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $name_ru = $row2['name_ru'];
                $name_en = $row2['name_en'];
            }

            $this->item[\Kinomania\Original\Key\Person\Person::AWARD_LIST][] = [$awardId, $name_ru, $name_en, $award[1], $award[2]];
        }
    }

    /**
     * @param int $match
     */
    private function match($match)
    {
        $match = intval($match);
        if (0 < $match) {
            $result = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `person` WHERE `id` = {$match} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $this->item[\Kinomania\Original\Key\Person\Person::MATCH_ID] = $match;
                if (empty($row['name_ru'])) {
                    $this->item[\Kinomania\Original\Key\Person\Person::MATCH_NAME] = $row['name_origin'];
                } else {
                    $this->item[\Kinomania\Original\Key\Person\Person::MATCH_NAME] = $row['name_ru'];
                }
            }
        }
    }

    /**
     * Birthday data.
     */
    private function birthday()
    {
        $year = '';
        if (empty($this->item[\Kinomania\Original\Key\Person\Person::DEATH])) {
            $year = date_diff(date_create($this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY]), date_create('today'))->y;
            $num = $year % 100;
            if ($num > 19) {
                $num = $num % 10;
            }
            switch ($num) {
                case 1:
                    $year .= ' год';
                    break;
                case 2:
                case 3:
                case 4:
                    $year .= ' года';
                    break;
                default:
                    $year .= ' лет';
            }
        }
        $this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY] = $this->formatDate($this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY]);
        if (!empty($year)) {
            $this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY] .= ' (' . $year . ')';
        }
    }

    /**
     * @param string $birthday
     */
    private function death($birthday)
    {
        $year = '';
        if (!empty($this->item[\Kinomania\Original\Key\Person\Person::BIRTHDAY])) {
            $year = date_diff(date_create($this->item[\Kinomania\Original\Key\Person\Person::DEATH]), date_create($birthday))->y;
            $num = $year % 100;
            if ($num > 19) {
                $num = $num % 10;
            }
            switch ($num) {
                case 1:
                    $year .= ' год';
                    break;
                case 2:
                case 3:
                case 4:
                    $year .= ' года';
                    break;
                default:
                    $year .= ' лет';
            }
        }
        $this->item[\Kinomania\Original\Key\Person\Person::DEATH] = $this->formatDate($this->item[\Kinomania\Original\Key\Person\Person::DEATH]);
        if (!empty($year)) {
            $this->item[\Kinomania\Original\Key\Person\Person::DEATH] .= ' (' . $year . ')';
        }
    }

    private function text(&$row)
    {
        $this->item[\Kinomania\Original\Key\Person\Person::TEXT] = '';
        $this->item[\Kinomania\Original\Key\Person\Person::TEXT_MORE] = false;

        $text = $row['biography'];
        if (!empty(strip_tags($text))) {
            $text .= '<br />';
        }
        /**
         * Education.
         */
        if (!empty(strip_tags($row['education']))) {
            $text .= '<h3>ОБРАЗОВАНИЕ</h3><br />';
            $education = explode('_;_', $row['education']);
            $text .= '<p>';
            foreach ($education as $item) {
                $item = explode('_:_', $item);
                if (!empty($item[0])) {
                    $text .= '<b>' . $item[0] . '</b>';
                }
                if (!empty($item[3])) {
                    $text .= ', ' . $item[3];
                    if (!empty($item[4])) {
                        $text .= ' - ' . $item[4];
                    }
                }
                if (!empty($item[1])) {
                    $text .= ', факультет: ' . $item[1];
                }
                if (!empty($item[2])) {
                    $text .= ', мастерская: ' . $item[2];
                }
                if (!empty($item[3])) {
                    $text .= ' ' . $item[3];
                }
                $text .= '<br />';
            }
            $text .= '</p><br />';
        }

        /**
         * Theatre.
         */
        if (!empty(strip_tags($row['theater']))) {
            $text .= '<h3>ТЕАТРАЛЬНЫЕ РАБОТЫ</h3><br />';
            $education = explode('_;_', $row['theater']);
            $text .= '<p>';
            foreach ($education as $item) {
                $item = explode('_:_', $item);

                if (!empty($item[0])) {
                    $text .= '<b>' . $item[0] . '</b>';
                }
                if (!empty($item[2])) {
                    $text .= ', ' . $item[2];
                    if (!empty($item[3])) {
                        $text .= ' - ' . $item[3];
                    }
                }
                if (!empty($item[1])) {
                    $text .= ', спектаткли: ' . $item[1];
                }
                $text .= '<br />';
            }
            $text .= '</p><br />';
        }

        if (!empty(strip_tags($row['award']))) {
            $text .= '<h3>НАГРАДЫ</h3><br />';
            $text .= '<p>';
            $text .= $row['award'];
            $text .= '</p><br />';
        }

        if (!empty(strip_tags($row['info']))) {
            $text .= '<h3>ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ</h3><br />';
            $text .= '<p>';
            $text .= $row['info'];
            $text .= '</p><br />';
        }

        $more = mb_strlen(strip_tags($text), 'UTF-8');
        if ($more > 775) {
            $this->item[\Kinomania\Original\Key\Person\Person::TEXT_MORE] = true;
        }

        $this->item[\Kinomania\Original\Key\Person\Person::TEXT] = $text;
    }

    /**
     * @param $personId
     * @return array
     */
    public function news($personId)
    {
        $personId = intval($personId);
        $news = [];

        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`category`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM
                                              `news_link` as `t` JOIN   
                                              `news` as `t1` ON t.`newsId` = t1.`id`
                                              LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                              WHERE t.`personId` = {$personId} AND t1.`status` = 'show' ORDER BY t1.`publish` DESC LIMIT 3
                                            ");
        while ($row = $result->fetch_assoc()) {
            switch ($row['category']) {
                case 'Новости кино':
                    $row['category'] = 'news';
                    break;
                case 'Зарубежные сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Российские сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Арткиномания':
                    $row['category'] = 'news';
                    break;
                case 'Фестивали и премии':
                    $row['category'] = 'news';
                    break;
                default:
                    $row['category'] = 'article';
            }
            $row['publish'] = $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">');
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.235.160.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nnc.jpg';
            }
            $news[] = $row;
        }

        return $news;
    }

    protected $item;
}