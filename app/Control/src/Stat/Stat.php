<?php
namespace Kinomania\Control\Stat;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 30.10.2017
 * Time: 16:23
 */

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;

class Stat {
	
	use TRepository;
	use TDate;
	
	public function selectTrailersViewByDate( $data, $offset) {
		if ( $data != null ) {
			$arr    = [];
			$query  = ( " SELECT * FROM `trailer` as `t1`
 						  JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
  						  WHERE `date` < '" . $data . "' ORDER BY `date` DESC LIMIT 10 OFFSET $offset" );
			$result = $this->mysql()->query( $query );
			while( $row = $result->fetch_assoc() ) {
				;
				$arr[] = $row;
			}
			
			return $arr;
		}
		return false;
	}
	
	public function selectTrailerView($film = null, $id = null) {
		if($film != null) {
			$arr = [];
			$query  = ( " SELECT * FROM `trailer` as `t1`
 						  JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
  						  WHERE UPPER (t2.`name_ru`) LIKE  UPPER ('".$film."%') LIMIT 1"  );
			$result = $this->mysql()->query( $query );
			while( $row = $result->fetch_assoc() ) {
				$arr[] = $row;
			}
			return $arr;
		}
		if($id != null) {
			$arr = [];
			$query  = ( " SELECT * FROM `trailer` as `t1`
 						  JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
  						  WHERE t1.`filmId` = '".$id."' LIMIT 1" );
			$result = $this->mysql()->query( $query );
			while( $row = $result->fetch_assoc() ) {
				$arr[] = $row;
			}
			return $arr;
		}
		return false;
	}
	
	public function countTrailers() {
		$count = $this->mysql()
		              ->query("SELECT COUNT(*) as count  FROM `trailer`")
		              ->fetch_assoc();
		return $count;
	}
}