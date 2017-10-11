<?php
namespace Original\Route_index;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;
use Kinomania\System\API\APIKassaRambler;



class GET extends DefaultController
{
    public function index()
    {
        $location = New IpGeoBase();
        $this->addData([
            'options' => new Options(),
            'location' => $location->getLocation(),
        ]);
        $this->setTemplate('index.html.php');
    }
}