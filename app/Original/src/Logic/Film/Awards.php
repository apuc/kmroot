<?php
namespace Kinomania\Original\Logic\Film;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\Original\Key\Person\Award;

/**
 * Class Awards
 * @package Kinomania\Original\Film
 */
class Awards
{
    use TRepository;
    use TDate;
    
    public function get($filmId)
    {
        $list = [];

        $filmId = intval($filmId);
        $temp = [];

        $result = $this->mysql()->query("SELECT t1.`awardId`, t1.`year`, t1.`filmId`, t1.`win`, t2.`code`, t2.`name_ru`, t2.`name_en`, t3.`name_ru` as `nomination_ru`, 
                                                    t3.`name_en` as `nomination_en`, t4.`name_origin` as `film_en`, t4.`name_ru` as `film_ru`
                                                    FROM 
                                                    `awards_set` as `t1` JOIN
                                                    `awards` as `t2` ON t1.`awardId` = t2.`id` JOIN 
                                                    `awards_nomination` as `t3` ON t1.`nominationId` = t3.`id` LEFT JOIN 
                                                    `person` as `t4` ON t1.`personId` = t4.`id` 
                                                    WHERE t1.`filmId` = {$filmId} ORDER BY t1.`awardId` ASC, t1.`year` DESC
                    ");
        while ($row = $result->fetch_assoc()) {
            if (isset($temp[$row['awardId']])) {
                list($count, $total) = $temp[$row['awardId']];
                if ('true' == $row['win']) {
                    $count++;
                }
                $total++;
                $temp[$row['awardId']] = [$count, $total];
            } else {
                $count = 0;
                if ('true' == $row['win']) {
                    $count = 1;
                }
                $total = 1;
                $temp[$row['awardId']] = [$count, $total];
            }

            $nomination = $row['nomination_ru'];
            if (empty($nomination)) {
                $nomination = $row['nomination_en'];
            }
            $nomination = mb_strtoupper($nomination, 'UTF-8');

            $list[$row['awardId']][] = [
                Award::ID => $row['awardId'],
                Award::YEAR => $row['year'],
                Award::FILM_ID => $row['filmId'],
                Award::WIN => $row['win'],
                Award::AWARD_RU => $row['name_ru'],
                Award::AWARD_EN => $row['name_en'],
                Award::NOMINATION => $nomination,
                Award::FILM_EN => $row['film_en'],
                Award::FILM_RU => $row['film_ru'],
                Award::CODE => $row['code'],
            ];
        }

        foreach ($temp as $awardId => $item) {
            $list[$awardId][0][Award::COUNT] = $item[0];
            $list[$awardId][0][Award::TOTAL] = $item[1];
        }
        
        return $list;
    }
}
