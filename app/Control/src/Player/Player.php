<?php
namespace Kinomania\Control\Player;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 30.10.2017
 * Time: 16:23
 */

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;

class Player {
	
	use TRepository;
	use TDate;
	
	public function setPlayer($player) {
		
			$query  = ( " UPDATE `player`
 						  SET `type` = '".$player."'
 					 	  ");
			$this->mysql()->query( $query );
			
			
	}
	
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