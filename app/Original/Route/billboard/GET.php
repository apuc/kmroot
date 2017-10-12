<?php
namespace Original\Route_billboard;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Options\Options;
use Kinomania\System\API\APIKassaRambler;

class GET extends DefaultController
{
	

    public function index()
    {
        $api = new APIKassaRambler('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $films = $api->getFilmsForPlaces('Москва');
        $places = $api->getPlaces('Москва')->List;
		$this->addData([
			'options' => new Options(),
            'films' => $films,
            'places' => $places
		]);
		//$api->getObjectByCreationType(null, 91555);
		if($_GET['page'] === 'cinema'){
            $this->setTemplate('billboard/cinema.html.php');
        }
        else {
            $this->setTemplate('billboard/films.html.php');
        }
        //$this->setTemplate('billboard/index.html.php');
    }
}