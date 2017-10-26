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
        $films_place = $api->getCinemasByFilm($cityId, $_GET['id'], (isset($_GET['date'])) ? $_GET['date'] : date('Y-m-d'));
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
	        'curDate' => (isset($_GET['date'])) ? $_GET['date'] : date('Y-m-d'),
        ]);
        $this->setTemplate('billboard/films_place.html.php');
    }
	

    public function get_sessions()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $cityId =  $api->getCityId($city['city']);
        $schedule = $api->getSchedule($_GET['objId'], $cityId, date('Y-m-d'), date_create('now + 3 day')->format('Y-m-d'),true, 'Place');
        $this->addData([
	        'sessions' => AKR::getScheduleByFilmId($schedule, $_GET['filmId'], $_GET['date'])
        ]);
        $this->setTemplate('billboard/_session.html.php');
    }
}