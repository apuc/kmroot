<?php
namespace Original\Route_releases_russia;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Key\Film\Release;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;

class AJAX extends DefaultController
{
    use TRepository;
    use TDate;

    public function search()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        $year = intval($filter['year']);
        $month = intval($filter['month']);
        $month_b = intval($filter['month'] + 1);


        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`name_origin`, t1.`name_ru`, t1.`country`, t1.`year`, t1.`genre`,
                                            t1.`premiere_ru`, t4.`rate`
                                            FROM `film` as `t1`
                                            LEFT JOIN `film_stat` as `t4` ON t1.`id` = t4.`filmId`
                                            WHERE t1.`status` = 'show' AND t1.`premiere_ru` >= '{$year}-{$month}-01' AND t1.`premiere_ru` < '{$year}-{$month_b}-01' ORDER BY t1.`premiere_ru` LIMIT 100
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
                                                   LEFT JOIN `company` as `t3` ON t2.`companyId` = t3.`id` WHERE t2.`filmId` = {$row['id']} LIMIT 1");
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

            $dStart = new \DateTime(date('Y-m-d'));
            $dEnd  = new \DateTime($row['premiere_ru']);
            $dDiff = $dStart->diff($dEnd);
            if (60 < $dDiff->days) {
                $day = '';
                switch ($month) {
                    case 'ДЕК':
                    case 'ЯНВ':
                    case 'ФЕВ':
                        $month = 'зима';
                        break;
                    case 'МАР':
                    case 'АПР':
                    case 'МАЯ':
                        $month = 'весна';
                        break;
                    case 'ИЮН':
                    case 'ИЮЛ':
                    case 'АВГ':
                        $month = 'лето';
                        break;
                    case 'СЕН':
                    case 'ОКТ':
                    case 'НОЯ':
                        $month = 'осень';
                        break;
                }
            }

            $row['country'] = explode(',', $row['country']);
            $country = [];
            $temp = Country::RU;
            foreach ($row['country'] as $code) {
                if (isset($temp[$code])){
                    $country[] = $temp[$code];
                }
            }
            $country = implode(',', $country);

            $row['genre'] = explode(',', $row['genre']);
            $genre = [];
            $temp = Genre::RU;
            foreach ($row['genre'] as $code) {
                if (isset($temp[$code])){
                    $genre[] = $temp[$code];
                }
            }
            $genre = implode(',', $genre);
            
            if (0 == $row['year']) {
                $row['year'] = '';
            }

            $list[] = [
                'id' => $row['id'],
                'image' => $image,
                'name_origin' => $row['name_origin'],
                'name_ru' => $row['name_ru'],
                'country' => $country,
                'year' => $row['year'],
                'cast' => $cast,
                'genre' => $genre,
                'crew' => $crew,
                'date_d' => $day,
                'date_m' => $month,
                'date_y' => $year,
                'company_id' => $row['company_id'],
                'company_name' => $row['company_name'],
                'rate' => $row['rate'],
            ];
        }

        $this->setContent(json_encode($list));
    }
}