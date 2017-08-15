<?php
namespace Control\Route_award_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Award\Award;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;

/**
 * Class POST
 * @package Control\Route_award
 */
class POST extends AdminController
{
    public function add()
    {
        $award = new Award($this->mysql());
        
        if ($award->add()) {
            $this->successMessage('Премия добавлена');
            $this->setRedirect($this->request->makeUrl('award'));
        } else {
            $this->setErrorComment($award->error());
            switch ($award->error()) {
                case Award::ER_INPUT:
                    $this->failMessage('Недопустимые символы в коротком названии');
                    break;
                case Award::ER_EXIST:
                    $this->failMessage('Короткое название уже занято');
                    break;
                default:
                    $this->failMessage('Не удалось добавить премию');
            }
            $this->addData([
                'post' => new PostBag()
            ]);
            $this->setTitle('Добавить премию');
            $this->setTemplate('award/add.html.php');
        }
    }
}