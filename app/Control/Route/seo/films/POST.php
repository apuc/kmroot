<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_films;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_films_title', !empty($_POST['title']) ? $_POST['title'] : 'Обои к фильмам | KINOMANIA.RU');
        $options->set('seo_films_description', !empty($_POST['description']) ? $_POST['description'] : 'Большая коллекция фотографий и обоев с самыми популярными актерами кино и сериалов на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_films_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'обои, рабочий стол, wallpaper, скачать, фильмы');
        $options->set('seo_films_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}