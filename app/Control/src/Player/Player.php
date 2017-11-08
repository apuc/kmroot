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
		
			$query  = ( " UPDATE `options`
 						  SET `value` = '".$player."'
 						  WHERE `key` = 'sys_current_player'
 					 	  ");
			$this->mysql()->query( $query );
			
			
	}
	
	public function selectPlayer() {
		$arr = [];
		$query = ( "  SELECT * FROM `options`
					  WHERE `key` = 'sys_current_player'");
		$result = 	$this->mysql()->query( $query );
		while( $row = $result->fetch_assoc() ) {
			$arr[] = $row;
		}
		return $arr[0]['value'];
	}
	
}