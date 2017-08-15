<?php
namespace Control\Route_person_credits;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Filmography\Filmography;
use Kinomania\Control\Person\Person;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $person = new Person($this->mysql());
        $item = $person->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect('person');
        } else {
            $filmography = new Filmography($this->mysql());
            $crewTuple = [
                'Режиссер' => 'Director',
                'Сценарист' => 'Scenario',
                'Продюсер' => 'Producer',
                'Оператор' => 'Operator',
                'Композитор' => 'Composer'
            ];
            $this->addData([
                'item' => $item,
                'castList' => $filmography->getCast($item->id()),
                'crewList' => $filmography->getCrew($item->id()),
                'crewTuple' => $crewTuple
            ]);
            $this->setTitle('Фильмография');
            $this->setTemplate('person/films/index.html.php');
        }
    }
}