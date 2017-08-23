<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_posters;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_posters_title', !empty($_POST['title']) ? $_POST['title'] : 'Постеры к фильмам | KINOMANIA.RU');
        $options->set('seo_posters_description', !empty($_POST['description']) ? $_POST['description'] : 'Постеры к фильмам: огромная коллекция постеров к фильмам, мультфильмам, сериалам и мюзиклам. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_posters_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'постер, poster, коллекция постеров');
        $options->set('seo_posters_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Постеры');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}