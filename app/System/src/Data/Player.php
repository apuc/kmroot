<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 08.11.2017
 * Time: 13:49
 */

namespace Kinomania\System\Data;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;

class Player {
	
	use TRepository;
	use TDate;
	
	public function selectPlayer() {
		$arr = [];
		$query = "SELECT * FROM `player`";
		$result = 	$this->mysql()->query( $query );
		while( $row = $result->fetch_assoc() ) {
			$arr[] = $row;
		}
		return $arr[0]['type'];
	}
}