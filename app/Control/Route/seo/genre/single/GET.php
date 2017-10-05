<?php

namespace Control\Route_seo_genre_single;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Template\Menu;
use Kinomania\System\Data\Genre;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Options\Options;

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:20
 */
class GET extends AdminController
{

    public function index()
    {
        $this->addData([
            'options' => new Options(),
            'get' => $_GET,
        ]);

        if(isset($_GET['slug'])){
            $this->setTitle('Настройка СЕО для страницы ' . Genre::RU[$_GET['slug']]);
            $this->setTemplate('seo/genre/single/single.html.php');
        }
        else {
            $this->setTitle('Настройка СЕО для страницы жанров');
            $this->setTemplate('seo/genre/single/index.html.php');
        }

    }

}