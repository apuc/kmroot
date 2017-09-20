<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_movie_memorial;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_movie_memorial_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: BOOOM!!');
        $options->set('seo_movie_memorial_description', !empty($_POST['description']) ? $_POST['description'] : 'Архив новостей: все новости о мире кино и жизни актеров.');
        $options->set('seo_movie_memorial_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'кино, новости, актеры, фильмы, кадры, рецензия, обои, ролик, саундтрек');
        $options->set('seo_movie_memorial_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'BOOOM!!');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}