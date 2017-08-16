<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_photos;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_photos_title', !empty($_POST['title']) ? $_POST['title'] : 'Фотографии актеров и актрис | KINOMANIA.RU');
        $options->set('seo_photos_description', !empty($_POST['description']) ? $_POST['description'] : 'Большая коллекция фотографий с самыми популярными актерами и актрисами кино и сериалов на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_photos_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'фотографии, фото, актеры, актрисы, photo');
        $options->set('seo_photos_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}