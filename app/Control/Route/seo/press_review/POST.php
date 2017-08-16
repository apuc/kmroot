<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_press_review;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_press_review_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Пресс-обзор');
        $options->set('seo_press_review_description', !empty($_POST['description']) ? $_POST['description'] : 'Статьи в зарубежной прессе о новинках американского кинопроката в рубрике «Пресс-обзор». Самая интересная и актуальная информация о новинках мирового кинопроката и многое другое из мира кино на сайте KINOMANIA.RU.');
        $options->set('seo_press_review_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'зарубежная пресса о новинках американского кинопроката');
        $options->set('seo_press_review_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}