<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_top_action;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_top_action_title', !empty($_POST['title']) ? $_POST['title'] : '100 ЛУЧШИХ БОЕВИКОВ');
        $options->set('seo_top_action_description', !empty($_POST['description']) ? $_POST['description'] : 'Читатели «Киномании» сами выбирают, какое кино считать хорошим, а какое совсем не удалось. В нашем рейтинге — фильмы с самими высокими оценками на сайте. Выбирайте жанр, страну-производителя, временной период — и перед вами топ лучших фильмов, составленный по оценкам зрителей.');
        $options->set('seo_top_action_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : '');
        $options->set('seo_top_action_h1', !empty($_POST['h1']) ? $_POST['h1'] : '100 ЛУЧШИХ БОЕВИКОВ');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}