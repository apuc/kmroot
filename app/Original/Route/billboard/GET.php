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
        $city = IpGeoBase::getCityInfo();
        $places = $api->getPlaces($city['city'])->List;
        $films = $api->getListFromType($city['city'])->List;
        $this->addData([
			'options' => new Options(),
            'places' => $places,
	        'films' => $films,
        ]);

        if(isset($_GET['test'])){
            $this->setTemplate('billboard/test.html.php');
        }
        else {
            $this->setTemplate('billboard/index.html.php');
        }
    }
}