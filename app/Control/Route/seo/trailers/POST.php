<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_trailers;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_trailers_title', !empty($_POST['title']) ? $_POST['title'] : 'Трейлеры фильмов | KINOMANIA.RU');
        $options->set('seo_trailers_description', !empty($_POST['description']) ? $_POST['description'] : 'Трейлеры фильмов: новые трейлеры к фильмам, мультфильмам, российским и зарубежным сериалам. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_trailers_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'трейлер, trailer, тизер, скачивание, онлайн');
        $options->set('seo_trailers_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Трейлеры');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}