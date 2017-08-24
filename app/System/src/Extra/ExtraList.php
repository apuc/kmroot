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
		
		$result = $this->mysql()->query("SELECT `id`
                                          		FROM `film` ORDER BY `id` LIMIT 500
                                        ");
		while ($row = $result->fetch_assoc()) {
			$new_film[] = $row['id'];
		}
		return $new_film;
	}
	
	public function get_trailers(){
		
		$trailers = [];
		
		$result2 = $this->mysql()->query("SELECT `id`
                                          FROM `trailers`
                                         
                                        ");
		while ($row = $result2->fetch_assoc()) {
			$trailers[] = $row['id'];
		}
		return $trailers;
	}
	
	public function get_posters(){
		
		$trailers = [];
		
		$result = $this->mysql()->query("SELECT `id`
                                          FROM `trailers`
										  LIMIT 1
                                        ");
		while ($row = $result->fetch_assoc()) {
			$posters[] = $row['id'];
		}
		return $posters;
	}
}