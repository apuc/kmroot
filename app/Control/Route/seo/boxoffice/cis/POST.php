<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_boxoffice_cis;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_boxoffice_cis_title', !empty($_POST['title']) ? $_POST['title'] : 'Кассовые сборы фильмов в прокате СНГ (Box-office)');
        $options->set('seo_boxoffice_cis_description', !empty($_POST['description']) ? $_POST['description'] : 'Кассовые сборы фильмов в прокате СНГ.');
        $options->set('seo_boxoffice_cis_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'Кассовые сборы фильмов, Box-office, касса, лидерв проката');
        $options->set('seo_boxoffice_cis_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'KINOMANIA.RU');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}