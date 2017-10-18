<?php
namespace Original\Route_billboard;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Db\Db;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
	

    public function index()
    {
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
	    $db = new Db();
	  
        $city = IpGeoBase::getCityInfo();

        $places = $api->getPlaces($city['city'])->List;
        //Debug::prn($api->getFilmsForPlaces($city['city']));
        //Debug::prn($api->getFile('fullmovie-schedule-1-18102017161244.xml'));
        $api->getFilmsForPlaces($city['city']);
        $this->addData([
			'options' => new Options(),
            'places' => $places,
        ]);

        if(isset($_GET['test'])){
            $this->setTemplate('billboard/test.html.php');
        }
        else {
            $this->setTemplate('billboard/index.html.php');
        }
    }
}