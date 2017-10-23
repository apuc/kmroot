<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 23.10.2017
 * Time: 14:18
 */

namespace Original\Route_film;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{

    use TRepository;

    public function get_film()
    {
        $city = IpGeoBase::getCityInfo();
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        $cityId = $api->getCityId($city['city']);
        $filmID = $api->getIDbyName($cityId, $_GET['name']);
        if(!empty($filmID['id'])) {
            $films_place = $api->getCinemasByFilm( $cityId,$filmID['id'] );

            $this->addData( [
                'options'     => new Options(),
                'films_place' => $films_place,
                'cityId'      => $cityId,
                'name'        => $_GET['name'],
                'id'          => $filmID['id'],
            ] );
            $this->setTemplate( 'film/films_place.html.php' );
        } else {
            exit();
        }
    }

}