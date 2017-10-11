<?php

namespace Kinomania\System\API;

use InvalidArgumentException;
use Kinomania\System\Debug\Debug;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 09.10.2017
 * Time: 17:41
 */
class APIKassaRambler
{

    public $key;
    public $format;
    public $query;

    public function __construct($key, $format = 'json')
    {
        if (empty($key)) {
            throw new InvalidArgumentException('Некорректные данные');
        }
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
            return $this->createQuery('json', 'Movie/list', ['cityID'=> $cityId])
                ->jsonToArray();
        }
        return false;
    }
    
    public  function  getObjects($city){
	    if (!empty($city)) {
		    $cityId = $this->getCityId($city);
		    $objects = $this->createQuery('json', 'Movie/list', ['cityID'=> $cityId])
		                 ->jsonToArray();
		     if(!empty($objects)){
		    	$arr = [];
			    foreach ((array)$objects->List as $item) {
				    $arr[] = $this->createQuery( 'json','place/object',[ 'objectID' => $item->ObjectID ] )
				                  ->jsonToArray();
			    }
			    return $arr;
		    }
	    }
	    return false;
    }
    
    public function getSchedule(){
    
    }
	

    public function getFiles()
    {
	    return $this->createQuery('xml', 'Movie/export/full')->xmlToArray();
    }
    
	public function getFile($file)
	{
		return $this->createQuery('xml', 'Movie/export/full/'.$file)->xmlToArray();
	}

    private function mb_ucfirst($string, $enc = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
            mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }
}