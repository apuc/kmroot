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
					return $keyJson;
				} else {
					$arrayJson = $keyJson->List;
					return $arrayJson;
				}
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		} elseif ($format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content->List;
				return $array;
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		}
	}
	
	public function getCity($format) {
		$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$format.'/classtypes/');
		if($format == 'json'){
			if($content) {
				$keyJson   = json_decode( $content );
				if($keyJson->Code){
					return $keyJson;
				} else {
					$arrayJson = $keyJson->List;
					return $arrayJson;
				}
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		} elseif ($format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content->List;
				return $array;
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		}
	}
}