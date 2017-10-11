<?php
namespace Kinomania\System\API;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 09.10.2017
 * Time: 17:41
 */

class APIKassaRambler {
	
	public $key;
	public $format;
	
	function __construct($key, $format) {
		if(empty($key)||empty($format)){
			throw new InvalidArgumentException('Некорректные данные');
		}
		$this->key = $key;
		$this->format = $format;
	}
	
	public function getClass() {
		$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$this->format.'/classtypes/');
		if($this->format == 'json'){
			if($content) {
				$keyJson = json_decode( $content );
				if(isset($keyJson->Code)){
					return $keyJson;
				} else {
					$arrayJson = $keyJson->List;
					return $arrayJson;
				}
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		} elseif ($this->format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content;
				return $array;
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		}
	}
	
	public function getCity() {
		$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$this->format.'/cities/');
		if($this->format == 'json'){
			if($content) {
				$keyJson   = json_decode( $content );
				if(isset($keyJson->Code)){
					return $keyJson;
				} else {
					$arrayJson = $keyJson->List;
					return $arrayJson;
				}
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		} elseif ($this->format == 'xml') {
			if($content) {
				$content = simplexml_load_string($content);
				$array = $content;
				return $array;
			} else {
				$mess = "Сервер не доступен";
				return $mess;
			}
		}
	}
	public function getFiles($classtype, $data, $filename) {
		if ($this->format == 'xml') {
			$content = file_get_contents('http://api.kassa.rambler.ru/v2/'.$this->key.'/'.$this->format.'/'.$classtype.'/export/'.$data.'/'.$filename);
				if($content) {
					$content = simplexml_load_string($content);
					$array = $content;
					return $array;
				} else {
					$mess = "Сервер не доступен";
					return $mess;
				}
		} else {
			$mess = "Не верно введены данные";
			return $mess;
		}
	
	}
}