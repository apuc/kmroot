<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_main;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_main_title', !empty($_POST['title']) ? $_POST['title'] : 'Новинки кино | KINOMANIA.RU');
        $options->set('seo_main_description', !empty($_POST['description']) ? $_POST['description'] : 'Самая интересная и актуальная информация о новинках мирового кинопроката и свежие новости из мира кино на сайте KINOMANIA.RU. Подробные сведения об актёрах и режиссёрах, саундтреки, постеры к фильмам и многое другое.');
        $options->set('seo_main_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'cайт про кино кинопортал киносайты с фильмами все о кинофильмах звездах портал мнения отзывы kino v online');
        $options->set('seo_main_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}