<?php
namespace Control\Route_film_release;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $from = $get->fetch('from', date('Y-m-d', strtotime('now') - 604800));
        
        $list = [];   
        $result = $this->mysql()->query("SELECT DISTINCT `premiere_ru` FROM `film` WHERE `premiere_ru` >= '{$from}' LIMIT 100");
        while ($row = $result->fetch_assoc()) {
            $list[] = $row['premiere_ru'];
        }
        
        $this->addData([
            'get' => new GetBag(),
            'from' => $from,
            'list' => $list,
        ]);
        $this->setTitle('График релизов');
        $this->setTemplate('film/release/index.html.php');
    }
}