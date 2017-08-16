<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_shorts;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_shorts_title', !empty($_POST['title']) ? $_POST['title'] : 'Лучшие короткометражные фильмы на KINOMANIA.RU');
        $options->set('seo_shorts_description', !empty($_POST['description']) ? $_POST['description'] : 'Лучшие короткометражные фильмы со всего света в рубрике «SHORTы». Самая интересная и актуальная информация о новинках мирового кинопроката и многое другое из мира кино на сайте KINOMANIA.RU.');
        $options->set('seo_shorts_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'SHORTы лучшие короткометражные фильмы со всего света');
        $options->set('seo_shorts_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}