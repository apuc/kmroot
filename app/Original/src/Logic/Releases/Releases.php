<?php
namespace Kinomania\Original\Logic\Releases;

use Kinomania\Original\Key\Film\Release;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Releases
 * @package Kinomania\Original\Releases
 */
class Releases
{
    use TRepository;
    use TDate;

    /**
     * @return array
     */
    public function getUsaList()
    {
        $list = [];

        $from = date('Y-m-01');
        $to = date('Y-m-t');
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t1.`country`, t1.`year`, t1.`genre`,
                                            t1.`premiere_usa`, t4.`rate`
                                            FROM `film` as `t1`
                                            LEFT JOIN `film_stat` as `t4` ON t1.`id` = t4.`filmId`
                                            WHERE t1.`status` = 'show' AND t1.`premiere_usa` >= '{$from}' AND t1.`premiere_usa` <= '{$to}' AND t1.`type` = '' ORDER BY t1.`premiere_usa` LIMIT 100
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.159.236.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }

            $row['company_id'] = '';
            $row['company_name'] = '';
            $result2  = $this->mysql()->query("SELECT t3.`id` as `company_id`, t3.`short_name` as `company_name` 
                                                   FROM `film_company_rel` as `t2`
                                                   LEFT JOIN `company` as `t3` ON t2.`companyId` = t3.`id` WHERE t2.`filmId` = {$row['id']} AND t2.`type` = 'Прокат' LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $row['company_id'] = $row2['company_id'];
                $row['company_name'] = $row2['company_name'];
            }

            $crew = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                  FROM `film_crew` as `t1`
                                                  JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                  WHERE t1.`filmId` = {$row['id']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 2
                                                  ");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $crew[$row2['id']] = $name;
            }

            $cast = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                  FROM `film_cast` as `t1`
                                                  JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                  WHERE t1.`filmId` = {$row['id']} ORDER BY t1.`order` LIMIT 5
                                                  ");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $cast[$row2['id']] = $name;
            }

            $date = $this->formatDate($row['premiere_usa']);
            $date = explode('&nbsp;', $date);
            $day = $date[0] ?? '';
            $month = mb_substr(mb_strtoupper($date[1] ?? '', 'UTF-8'), 0, 3, 'UTF-8');
            $year = $date[2] ?? '';

            $list[] = [
                Release::ID => $row['id'],
                Release::IMAGE => $image,
                Release::NAME_ORIGIN => $row['name_origin'],
                Release::NAME_RU => $row['name_ru'],
                Release::COUNTRY_LIST => explode(',', $row['country']),
                Release::YEAR => $row['year'],
                Release::CAST => $cast,
                Release::GENRE => explode(',', $row['genre']),
                Release::CREW => $crew,
                Release::DATE_D => $day,
                Release::DATE_M => $month,
                Release::DATE_Y => $year,
                Release::COMPANY_ID => $row['company_id'],
                Release::COMPANY_NAME => $row['company_name'],
                Release::RATE => $row['rate'],
            ];
        }
        
        return $list;
    }
    
    public function getRuList()
    {
        $list = [];

        $from = date('Y-m-01');
        $to = date('Y-m-t');
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t1.`country`, t1.`year`, t1.`genre`,
                                            t1.`premiere_ru`, t4.`rate`
                                            FROM `film` as `t1`
                                            LEFT JOIN `film_stat` as `t4` ON t1.`id` = t4.`filmId`
                                            WHERE t1.`status` = 'show' AND t1.`premiere_ru` >= '{$from}' AND t1.`premiere_ru` <= '{$to}' AND t1.`type` = '' ORDER BY t1.`premiere_ru` LIMIT 100
                                        ");
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['image'])) {
                $iName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.159.236.' . $row['image'];
            } else {
                $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            }

            $row['company_id'] = '';
            $row['company_name'] = '';
            $result2  = $this->mysql()->query("SELECT t3.`id` as `company_id`, t3.`short_name` as `company_name` 
                                                   FROM `film_company_rel` as `t2`
                                                   LEFT JOIN `company` as `t3` ON t2.`companyId` = t3.`id` WHERE t2.`filmId` = {$row['id']} AND t2.`type` = 'Прокат' LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $row['company_id'] = $row2['company_id'];
                $row['company_name'] = $row2['company_name'];
            }

            $crew = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                  FROM `film_crew` as `t1`
                                                  JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                  WHERE t1.`filmId` = {$row['id']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 2
                                                  ");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $crew[$row2['id']] = $name;
            }

            $cast = [];
            $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` 
                                                  FROM `film_cast` as `t1`
                                                  JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                                  WHERE t1.`filmId` = {$row['id']} ORDER BY t1.`order` LIMIT 5
                                                  ");
            while ($row2 = $result2->fetch_assoc()) {
                $name = $row2['name_ru'];
                if (empty($name)) {
                    $name = $row2['name_origin'];
                }
                $cast[$row2['id']] = $name;
            }

            $date = $this->formatDate($row['premiere_ru']);
            $date = explode('&nbsp;', $date);
            $day = $date[0] ?? '';
            $month = mb_substr(mb_strtoupper($date[1] ?? '', 'UTF-8'), 0, 3, 'UTF-8');
            $year = $date[2] ?? '';

            $list[] = [
                Release::ID => $row['id'],
                Release::IMAGE => $image,
                Release::NAME_ORIGIN => $row['name_origin'],
                Release::NAME_RU => $row['name_ru'],
                Release::COUNTRY_LIST => explode(',', $row['country']),
                Release::YEAR => $row['year'],
                Release::CAST => $cast,
                Release::GENRE => explode(',', $row['genre']),
                Release::CREW => $crew,
                Release::DATE_D => $day,
                Release::DATE_M => $month,
                Release::DATE_Y => $year,
                Release::COMPANY_ID => $row['company_id'],
                Release::COMPANY_NAME => $row['company_name'],
                Release::RATE => $row['rate'],
            ];
        }
        
        return $list;
    }
}