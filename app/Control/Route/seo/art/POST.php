<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_art;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_art_title', !empty($_POST['title']) ? $_POST['title'] : 'АртКиноМания :: Артхаус, другое кино, авторское кино');
        $options->set('seo_art_description', !empty($_POST['description']) ? $_POST['description'] : 'Рецензии на авторское кино, обзоры, новости.');
        $options->set('seo_art_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'артхаус, другое кино, авторское кино');
        $options->set('seo_art_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'АРТКИНОМАНИЯ');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}