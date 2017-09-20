<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_awards;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_awards_title', !empty($_POST['title']) ? $_POST['title'] : 'Кинонаграды и кинофестивали | KINOMANIA.RU');
        $options->set('seo_awards_description', !empty($_POST['description']) ? $_POST['description'] : 'Кинонаграды и кинофестивали: ОСКАР, Золотой Глобус, ММКФ, Берлинский Кинофестиваль и др. на KINOMANIA.RU. KINOMANIA.RU – все о мире кино и жизни актеров.');
        $options->set('seo_awards_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'кинонаграды, кинофестивали, оскар, золотой глобус, ммкф, берлинский кинофестиваль');
        $options->set('seo_awards_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'ФЕСТИВАЛИ И ПРЕМИИ');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}