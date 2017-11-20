<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_poster_pages_cinema;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_poster_pages_cinema_title', !empty($_POST['title']) ? $_POST['title'] : 'Кинотеатр {cinema} г. {city}');
        $options->set('seo_poster_pages_cinema_description', !empty($_POST['description']) ? $_POST['description'] : 'Кинотеатр {cinema} г. {city}');
        $options->set('seo_poster_pages_cinema_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : '{cinema}, {city}');
        $options->set('seo_poster_pages_cinema_h1', !empty($_POST['h1']) ? $_POST['h1'] : '{cinema} г. {city}');
        $options->set('seo_poster_pages_cinema_text', !empty($_POST['text']) ? $_POST['text'] : 'текст');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}