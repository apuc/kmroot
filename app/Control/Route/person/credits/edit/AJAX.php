<?php
namespace Control\Route_person_credits_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Filmography\Filmography;

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
                'personId' => $get->fetchInt('personId'),
                'item' => $item
            ]);
            $this->setTemplate('person/films/cast.edit.html.php');
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
                'personId' => $get->fetchInt('personId'),
                'item' => $item
            ]);
            $this->setTemplate('person/films/crew.edit.html.php');
        }
    }
}