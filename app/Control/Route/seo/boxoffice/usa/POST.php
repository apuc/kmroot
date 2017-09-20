<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_boxoffice_usa;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_boxoffice_usa_title', !empty($_POST['title']) ? $_POST['title'] : 'Кассовые сборы фильмов в прокате США (Box-office)');
        $options->set('seo_boxoffice_usa_description', !empty($_POST['description']) ? $_POST['description'] : 'Кассовые сборы фильмов в прокате США');
        $options->set('seo_boxoffice_usa_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'Кассовые сборы фильмов, Box-office, касса, лидерв проката');
        $options->set('seo_boxoffice_usa_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}