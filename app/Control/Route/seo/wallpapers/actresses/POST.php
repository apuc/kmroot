<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_wallpapers_actresses;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_actresses_title', !empty($_POST['title']) ? $_POST['title'] : 'ОБОИ К АКТРИСАМ | KINOMANIA.RU');
        $options->set('seo_actresses_description', !empty($_POST['description']) ? $_POST['description'] : 'Большая коллекция фотографий и обоев с самыми популярными актерами кино и сериалов на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_actresses_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'обои, рабочий стол, wallpaper, скачать, актрисы');
        $options->set('seo_actresses_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Обои к актрисам');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}