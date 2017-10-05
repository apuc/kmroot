<?php
namespace Kinomania\System\Body;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 05.10.2017
 * Time: 12:47
 */
use Kinomania\System\MobileDetect\MobileDetect;

class BodyScript {
	public static function getContent(){
		$mobile = new MobileDetect();
		if($mobile->isMobile()) {
			?>
			<script src="//static.videonow.ru/vn_init.js?profileId=2785734" defer></script><!--mobile-->
			<?php } else {?>
				<script src="//data.videonow.ru/?profile_id=103919&format=vast.."></script>
				<script src="//static.videonow.ru/vn_init.js?profileId=2786448" defer></script>
			<?php
		}
	}
}