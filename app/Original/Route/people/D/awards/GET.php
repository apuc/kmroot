<?php
namespace Original\Route_people_D_awards;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Key\Person\Award;
use Kinomania\Original\Key\Person\Frame;
use Kinomania\Original\Key\Person\Photo;
use Kinomania\Original\Key\Person\Wallpaper;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends PersonController
{

    public function index()
    {
        $numList = $this->getNumList();

        if (0 < $numList[0]) {
            $min = $this->getMin($numList[0]);

            if ([] != $min) {
                $list = [];
                $this->redis = new \Redis();
                $this->redisStatus = $this->redis->connect('127.0.0.1');

                $key = 'person:' . $numList[0] . ':awards';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    $temp = [];
                    
                    $result = $this->mysql()->query("SELECT t1.`awardId`, t1.`year`, t1.`filmId`, t1.`win`, t2.`code`, t2.`name_ru`, t2.`name_en`, t3.`name_ru` as `nomination_ru`, 
                                                    t3.`name_en` as `nomination_en`, t4.`name_origin` as `film_en`, t4.`name_ru` as `film_ru`
                                                    FROM (SELECT `id` FROM `awards_set` WHERE `personId` = {$numList[0]} ORDER BY `awardId` ASC, `year` DESC) as `t` 
                                                    JOIN `awards_set` as `t1` ON t.`id` = t1.`id`
                                                    JOIN `awards` as `t2` ON t1.`awardId` = t2.`id`  
                                                    JOIN `awards_nomination` as `t3` ON t1.`nominationId` = t3.`id`  
                                                    LEFT JOIN `film` as `t4` ON t1.`filmId` = t4.`id` 
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

                    if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 900); // 15 min
                    }
                }

                if ([] != $list) {
                    $this->addData([
                        'id' => $numList[0],
                        'stat' => $this->getStat($numList[0]),
                        'min' => $min,
                        'list' => $list
                    ]);
                    $this->setTemplate('person/award/index.html.php');
                }
            }
        }
    }
}