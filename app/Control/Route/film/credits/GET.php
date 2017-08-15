<?php
namespace Control\Route_film_credits;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Company\Company;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Film\Filmography\Filmography;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');
        $film = new Film($this->mysql());
        $item = $film->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('film'));
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
            $this->setTemplate('film/credits/index.html.php');
        }
    }
}