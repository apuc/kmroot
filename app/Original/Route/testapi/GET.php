<?php
namespace Original\Route_testapi;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Trailer\Trailer;
use Kinomania\System\API\APIKassaRambler;
use Kinomania\System\Data\Genre;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Options\Options;

class GET extends DefaultController
{
    public function index()
    {

        $rambler = new APIKassaRambler('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json');
        Debug::prn($rambler->getListFromType('Москва'));

        $this->addData([
			'options' => new Options()
        ]);

        $this->setTemplate('testapi/index.html.php');
    }
}