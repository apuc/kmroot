<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_reason;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_reason_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Был бы повод...');
        $options->set('seo_reason_description', !empty($_POST['description']) ? $_POST['description'] : 'Самые животрепещущие информационные поводы, дарящие возможность вспомнить то, о чём не стоит забывать, в рубрике «Был бы повод...». Наиболее интересная и актуальная информация о классике и новинках мирового кино и многое другое на сайте KINOMANIA.RU.');
        $options->set('seo_reason_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'был бы повод');
        $options->set('seo_reason_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Был бы повод');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}