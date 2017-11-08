<?php
namespace Control\Route_sys_player;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\System\Parser\Parser;
use Kinomania\System\Debug\Debug;
use Kinomania\Control\Player\Player;

class POST extends AdminController
{
	public function player()
    {
    	$setplayer = new Player();
    	$setplayer->setPlayer($_POST['type']);
    	$player = $setplayer->selectPlayer();
        Debug::prn($player);
        $this->addData([
            'player' => $player,
        ]);
        $this->setTitle('Отладка парсера / результат');
        $this->setTemplate('sys/player/result.html.php');
    }
}