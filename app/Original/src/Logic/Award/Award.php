<?php
namespace Kinomania\Original\Logic\Award;

use Kinomania\Original\Key\Award\Nominee;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Award
 * @package Kinomania\Original\Award
 */
class Award
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function awards()
    {
        $list = [
            'award' => [],
            'festival' => []
        ];

        /**
         * Awards.
         */
        $result = $this->mysql()->query("SELECT `id`, `code`, `name_ru`, `name_en` FROM `awards` WHERE `type` = 'award' ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $result2 = $this->mysql()->query("SELECT `from`, `to` FROM `awards_year` WHERE `awardId` = {$row['id']} ORDER BY `year` DESC LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $row['from'] = $this->cutLast($this->formatDate($row2['from']));
                if (0 == $row['from']) {
                    $row['from'] = '';
                }
                $row['to'] = $this->cutLast($this->formatDate($row2['to']));
                if (0 == $row['to']) {
                    $row['to'] = '';
                }
            }
            
            $list['award'][] = [
                \Kinomania\Original\Key\Award\Award::ID => $row['id'],
                \Kinomania\Original\Key\Award\Award::CODE => $row['code'],
                \Kinomania\Original\Key\Award\Award::NAME_RU => $row['name_ru'],
                \Kinomania\Original\Key\Award\Award::NAME_EN => $row['name_en'],
                \Kinomania\Original\Key\Award\Award::FROM => $row['from'],
                \Kinomania\Original\Key\Award\Award::TO => $row['to'],
            ];
        }

        /**
         * Festivals.
         */
        $result = $this->mysql()->query("SELECT `id`, `code`, `name_ru`, `name_en` FROM `awards` WHERE `type` = 'festival' ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            $result2 = $this->mysql()->query("SELECT `from`, `to` FROM `awards_year` WHERE `awardId` = {$row['id']} ORDER BY `year` DESC LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $row['from'] = $this->cutLast($this->formatDate($row2['from']));
                if (0 == $row['from']) {
                    $row['from'] = '';
                }
                $row['to'] = $this->cutLast($this->formatDate($row2['to']));
                if (0 == $row['to']) {
                    $row['to'] = '';
                }
            }
            
            $list['festival'][] = [
                \Kinomania\Original\Key\Award\Award::ID => $row['id'],
                \Kinomania\Original\Key\Award\Award::CODE => $row['code'],
                \Kinomania\Original\Key\Award\Award::NAME_RU => $row['name_ru'],
                \Kinomania\Original\Key\Award\Award::NAME_EN => $row['name_en'],
                \Kinomania\Original\Key\Award\Award::FROM => $row['from'],
                \Kinomania\Original\Key\Award\Award::TO => $row['to'],
            ];
        }

        return $list;
    }

    /**
     * @param string $code
     * @return array
     */
    public function getByCode($code)
    {
        $item = [];

        $code = $this->mysql()->real_escape_string($code);
        $result = $this->mysql()->query("SELECT `id`, `code`, `name_ru`, `name_en`, `description`, `year` FROM `awards` WHERE `type` != 'hidden' AND `code` = '{$code}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $row['year'] = explode(',', $row['year']);
            $row['year'] = array_slice($row['year'], 0, 10);
            $row['title'] = urlencode($row['name_ru']);
            
            $item =  [
                \Kinomania\Original\Key\Award\Award::ID => $row['id'],
                \Kinomania\Original\Key\Award\Award::CODE => $row['code'],
                \Kinomania\Original\Key\Award\Award::NAME_RU => $row['name_ru'],
                \Kinomania\Original\Key\Award\Award::NAME_EN => $row['name_en'],
                \Kinomania\Original\Key\Award\Award::DESCRIPTION => $row['description'],
                \Kinomania\Original\Key\Award\Award::YEAR => $row['year'],
                \Kinomania\Original\Key\Award\Award::TITLE => $row['title'],
            ];;
        }

        return $item;
    }
    
    public function getList($code, $year)
    {
        $list = [
            'item' => [],
            'year' => $year,
            'award' => []
        ];

        $code = $this->mysql()->real_escape_string($code);
        $result = $this->mysql()->query("SELECT `id`, `code`, `name_ru`, `name_en`, `description`, `year` FROM `awards` WHERE `type` != 'hidden' AND `code` = '{$code}' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $awardId = $row['id'];

            $row['year'] = explode(',', $row['year']);
            $row['year'] = array_slice($row['year'], 0, 10);
            $row['title'] = urlencode($row['name_ru']);
            $list['item'] = [
                \Kinomania\Original\Key\Award\Award::ID => $row['id'],
                \Kinomania\Original\Key\Award\Award::CODE => $row['code'],
                \Kinomania\Original\Key\Award\Award::NAME_RU => $row['name_ru'],
                \Kinomania\Original\Key\Award\Award::NAME_EN => $row['name_en'],
                \Kinomania\Original\Key\Award\Award::DESCRIPTION => $row['description'],
                \Kinomania\Original\Key\Award\Award::YEAR => $row['year'],
                \Kinomania\Original\Key\Award\Award::TITLE => $row['title'],
            ];

            $result = $this->mysql()->query("SELECT 1 FROM `awards_year` WHERE `awardId` = {$awardId} AND `year` = {$year} LIMIT 1");
            if (0 < $result->num_rows) {

                $result = $this->mysql()->query("SELECT t1.`nominationId`, t1.`filmId`, t1.`personId`, t1.`win`, 
                                                    t2.`name_ru`, t2.`name_en`, t2.`type`, 
                                                    t3.`s` as `film_s`, t3.`image` as `film_image`, t3.`name_origin` as `film_origin`, t3.`name_ru` as `film_ru`, t3.`country`, t3.`year`, 
                                                    t4.`s` as `person_s`, t4.`image` as `person_image`, t4.`name_origin` as `person_origin`, t4.`name_ru` as `person_ru`
                                                    FROM (SELECT `id` FROM `awards_set` WHERE `awardId` = {$awardId} AND `year` = {$year} ORDER BY `nominationId` ASC, `win` DESC) as `t` 
                                                    JOIN `awards_set` as `t1` ON t1.`id` = t.`id` 
                                                    JOIN `awards_nomination` as `t2` ON t1.`nominationId` = t2.`id`
                                                    LEFT JOIN `film` as `t3` ON t1.`filmId` = t3.`id`
                                                    LEFT JOIN `person` as `t4` ON t1.`personId` = t4.`id`
                                                    ORDER BY t1.`nominationId` ASC, t1.`win` DESC
                    ");
                $first = true;
                while ($row = $result->fetch_assoc()) {
                    if ('film' == $row['type']) {
                        if ('' != $row['film_image']) {
                            $imageName = md5($row['filmId']);
                            $image = Server::STATIC[$row['film_s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.116.' . $row['film_image'];
                        } else {
                            $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
                        }
                    } else {
                        if ('' != $row['person_image']) {
                            $imageName = md5($row['personId']);
                            $image = Server::STATIC[$row['person_s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.116.' . $row['person_image'];
                        } else {
                            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
                        }
                    }
                    if ($first && 'false' == $row['win']) {
                        $first = false;
                        $list['award'][$row['nominationId']][] = [
                            Nominee::FILM_RU => '',
                            Nominee::FILM_ORIGIN => '',
                            Nominee::PERSON_RU => '',
                            Nominee::PERSON_ORIGIN => '',
                            Nominee::FILM_ID => 0,
                            Nominee::PERSON_ID => 0,
                            Nominee::TYPE => $row['type'],
                            Nominee::NAME_RU => '',
                            Nominee::NAME_EN => '',
                            Nominee::IMAGE => '',
                            Nominee::COUNTRY => [],
                            Nominee::YEAR => '',
                        ];
                        $list['award'][$row['nominationId']][] = [
                            Nominee::FILM_RU => $row['film_ru'],
                            Nominee::FILM_ORIGIN => $row['film_origin'],
                            Nominee::PERSON_RU => $row['person_ru'],
                            Nominee::PERSON_ORIGIN => $row['person_origin'],
                            Nominee::FILM_ID => $row['filmId'],
                            Nominee::PERSON_ID => $row['personId'],
                            Nominee::TYPE => $row['type'],
                            Nominee::NAME_RU => $row['name_ru'],
                            Nominee::NAME_EN => $row['name_en'],
                            Nominee::IMAGE => $image,
                            Nominee::COUNTRY => explode(',', $row['country']),
                            Nominee::YEAR => $row['year'],
                        ];
                    } else {
                        $list['award'][$row['nominationId']][] = [
                            Nominee::FILM_RU => $row['film_ru'],
                            Nominee::FILM_ORIGIN => $row['film_origin'],
                            Nominee::PERSON_RU => $row['person_ru'],
                            Nominee::PERSON_ORIGIN => $row['person_origin'],
                            Nominee::FILM_ID => $row['filmId'],
                            Nominee::PERSON_ID => $row['personId'],
                            Nominee::TYPE => $row['type'],
                            Nominee::NAME_RU => $row['name_ru'],
                            Nominee::NAME_EN => $row['name_en'],
                            Nominee::IMAGE => $image,
                            Nominee::COUNTRY => explode(',', $row['country']),
                            Nominee::YEAR => $row['year'],
                        ];
                    }
                }
            }
        }
        
        return $list;
    }



    private function cutLast($input)
    {
        $input = explode('&nbsp;', $input);
        unset($input[count($input) - 1]);
        return implode('&nbsp;', $input);
    }
}