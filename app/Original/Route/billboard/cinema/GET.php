<?php
namespace Original\Route_billboard_cinema;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Options\Options;
use Kinomania\System\API\APIKassaRambler;

class GET extends DefaultController
{
	

    public function index()
    {
        $api = new APIKassaRambler('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        if(isset($_GET['id'])) {
	        $place = $api->getObject( $_GET['id'] );
	        $films = $api->getFilmsForPlaces( $_GET['id'],date( "Y-m-d" ),'','Москва' );
        }
        Debug::prn($films);
		$this->addData([
			'options' => new Options(),
            /*'films' => $films,*/
            'place' => $place,
		]);
		//$api->getObjectByCreationType(null, 91555);
        $this->setTemplate('billboard/cinema.html.php');
    }
}