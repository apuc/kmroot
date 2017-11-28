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
	
	public static function getVersion($get) {
		if(isset($get['full'])) {
	        SetCookie("full_cookie","full",time()+3600);
        }
        if(isset($get['mobile'])){
	        SetCookie("full_cookie","");
        }
	}
}