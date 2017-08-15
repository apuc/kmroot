<?php
namespace Control\Route_film_credits_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Filmography\Filmography;
use Kinomania\Control\Person\Photo\Photo;

class AJAX extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        
        $film = new Filmography($this->mysql());
        $item = $film->getCastItem($get->fetchInt('id'));
        
        if (0 == $item->id()) {
            $this->setContent('');
        } else {
            $this->addData([
                'filmId' => $get->fetchInt('filmId'),
                'item' => $item
            ]);
            $this->setTemplate('film/credits/cast.edit.html.php');
        }
    }
    
    public function crew()
    {
        $get = new GetBag();
        
        $film = new Filmography($this->mysql());
        $item = $film->getCrewItem($get->fetchInt('id'));
        
        if (0 == $item->id()) {
            $this->setContent('');
        } else {
            $this->addData([
                'filmId' => $get->fetchInt('filmId'),
                'item' => $item
            ]);
            $this->setTemplate('film/credits/crew.edit.html.php');
        }
    }
}