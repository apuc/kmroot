<?php
namespace Control\Route_seo_top_films;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Template\Menu;
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
            'options' => new Options()
        ]);
        $this->setTitle('Настройка СЕО для страницы 100 ЛУЧШИХ ФИЛЬМОВ');
        $this->setTemplate('seo/top/films/index.html.php');
    }

}