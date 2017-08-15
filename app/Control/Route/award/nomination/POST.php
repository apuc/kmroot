<?php
namespace Control\Route_award_nomination;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Award\Nomination\Nomination;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_award_nomination
 */
class POST extends AdminController
{
    /**
     *
     */
    public function delete()
    {
        $post = new PostBag();
        $awardId = $post->fetchInt('awardId');

        $nomination = new Nomination($this->mysql());

        if ($nomination->delete()) {
            $this->successMessage('Номинация удалена');
        } else {
            $this->setErrorComment($nomination->error());
            $this->failMessage('Не удалось удалить номинацию');
        }

        $this->setRedirect($this->request->makeUrl('award/nomination?id=' . $awardId));
    }

    /**
     *
     */
    public function edit()
    {
        $post = new PostBag();
        $awardId = $post->fetchInt('awardId');

        $nomination = new Nomination($this->mysql());

        if ($nomination->edit()) {
            $this->successMessage('Номинация сохранена');
        } else {
            $this->setErrorComment($nomination->error());
            switch ($nomination->error()) {
                case Nomination::ER_INPUT:
                    $this->failMessage('Введите название');
                    break;
                case Nomination::ER_EXIST:
                    $this->failMessage('Название уже занято');
                    break;
                default:
                    $this->failMessage('Не удалось сохранить номинацию');
            }
        }

        $this->setRedirect($this->request->makeUrl('award/nomination?id=' . $awardId));
    }

    /**
     *
     */
    public function add()
    {
        $post = new PostBag();
        $awardId = $post->fetchInt('awardId');

        $nomination = new Nomination($this->mysql());

        if ($nomination->add()) {
            $this->successMessage('Номинация добавлена');
        } else {
            $this->setErrorComment($nomination->error());
            switch ($nomination->error()) {
                case Nomination::ER_INPUT:
                    $this->failMessage('Введите название');
                    break;
                case Nomination::ER_EXIST:
                    $this->failMessage('Название уже занято');
                    break;
                default:
                    $this->failMessage('Не удалось добавить номинацию');
            }
        }

        $this->setRedirect($this->request->makeUrl('award/nomination?id=' . $awardId));
    }
}