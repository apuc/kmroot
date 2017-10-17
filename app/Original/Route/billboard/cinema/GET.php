<?php

namespace Original\Route_billboard_cinema;

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
        $api = new AKR('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');

        $schedule = $api->getSchedule($_GET['id'], 'Москва');
        $cinema = $api->getObject($_GET['id']);

        $this->addData([
            'schedule' => $schedule,
            'cinema' => $cinema,
            'api' => $api,
            'options' => new Options(),
        ]);
        $this->setTemplate('billboard/cinema/index.html.php');
    }


    //if (isset($_GET['id'])) {
    //    $schedule = $api->getSchedule(
    //        $_GET['id'],
    //        $ip->getLocation()['city'],
    //        date('Y-m-d'),
    //        date('Y-m-d', time() + 86000));
    //    $cinema = $api->getObject($_GET['id']);
    //
    //    $this->addData([
    //        'schedule' => $schedule,
    //        'cinema' => $cinema,
    //        'api' => $api,
    //        'options' => new Options(),
    //    ]);
    //
    //    $this->setTemplate('billboard/cinema/index.html.php');
    //}
}