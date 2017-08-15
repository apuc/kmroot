<?php
namespace Control\Route_film_sound_add;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Company\Company;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Filmography\Filmography;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $this->addData([
            'filmId' => $get->fetchInt('filmId')
        ]);
        $this->setTemplate('film/sound/add.html.php');
    }
}