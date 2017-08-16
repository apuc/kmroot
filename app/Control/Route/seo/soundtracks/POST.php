<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_soundtracks;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_soundtracks_title', !empty($_POST['title']) ? $_POST['title'] : 'Саундтреки к фильмам: более 5 000 саундтреков к фильмам, мультфильмам, мюзиклам и сериалам | KINOMANIA.RU');
        $options->set('seo_soundtracks_description', !empty($_POST['description']) ? $_POST['description'] : 'Саундтреки к фильмам: новые и популярные саундтреки к фильмам и сериалам на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_soundtracks_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'саундтрек, фильм, саундтрек к фильмам, саундтреки, soundtrack');
        $options->set('seo_soundtracks_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}