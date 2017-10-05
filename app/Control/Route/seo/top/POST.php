<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_top;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_top_title', !empty($_POST['title']) ? $_POST['title'] : 'Подборки киномании');
        $options->set('seo_top_description', !empty($_POST['description']) ? $_POST['description'] : 'Подборки киномании');
        $options->set('seo_top_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'cайт про кино кинопортал киносайты с фильмами все о кинофильмах звездах портал мнения отзывы kino v online');
        $options->set('seo_top_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Подборки киномании');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}