<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.10.2017
 * Time: 20:36
 */

namespace Kinomania\System\API;

use Kinomania\System\Debug\Debug;


class AKR {
	
	public $key;
	public $format;
	public $query;
	
	public function __construct( $key,$format = 'json' ) {
		$this->key    = $key;
		$this->format = $format;
		$this->query  = '';
	}
	
	public function createQuery( $format,$url,array $data = [] ) {
		$query = 'http://api.kassa.rambler.ru/v2/' . $this->key . '/' . $format . '/' . $url;
		if ( ! empty( $data ) ) {
			$query .= '?';
			foreach ( $data as $key => $value ) {
				$query .= $key . '=' . $value . '&';
			}
			$query = substr( $query,0,- 1 );
		}
		$this->query = file_get_contents( $query );
		return $this;
	}
	
	public function jsonToArray() {
		return json_decode( $this->query );
	}
	
	public function xmlToArray() {
		return simplexml_load_string( $this->query );
	}
	
	public function getCities() {
		return $this->createQuery( 'json','cities' )->jsonToArray();
	}
	
	public function getCityId( $city ) {
		if(is_numeric($city)){
			return $city;
		}
		if ( ! empty( $city ) ) {
			$city   = $this->mb_ucfirst( $city );
			$cities = $this->getCities();
			foreach ( (array) $cities->List as $item ) {
				if ( $item->Name === $city ) {
					return $item->CityID;
				}
			}
		}
		return false;
	}
	
	public function getPlaces( $city,$maxDate = null ) {
		if ( ! empty( $city ) ) {
			$cityId = $this->getCityId( $city );
			if ( null !== $maxDate ) {
				$data['maxDate'] = $maxDate;
			}
			$data['cityID'] = $cityId;
			
			return $this->createQuery( 'json','place/list',$data )
			            ->jsonToArray();
		}
		return false;
	}
	
	public function getListFromType( $city,$maxDate = null) {
		if ( ! empty( $city ) ) {
			$cityId = $this->getCityId( $city );
			if ( null !== $maxDate ) {
				$data['maxDate'] = $maxDate;
			}
			$data['cityID'] = $cityId;
			
			return $this->createQuery( 'json','Movie/list',$data )
			            ->jsonToArray();
		}
		
		return false;
	}
	
	public function getObject( $objectid ) {
		if ( ! empty( $objectid ) ) {
			return $this->createQuery( 'json','place/object',[ 'objectID' => $objectid ] )
			            ->jsonToArray();
		}
		
		return false;
	}
	
	public function getObjectByCreationType( $sourceCreationId = null,$objectID = null ) {
		$data = [];
		if ( $sourceCreationId !== null ) {
			$data['sourceCreationId'] = $sourceCreationId;
		}
		if ( $objectID !== null ) {
			$data['objectID'] = $objectID;
		}
		
		return $this->createQuery( 'json','Movie/object',$data )->jsonToArray();
	}
	
	public function getFilmsForPlaces( $city,$idfilm ) {
		if ( ! empty( $city ) ) {
			$films  = $this->getListFromType( $city );
			$places = $this->getPlaces( $city );
			$files  = $this->getFiles();
			$filmplase = $this->getFile( $files->Sessions->Files->File['filename'] );
			$arr       = [];
			$arr2      = [];
			foreach ( $places->List as $place ) {
				foreach ( $filmplase->Session as $item ) {
					if ( $place->ObjectID == $item->PlaceObjectID ) {
						$arr[] = [
							'theater' => $place->Name,
							'id'      => $place->ObjectID,
							'film'    => $item->CreationObjectID,
						];
					}
				}
			}
			foreach ( $films->List as $film ) {
				foreach ( $arr as $item ) {
					if ( $film->ObjectID == $idfilm ) {
						$arr2[] = [ 'theatr' => $item['theater'],'film' => $film->Name,'objId' => $item['id'] ];
					}
				}
			}
			$arrNew = [];
			foreach ( $arr2 as $ar ) {
				$arrNew[ $ar['objId'] ] = [ $ar['theatr'],$ar['film'] ];
			}
			
			return $arrNew;
		}
		
		return false;
	}
	
	public function getSchedule( $objectId,$city,$dateFrom = null,$dateTO = null,$saleSupport = true, $classType = 'Place') {
		$data['cityID'] = $this->getCityId( $city );
		
		if ( $dateFrom !== null ) {
			$data['dateFrom'] = $dateFrom;
		}
		if ( $dateTO !== null ) {
			$data['dateTO'] = $dateTO;
		}
		if ( null !== $objectId ) {
			$data['objectID'] = $objectId;
		}
		$data['saleSupportedOnly'] = $saleSupport;
		
		return $this->createQuery( 'json',$classType . '/schedule',$data )->jsonToArray();
	}
	
	
	public function getFilmsByCity( $cityId ) {
		$s   = $this->getSchedule( null,$cityId,date( 'Y-m-d' ),date( 'Y-m-d',time() + 86000 ),true );
		$arr = [];
		foreach ( (array) $s->List as $item ) {
			if ( $item->CityID == $cityId ) {
				$arr[ $item->PlaceObjectID ] = $item->PlaceObjectID;
			}
		}
		$objects = $this->getPlaces( $cityId );
		
		return $arr;
	}
	
	public function getCinemasByFilm( $cityId,$filmId, $date = null ) {
		$s   = $this->getSchedule($filmId, $cityId,date( 'Y-m-d' ), date_create('now + 3 day')->format('Y-m-d'),true, 'Movie' );
		if($date == null) {
			$date = date('Y-m-d');
		}
		$arr = [];
		$res = [];
		$arDate = [
			'now' => date('Y-m-d'),
			'tommorrow' => date_create('now + 1 day')->format('Y-m-d'),
			'afterTommorow' => date_create('now + 2 day')->format('Y-m-d'),
		];
		
		foreach ( (array) $s->List as $item ) {
			if($key = array_search(substr($item->DateTime, 0 , -6), $arDate)){
				if ( $item->CityID == $cityId && $item->CreationObjectID == $filmId ) {
					$arr[$arDate[$key]][ $item->PlaceObjectID ] = $item->PlaceObjectID;
				}
			}
		}
		
		$objects = $this->getPlaces( $cityId )->List;
		foreach ( (array) $objects as $object ) {
			if ( in_array( $object->ObjectID,$arr[$date] ) ) {
				$res[] = $object;
			}
		}
		return $res;
	}
	
	public function getCinemasByFilmByDate( $cityId,$filmId, $date) {
		$s   = $this->getSchedule( $filmId, $cityId, date('Y-m-d'), $date ,true, 'Movie' );
		$arr = [];
		$res = [];
		foreach ( (array) $s->List as $item ) {
			if ( $item->CityID == $cityId && $item->CreationObjectID == $filmId) {
				if($date == substr($item->DateTime, 0, -6)){
					$arr[ $item->PlaceObjectID ] = $item->PlaceObjectID;
				}
			}
		}
		$objects = $this->getPlaces( $cityId )->List;
		foreach ( (array) $objects as $object ) {
			if ( in_array( $object->ObjectID,$arr ) ) {
				$res[] = $object;
			}
		}
		return $res;
	}
	
	
	
	public function getIDbyName( $city,$name ) {
		if ( ! empty( $city ) ) {
			$obj   = [];
			$films = $this->getListFromType( $city )->List;
			foreach ( (array) $films as $film ) {
				if ( $name == $film->Name ) {
					$obj['id'] = $film->ObjectID;
				}
			}
			
			return $obj;
		}
		return false;
	}
	
	public function getDescByID( $city,$id ) {
		if ( ! empty( $city ) && ! empty( $id ) ) {
			$films = $this->getListFromType( $city )->List;
			foreach ( (array) $films as $film ) {
				if ( $id == $film->ObjectID ) {
					return $film;
				}
			}
		}
		return false;
	}
	
	public static function getScheduleByFilmId( $schedule,$filmId, $date = null) {
		$res = [];
		if($date == null){
			$date == date('Y-m-d');
		}
		if ( isset( $schedule->List ) ) {
			foreach ( (array) $schedule->List as $item ) {
				if ( $item->CreationObjectID == $filmId && substr($item->DateTime, 0, -6) == $date) {
						$res[] = $item;
					}
				}
			return $res;
		}
		return false;
	}
	
	
	public function getFiles() {
		return $this->createQuery( 'xml','Movie/export/full' )->xmlToArray();
	}
	
	public function getFile( $file ) {
		if ( $file ) {
			return $this->createQuery( 'xml','Movie/export/full/' . $file )->xmlToArray();
		}
		
		return false;
	}
	
	private function mb_ucfirst( $string,$enc = 'UTF-8' ) {
		return mb_strtoupper( mb_substr( $string,0,1,$enc ),$enc ) .
		       mb_substr( $string,1,mb_strlen( $string,$enc ),$enc );
	}
}