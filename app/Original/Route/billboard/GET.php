<?php
namespace Original\Route_billboard;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Options\Options;
use Kinomania\System\API\APIKassaRambler;

class GET extends DefaultController
{
	

    public function index()
    {
		$this->addData([
			'options' => new Options(),
			'api' => new APIKassaRambler('eed094a6-b7cc-4529-b858-a60f26a57f6f', 'json'),
		]);
        $this->setTemplate('billboard/index.html.php');
    }
}