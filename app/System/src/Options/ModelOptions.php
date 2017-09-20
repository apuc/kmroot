<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 18.08.2017
 * Time: 13:20
 */

namespace Kinomania\System\Options;

use Kinomania\System\Common\TRepository;


class ModelOptions
{
	public function __construct() {
	    $this->table = $this->setTableName();
	}
	
	use TRepository;
	
	public function query_get($key){
		$result = $this->mysql()->query("SELECT *
												FROM `".$this->table."`
												WHERE `key` LIKE '{$key}' LIMIT 1");
		return $result;
	}
	public function query_set($key, $value){
		$this->mysql()->query(	"UPDATE `".$this->table."`
										SET `value` = '{$value}'
										WHERE `key` LIKE '{$key}'");
	}
	public function query_insert($key, $value){
		$this->mysql()->query("INSERT INTO `".$this->table."` (`key`, `value`)
									  VALUES ('{$key}', '{$value}')");
	}

	private function setTableName()
    {
        $className = explode('\\', self::class);
        return mb_strtolower(str_ireplace('model', '', $className[count($className) - 1]));
    }
}