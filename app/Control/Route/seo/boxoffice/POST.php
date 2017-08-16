<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_boxoffice;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_boxoffice_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Бокс-офис');
        $options->set('seo_boxoffice_description', !empty($_POST['description']) ? $_POST['description'] : 'Анализ последних финансовых сводок из мира кино в рубрике «Бокс-офис». Под прицелом — положение дел в США, России и международном прокате.');
        $options->set('seo_boxoffice_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'бокс офис анализ последних финансовых сводок из мира кино');
        $options->set('seo_boxoffice_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Сборы в США');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}