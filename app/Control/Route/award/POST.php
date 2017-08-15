<?php
namespace Control\Route_award;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Award\Award;
use Kinomania\Control\Award\Year\Year;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_award
 */
class POST extends AdminController
{
    /**
     *
     */
    public function delete()
    {
        $award = new Award($this->mysql());

        if ($award->delete()) {
            $this->successMessage('Премия удалена');
        } else {
            $this->setErrorComment($award->error());
            $this->failMessage('Не удалось удалить премию');
        }

        $this->setRedirect();
    }

    /**
     *
     */
    public function addYear()
    {
        $year = new Year($this->mysql());

        if ($year->add()) {
            $this->successMessage('Год добавлен');
        } else {
            $this->setErrorComment($year->error());
            switch ($year->error()) {
                case Year::ER_INPUT:
                    $this->failMessage('Введите год');
                    break;
                case Year::ER_EXIST:
                    $this->failMessage('Год уже имеется');
                    break;
                default:
                    $this->failMessage('Не удалось добавить год');
            }
        }

        $this->setRedirect();
    }
}