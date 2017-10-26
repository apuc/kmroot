<?php

namespace Original\Route_billboard;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 19.10.2017
 * Time: 10:10
 */
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Data\Afisha;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;

class AJAX extends DefaultController
{
    public function get()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $places = $api->getPlaces($city['city'], date('Y-m-d', time()+86000))->List;
        $films = $api->getListFromType($city['city'], date('Y-m-d', time()+86000))->List;
        $this->addData([
            'options' => new Options(),
            'films' => $films,
            'places' => $places,
        ]);
        $this->setTemplate('billboard/films.html.php');
    }

    public function get_film()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $afisha = new Afisha();
        $cityId = $api->getCityId($city['city']);
        $films_place = $api->getCinemasByFilm($cityId, $_GET['id']);
	    $dataFrom = ['now' => date('Y-m-d'),
	                 'tomorrow' => date_create('now + 1 day')->format('Y-m-d'),
		              'after' => date_create('now + 2 day')->format('Y-m-d')];
	    $film = $afisha->selectFilm($_GET['id']);
        $this->addData([
            'options' => new Options(),
            'films_place' => $films_place,
            'cityId' => $cityId,
            'id' => $_GET['id'],
	        'film' => $film,
	        'dataFrom' => $dataFrom,
        ]);
        $this->setTemplate('billboard/films_place.html.php');
    }
    
    public function getFilmByDate () {
	    $city = IpGeoBase::getCityInfo();
	    $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
	    $afisha = new Afisha();
	    $cityId = $api->getCityId($city['city']);
	    $films_place = $api->getCinemasByFilmByDate($cityId, $_GET['id'], $_GET['date']);
	    $dataFrom = ['now' => date('Y-m-d'),
	                 'tomorrow' => date_create('now + 1 day')->format('Y-m-d'),
	                 'after' => date_create('now + 2 day')->format('Y-m-d')];
	    $film = $afisha->selectFilm($_GET['id']);
	    $this->addData([
		    'options' => new Options(),
		    'films_place' => $films_place,
		    'cityId' => $cityId,
		    'id' => $_GET['id'],
		    'film' => $film,
		    'dataFrom' => $dataFrom,
		    'date' => $_GET['date'],
	    ]);
	    $this->setTemplate('billboard/films_place_date.html.php');
    }
    
    

    public function get_sessions()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $cityId =  $api->getCityId($city['city']);
	    
        if(isset($_GET['date'])!= ''){
	        $schedule = $api->getSchedule($_GET['objId'], $cityId, date('Y-m-d'), date('Y-m-d', time()+258000), true);
	        //Debug::prn(AKR::getScheduleByFilmId($schedule, $_GET['filmId']));
	        $this->addData([
		        'sessions' => AKR::getScheduleByFilmId($schedule, $_GET['filmId'], $_GET['date'])
	        ]);
	        $this->setTemplate('billboard/_session.html.php');
        } else {
	        $schedule = $api->getSchedule($_GET['objId'], $cityId, date('Y-m-d'), date('Y-m-d', time()+86000), true);
	        //Debug::prn(AKR::getScheduleByFilmId($schedule, $_GET['filmId']));
	        $this->addData([
		        'sessions' => AKR::getScheduleByFilmId($schedule, $_GET['filmId'])
	        ]);
	        $this->setTemplate('billboard/_session.html.php');
        }
    }
}