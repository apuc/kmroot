<?php
namespace Original\Route_testdb;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\API\AKR;
use Kinomania\System\Data\Afisha;
use Kinomania\System\Db\Db;
use Kinomania\System\Debug\Debug;
use Kinomania\System\GeoLocation\IpGeoBase;
use Kinomania\System\Options\Options;
use Kinomania\System\Data\Player;

class GET extends DefaultController
{
	

    public function index()
    {
	    $player = new Player();
	    $ar = new Db();
	
//	    $query = "SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
//										FROM `film` as `t1`
//										JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId`
//										WHERE t1.`status` = 'show' ";
//	    if($genre){
//		    $query .= "AND t1.`genre` LIKE '%".$genre."%' ";
//	    }
//
//	    $count = $this->mysql()
//	                  ->query("SELECT COUNT(*) as count ". substr($query, strrpos($query, 'FROM')) )
//	                  ->fetch_assoc();
//
//	    $query .= "ORDER BY t2.`rate_count` DESC LIMIT 20";
//
//	    $result = $this->mysql()->query($query);
//
//	    while($row = $result->fetch_assoc()) {
//		    $list[] = $row;
//	    }
	    
	    $result = $ar->
	    find('`film` as `t1`', 't1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`')       ->
	    join('`film_stat` as `t2`', 't1.`id` = t2.`filmId`')->
	    where(['t1.`status`' => 'show'])->
	    orderBy('t2.`rate_count` DESC')->
	    limit(20)->
	    all();

	    $this->addData([
			'options' => new Options(),
			'list' => $result,
        ]);

      
        $this->setTemplate('testdb/index.html.php');
        
    }
    
}