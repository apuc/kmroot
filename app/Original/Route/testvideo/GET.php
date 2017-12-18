<?php
namespace Original\Route_testvideo;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Data\Afisha;
use Kinomania\System\Db\Db;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;
use Kinomania\System\Data\Player;

class GET extends DefaultController
{
	

    public function index()
    {
	    $player = new Player();

	    $this->addData([
			'options' => new Options(),
			'player' => $player->selectPlayer(),
        ]);

      
        $this->setTemplate('testvideo/index.html.php');
        
    }
    
}