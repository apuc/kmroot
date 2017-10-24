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
        $cityId = $api->getCityId($city['city']);
        $img = $_GET['img'];
        $films_place = $api->getCinemasByFilm($cityId, $_GET['id']);
        $this->addData([
            'options' => new Options(),
            'films_place' => $films_place,
            'cityId' => $cityId,
            'name' => $_GET['name'],
            'id' => $_GET['id'],
	        'img' => $img,
        ]);
        $this->setTemplate('billboard/films_place.html.php');
    }

    public function get_sessions()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $cityId =  $api->getCityId($city['city']);
        $schedule = $api->getSchedule($_GET['objId'], $cityId, date('Y-m-d'), date('Y-m-d', time()+86000), true);
        //Debug::prn(AKR::getScheduleByFilmId($schedule, $_GET['filmId']));
        $this->addData([
            'sessions' => AKR::getScheduleByFilmId($schedule, $_GET['filmId'])
        ]);
        $this->setTemplate('billboard/_session.html.php');
    }
}