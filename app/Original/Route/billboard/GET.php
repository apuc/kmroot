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
        $cinema = [];
        foreach ($places as $place){
        	if($place->Category == 'Cinema'){
        		$cinema[] = $place;
	        }
        }
        $films = $api->getListFromType($city['city'])->List;
        $this->addData([
			'options' => new Options(),
            'places' => $places,
	        'films' => $films,
	        'cinema' => $cinema,
        ]);

        if(isset($_GET['test'])){
            $this->setTemplate('billboard/test.html.php');
        }
        else {
            $this->setTemplate('billboard/index.html.php');
        }
    }

    public function get_film()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $films_place = $api->getFilmsForPlaces($city['city'], (isset($_GET['id'])) ? $_GET['id'] : '');
        $this->addData([
            'options' => new Options(),
            'films_place' => $films_place,
            'cityId' => $api->getCityId($city['city']),
            'name' => $_GET['name'],
            'id' => $_GET['id'],
        ]);
        $this->setTemplate('billboard/films_place.html.php');
    }

    public function get_sessions()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $schedule = $api->getSchedule(null, $city['city'], '2017-10-21', '2017-10-22');
        Debug::prn(AKR::getScheduleByFilmId($schedule, $_GET['filmId']));
        $this->addData([

        ]);
        $this->setTemplate('billboard/test.html.php');
    }
}