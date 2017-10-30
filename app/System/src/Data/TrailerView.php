<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 30.10.2017
 * Time: 11:38
 */

namespace Kinomania\System\Data;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;


class TrailerView {
	
	use TRepository;
	use TDate;
	
	
	public function saveView( $data ) {
		if($data){
			$views = ($this->selectTrailerView($data) + 1);
			$query = " UPDATE `trailer` SET `view`= '".$views."' WHERE `filmId` = '".$data."'";
			$this->mysql()->query( $query );
		}
		return false;
	}
	
	public function selectTrailerView( $data ) {
		if ( $data ) {
			$query  = ( " SELECT `view` FROM `trailer` WHERE `filmId` = '".$data."'" );
			$result = $this->mysql()->query( $query );
			while( $row = $result->fetch_assoc() ) {
				return $row['view'];
			}
		}
		return false;
	}
}