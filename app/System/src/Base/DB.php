<?php
namespace Kinomania\System\Base;

use Kinomania\System\Common\TError;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;

/**
 * Often used constructor.
 *
 * Class DB
 * @package Kinomania\System\Base
 */
class DB
{
    use TError;
	use TRepository;
    
    /**
     * DB constructor.
     * @param \mysqli $db
     */
    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }
    public  function  _isset(array $ar, $bd)
    {
    	$list = [];
    	$query = "SELECT* FROM ". $bd ." WHERE `ObjectID` = " . $ar['ObjectID'] ."";
	    $result = $this->mysql()->query($query);
	    while($row = $result->fetch_assoc()) {
		    $list[] = $row;
	    }
	
	    return $list;
    }

    protected $db;
}