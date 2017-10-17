<?php
namespace Original\Route_billboard;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;
use Kinomania\System\API\APIKassaRambler;

class GET extends DefaultController
{
	

    public function index()
    {
        //$migrate = new \Kinomania\System\GeoLocation\migration\GeoMigrate();
        //$migrate->setTables();
        //$IpGeoBase = new IpGeoBase();
        //$IpGeoBase->updateDB();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');

        $city = IpGeoBase::getCityInfo();

        $places = $api->getPlaces($city['city'])->List;
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

        //if(isset($_GET['page'])) {
			//if ( $_GET['page'] === 'cinema' ) {
			//	$this->setTemplate( 'billboard/cinema.html.php' );
			//} else {
			//	$this->setTemplate( 'billboard/films.html.php' );
			//}
			////$this->setTemplate('billboard/index.html.php');
        //} else {
			//$this->setTemplate('billboard/index.html.php');
        //}
	   
    }
}