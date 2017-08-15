<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_news;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_news_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Новости кино');
        $options->set('seo_news_description', !empty($_POST['description']) ? $_POST['description'] : 'Архив новостей: все новости о мире кино и жизни актеров');
        $options->set('seo_news_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'кино, новости, актеры, фильмы, кадры, рецензия, обои, ролик, саундтрек');
        $options->set('seo_news_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'НОВОСТИ КИНО');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}