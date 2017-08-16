<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_boxoffice_russia;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_boxoffice_russia_title', !empty($_POST['title']) ? $_POST['title'] : 'Кассовые сборы фильмов в прокате России (Box-office)');
        $options->set('seo_boxoffice_russia_description', !empty($_POST['description']) ? $_POST['description'] : 'Кассовые сборы фильмов в прокате России.');
        $options->set('seo_boxoffice_russia_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'Кассовые сборы фильмов, Box-office, касса, лидерв проката, РФ');
        $options->set('seo_boxoffice_russia_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}