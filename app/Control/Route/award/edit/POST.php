<?php
namespace Control\Route_award_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Award\Award;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_award
 */
class POST extends AdminController
{
    public function edit()
    {
        $award = new Award($this->mysql());
        
        if ($award->edit()) {
            $this->successMessage('Премия сохранена');
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
                    $this->failMessage('Не удалось сохранить премию');
            }

            $post = new PostBag();
            $id = $post->fetchInt('id');

            $award = new Award($this->mysql());
            $item = $award->getById($id);
            
            $this->addData([
                'item' => $item
            ]);
            $this->setTitle('Редактировать премию');
            $this->setTemplate('award/edit.html.php');
        }
    }
}