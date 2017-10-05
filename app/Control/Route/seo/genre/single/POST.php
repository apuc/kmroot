<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_genre_single;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_genre_'.$_POST['slug'].'_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Жанры');
        $options->set('seo_genre_'.$_POST['slug'].'_description', !empty($_POST['description']) ? $_POST['description'] : 'Жанры');
        $options->set('seo_genre_'.$_POST['slug'].'_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'Жанры');
        $options->set('seo_genre_'.$_POST['slug'].'_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Жанры');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}