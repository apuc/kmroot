<?php
namespace Original\Route_index_ssi_new;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Debug\Debug;

class GET extends DefaultController
{
    use TDate;
    use TRepository;

    public function index()
    {
        header('Cache-Control: public, max-age=720');

        $list = [
            'film' => [],
            'trailer' => [],
            'wallpaper' => []
        ];

        /**
         * Film.
         */
        $filmIdList = [];
        $result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'film_new' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $filmIdList = unserialize($row['list']);
            foreach ($filmIdList as $k => $v) {
                if (1 > intval($v)) {
                    unset($filmIdList[$k]);
                }
            }
        }
        if (count($filmIdList)) {
            $filmIdList = implode(', ', $filmIdList);
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t1.`country`, t1.`year`
                                            FROM `film` as `t1`
                                            WHERE t1.`status` = 'show' AND t1.`id` IN ({$filmIdList}) ORDER BY FIELD(t1.`id`, {$filmIdList}) LIMIT 4
                                        ");
            while ($row = $result->fetch_assoc()) {
                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $list['film'][] = [
                    'id' => $row['id'],
                    'name' => $name,
                    'country' => explode(',', $row['country']),
                    'year' => $row['year']
                ];
            }
        }
        if (4 > count($list['film'])) {
            $limit = 4 - count($list['film']);
            $from = date('Y-m-01');
            $to = date('Y-m-t');
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t1.`country`, t1.`year`
                                            FROM `film` AS `t1`
                                            WHERE t1.`status` = 'show' AND t1.`premiere_usa` >= '{$from}' AND t1.`premiere_usa` < '{$to}' ORDER BY t1.`premiere_usa` LIMIT {$limit}
                                        ");
            while ($row = $result->fetch_assoc()) {
                $name = $row['name_ru'];
                if (empty($name)) {
                    $name = $row['name_origin'];
                }

                $list['film'][] = [
                    'id' => $row['id'],
                    'name' => $name,
                    'country' => explode(',', $row['country']),
                    'year' => $row['year']
                ];
            }
        }

        /**
         * Trailer.
         */
		$temp = [];
		$result = $this->mysql()->query("SELECT `list` FROM `popular` WHERE `type` = 'trailer_new' LIMIT 1");
		
		if ($row = $result->fetch_assoc()) {
			$temp['trailer_new'] = unserialize($row['list']);
			
		}
		$str = implode("," , $temp['trailer_new']);

		//Debug::prn($str);
		
		$result = $this->mysql()->query("SELECT t3.`id`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`
                                            FROM `trailer` AS `t1`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` WHERE t3.`id` in ($str) GROUP BY t3.`id`");
	
	
                                            
        /*$result = $this->mysql()->query("SELECT t3.`id`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`
                                            FROM `trailer` AS `t1`
                                            JOIN `film` as `t3` ON t1.`filmId` = t3.`id` WHERE t3.`status` = 'show' GROUP BY t3.`id` ORDER BY t3.`premiere_world` DESC  LIMIT 4
                                        ");*/
        
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            
            $list['trailer'][] = [
                'id' => $row['id'],
                'name' => $name,
                'country' => explode(',', $row['country']),
                'year' => $row['year']
            ];
        }

        /**
         * Wallpaper.
         */
        $result = $this->mysql()->query("SELECT t3.`id`, t3.`name_origin`, t3.`name_ru`, t3.`country`, t3.`year`
                                              FROM (SELECT ANY_VALUE(`id`) as `id` FROM `film_wallpaper` GROUP BY `filmId` ORDER BY ANY_VALUE(`id`) DESC) as `t`
                                              JOIN `film_wallpaper` AS `t1` ON t1.`id` = t.`id`              
                                              JOIN `film` as `t3` ON t1.`filmId` = t3.`id` WHERE t3.`status` = 'show' LIMIT 4
                                        ");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_origin'];
            }
            
            $list['wallpaper'][] = [
                'id' => $row['id'],
                'name' => $name,
                'country' => explode(',', $row['country']),
                'year' => $row['year']
            ];
        }

 
        $this->addData([
            'list' => $list,
            'country' => Country::RU
        ]);
        $this->setTemplate('index/ssi/new.html.php');
    }
}