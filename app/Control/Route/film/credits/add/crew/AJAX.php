<?php
namespace Control\Route_film_credits_add_crew;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Photo\Photo;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $this->addData([
            'filmId' => $get->fetchInt('filmId'),
            'type' => $get->fetch('type')
        ]);
        $this->setTemplate('film/credits/crew.add.html.php');
    }
}