<?php
namespace Kinomania\System\API;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 09.10.2017
 * Time: 17:41
 */

class APIKassaRambler {
	
	public $key = '';
	
	function __construct($key) {
		$this->key = $key;
	}
	
	public function getClass($format) {
		$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$format.'/classtypes/');
		if($format == 'json'){
			if($content) {
				$keyJson = json_decode( $content );
				if($keyJson->Code){
					echo "Code: " .$keyJson->Code. "<br>";
					echo "Message: " .$keyJson->Message. "<br>";
				} else {
					$arrayJson = $keyJson->List;
					foreach ( $arrayJson as $value ) {
						echo "Name: " .$value->Name. "<br>";
					}
				}
			} else {
				echo "Сервер не доступен";
			}
		} elseif ($format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content->List;
				foreach ( $array as $value ) {
					echo "Name: " .$value->Name. "<br>";
				}
			} else {
				echo "Сервер не доступен";
			}
		}
	}
	
	public function getCity($format) {
		$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$format.'/classtypes/');
		if($format == 'json'){
			if($content) {
				$keyJson   = json_decode( $content );
				if($keyJson->Code){
					echo "Code: " .$keyJson->Code. "<br>";
					echo "Message: " .$keyJson->Message. "<br>";
				} else {
					$arrayJson = $keyJson->List;
					foreach ( $arrayJson as $value ) {
						echo "CityID: " .$value->CityID. "<br>";
						echo "Name: " .$value->Name. "<br>";
						echo "Latitude: " .$value->Latitude. "<br>";
						echo "Longitude: " .$value->Longitude. "<br>";
					}
				}
			} else {
				echo "Сервер не доступен";
			}
		} elseif ($format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content->List;
				foreach ( $array as $value ) {
					echo "CityID: " .$value->CityID. "<br>";
					echo "Name: " .$value->Name. "<br>";
					echo "Latitude: " .$value->Latitude. "<br>";
					echo "Longitude: " .$value->Longitude. "<br>";
				}
			} else {
				echo "Сервер не доступен";
			}
		}
	}
}