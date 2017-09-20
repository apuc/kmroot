<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_top_films;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_tf_title', !empty($_POST['title']) ? $_POST['title'] : '100 ЛУЧШИХ ФИЛЬМОВ');
        $options->set('seo_tf_description', !empty($_POST['description']) ? $_POST['description'] : 'Рейтинг составлен на основе оценок читателей Киномании.');
        $options->set('seo_tf_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : '');
        $options->set('seo_tf_h1', !empty($_POST['h1']) ? $_POST['h1'] : '100 ЛУЧШИХ ФИЛЬМОВ');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}