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
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;

class AJAX extends DefaultController
{
	public function get()
	{
		$city = IpGeoBase::getCityInfo();
		$api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
		$films = $api->getListFromType($city['city'])->List;
		$this->addData([
			'options' => new Options(),
			'films' => $films,
				]);
		$this->setTemplate('billboard/films.html.php');
	}
	public function get_film()
	{
		$city = IpGeoBase::getCityInfo();
		$api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
		$films_place = $api->getFilmsForPlaces($city['city'], (isset($_GET['id']))? $_GET['id']:'' );
		$this->addData([
			'options' => new Options(),
			'films_place' => $films_place,
			'name' => $_GET['name'],
		]);
		$this->setTemplate('billboard/films_place.html.php');
	}
}