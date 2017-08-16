<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_reviews;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_reviews_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Рецензии');
        $options->set('seo_reviews_description', !empty($_POST['description']) ? $_POST['description'] : 'Все рецензии');
        $options->set('seo_reviews_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'рецензия, рецензия на фильм, отзыв');
        $options->set('seo_reviews_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}