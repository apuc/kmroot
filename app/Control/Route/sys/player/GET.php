<?php
namespace Control\Route_sys_player;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Player\Player;

class GET extends AdminController
{
    public function index()
    {
	    $player = new Player();
	    $this->addData([
		    'player' => $player->selectPlayer(),
	    ]);
        $this->setTitle('Выбор плеера');
        $this->setTemplate('sys/player/index.html.php');
    }
}