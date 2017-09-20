<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:56
 */

namespace Control\Route_seo_anticipation;

use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Options\Options;

class POST extends AdminController
{

    public function save()
    {
        $options = new Options();
        $options->set('seo_anticipation_title', !empty($_POST['title']) ? $_POST['title'] : 'KINOMANIA.RU :: Ожидания');
        $options->set('seo_anticipation_description', !empty($_POST['description']) ? $_POST['description'] : 'Кино- и телепроекты ближайшего будущего, о которых есть что сказать уже сейчас, в рубрике &quot;Ожидания&quot;. Самая интересная и актуальная информация о новинках мирового кинопроката и многое другое из мира кино на сайте KINOMANIA.RU.');
        $options->set('seo_anticipation_keywords', !empty($_POST['keywords']) ? $_POST['keywords'] : 'Кинопроекты и телепроекты ближайшего будущего, о которых есть что сказать уже сейчас');
        $options->set('seo_anticipation_h1', !empty($_POST['h1']) ? $_POST['h1'] : 'Ожидания');

        $this->successMessage('Изменения сохранены');
        $this->setRedirect();
    }

}