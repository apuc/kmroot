<?php

namespace Kinomania\System\Extra;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;


/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 24.08.2017
 * Time: 12:36
 */

class ExtraList
{
	use TDate;
	use TRepository;
	
	public function get_new_films(){
		
		$new_film = [];
		
		$result = $this->mysql()->query("SELECT `id`, `name_ru`
                                          		FROM `film`
                                          		WHERE  `name_ru` != '' LIMIT 1000
                                        ");
		if($result){
			while ($row = $result->fetch_assoc()) {
				$new_film[$row['id']] =  $row['name_ru'];
			}
			return $new_film;
		}
	}
	
	public function get_trailers(){
		
		$trailers = [];
		
		$result = $this->mysql()->query("SELECT t2.`id`, t2.`name_ru`,
                                            	FROM `trailer` AS `t1`
                                            	JOIN `film` as `t2` ON t1.`filmId` = t2.`id` ORDER BY t2.`id` LIMIT 5000
                                        ");
		if($result){
			while ($row = $result->fetch_assoc()) {
				$trailers[$row['id']] = $row['name_ru'];
			}
			return $trailers;
		}
	}
	
	public function get_wallpaper(){
		
		$wallpaper = [];
		
		$result = $this->mysql()->query("SELECT  f2.`id`, f2.`name_ru`,
                                          FROM `film_wallpaper` as `f1`
                                          JOIN `film` as `f2` ON f1.`filmId` = f2.`id`
                                		  LIMIT 5000
                                        ");
		if($result){
			while ($row = $result->fetch_assoc()) {
				$wallpaper[$row['id']] = $row['name_ru'];
			}
			var_dump($wallpaper); exit();
			return $wallpaper;
		}
	}
}