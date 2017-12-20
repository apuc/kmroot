<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 28.11.2017
 * Time: 17:24
 */
namespace Kinomania\System\Helper;

use Kinomania\System\Debug\Debug;

class Helper {
	
	public static function getVersion($param) {
		if(isset($param['full'])) {
			SetCookie("full_cookie","full", time()+3600, "/");
			$location = "Location: ".$_SERVER["REQUEST_URI"];
			$location = explode('?', $location);
			header($location[0]);
        }
        if(isset($param['mobile'])){
	        SetCookie("full_cookie","",  time() - 3600, "/");
	        $location = "Location: ".$_SERVER["REQUEST_URI"];
	        $location = explode('?', $location);
	        header($location[0]);
        }
        return false;
	}
	
	public static function getRedirect ($url) {
		//	$url = preg_replace("#/$#", "", $url);
		//$url = $_SERVER['REQUEST_URI'];
		if($url == "/" ){
			return false;
		}
		if($url){
			if (substr($url, strlen($url)-1) == "/") {
				$url = substr($url,0,strlen($url)-1);
				header("HTTP/1.1 301 Moved Permanently");
				header('Location:'.$url);
				exit();
			}
		}
		return false;
	}
}