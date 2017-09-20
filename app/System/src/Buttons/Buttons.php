<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.08.2017
 * Time: 10:59
 */

namespace Kinomania\System\Buttons;


class Buttons
{
	public $page;
	public $text;
	public $isActive;
	
	public function __construct($page, $isActive = true, $text = null)
	{
		$this->page = $page;
		$this->text = is_null($text) ? $page : $text;
		$this->isActive = $isActive;
	}
	
	public function activate()
	{
		$this->isActive = true;
	}
	
	public function deactivate()
	{
		$this->isActive = false;
	}
}