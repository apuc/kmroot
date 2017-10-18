<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.10.2017
 * Time: 20:36
 */

namespace Kinomania\System\API;

use Kinomania\System\Debug\Debug;

class AKR
{

    public $key;
    public $format;
    public $query;

	public function __construct($key, $format = 'json')
	{
		$this->key = $key;
		$this->format = $format;
		$this->query = '';
	}
	
	 public function createQuery($format, $url, array $data = [])
	{
		$query = 'http://api.kassa.rambler.ru/v2/' . $this->key . '/' . $format . '/' . $url;
		if (!empty($data)) {
			$query .= '?';
			foreach ($data as $key => $value) {
				$query .= $key . '=' . $value . '&';
	         }
			$query = substr($query, 0, -1);
	     }
		$this->query = file_get_contents($query);
		return $this;
	 }
	
	 public function jsonToArray()
	 {
	 	return json_decode($this->query);
	 }
	
	 public function xmlToArray()
	 {
	 	return simplexml_load_string($this->query);
	 }
	
	 public function getCities()
	 {
	 	return $this->createQuery('json', 'cities')->jsonToArray();
	 }
	
	 public function getCityId($city)
	 {
	 	if (!empty($city)) {
	 		$city = $this->mb_ucfirst($city);
	 		$cities = $this->getCities();
	 		foreach ((array)$cities->List as $item) {
	 			if ($item->Name === $city) {
	 				return $item->CityID;
	 			}
	 		}
	 	}
	 	return false;
	 }
	
	 public function getPlaces($city)
	 {
	 	if (!empty($city)) {
	 		$cityId = $this->getCityId($city);
	 		return $this->createQuery('json', 'place/list', ['cityID' => $cityId])
		                ->jsonToArray();
	     }
	     return false;
	 }
	
	 public function getListFromType($city, $creationType = 'Movie')
	 {
	     if (!empty($city)) {
	         $cityId = $this->getCityId($city);
	         return $this->createQuery('json', 'Movie/list', ['cityID' => $cityId])
	             ->jsonToArray();
	     }
	     return false;
	 }
	
	 public function getObject($objectid)
	 {
	     if (!empty($objectid)) {
	         return $this->createQuery('json', 'place/object', ['objectID' => $objectid])
	             ->jsonToArray();
	     }
	     return false;
	 }
	
	 public function getObjectByCreationType($sourceCreationId = null, $objectID = null)
	 {
	     $data = [];
	     if ($sourceCreationId !== null) {
	         $data['sourceCreationId'] = $sourceCreationId;
	     }
	     if ($objectID !== null) {
	         $data['objectID'] = $objectID;
	     }
	     return $this->createQuery('json', 'Movie/object', $data)->jsonToArray();
	 }
	
	 public function getFilmsForPlaces($city)
	 {
	     if (!empty($city)) {
	         $films = $this->getListFromType($city);
	         $places = $this->getPlaces($city);
	         $filmplase = $this->getFile('fullmovie-schedule-1-18102017161244.xml');
	         //$shedule = $this->getSchedule($id, $date, null, $city, 'true');
	         $arr = [];
	         $arr2 = [];
		        foreach ( $places->List as $place ) {
		        	foreach ($filmplase->Session as $item)
			            if($place->ObjectID == $item->PlaceObjectID){
				            $arr[] = ['theater' => $place->Name, 'id' => $place->ObjectID, 'film' => $item->CreationObjectID];
				        }
		        }
		        foreach ($films->List as $film){
		        	foreach ($arr as $item){
		        		if($film->ObjectID == $item['film']){
		        			$arr2[] = ['theatr'=> $item['theater'], 'film' => $film->Name];
				        }
			        }
		        }
		        
	         Debug::prn($arr2);
	         
	         /*foreach ($films as $item){
	         
	         }*/
	         
	         /*foreach ($shedule->List as $item) {
	             foreach ($films->List as $item2) {
	                 if ($item2->ObjectID == $item->CreationObjectID) {
	                     $arr[] = ['film' => $item2->Name, 'id' => $item->PlaceObjectID];
	                 }
	             }
	         }*/
	         return $arr;
	     }
	     return false;
	 }
	 
	 public  function selectFilm($id){
	    if($id){
	        $list = [];
	        $query = ("  SELECT * FROM `afisha` WHERE `filmID` = '{$id}'");
	        $result = $this->mysql()->query($query);
	        while($row = $result->fetch_assoc()) {
	            $list[] = $row;
	        }
	    }
	 }
	
	 public function getSchedule($objectId, $city, $dateFrom = null, $dateTO = null, $saleSupport = true)
	 {
	     $data['cityID'] = $this->getCityId($city);
	     if ($objectId) {
	         if ($dateFrom !== null) {
	             $data['dateFrom'] = $dateFrom;
	         }
	         if ($dateTO !== null) {
	             $data['dateTO'] = $dateTO;
	         }
	         $data['objectID'] = $objectId;
	         $data['saleSupportedOnly'] = $saleSupport;
	         return $this->createQuery('json', 'Place/schedule', $data)->jsonToArray();
	     }
	     return false;
	
	 }
	
	 public function getFiles()
	 {
	     return $this->createQuery('xml', 'Movie/export/full')->xmlToArray();
	 }
	
	 public function getFile($file)
	 {
	     if ($file) {
	         return $this->createQuery('xml', 'Movie/export/full/' . $file)->xmlToArray();
	     }
	     return false;
	 }
	
	 private function mb_ucfirst($string, $enc = 'UTF-8')
	 {
	     return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
	         mb_substr($string, 1, mb_strlen($string, $enc), $enc);
	 }
}