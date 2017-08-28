<?php
namespace Kinomania\System\Pagination;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.08.2017
 * Time: 11:23
 */
use Kinomania\System\Buttons\Buttons;

class Pagination
{
	public $buttons = [];
	
	public function __construct(Array $options = (['itemsCount' => 257, 'itemsPerPage' => 10, 'currentPage' => 1]))
	{
		extract($options);
		
		/** @var int $currentPage */
		if (!$currentPage) {
			return;
		}
		
		/** @var int $pagesCount
		 *  @var int $itemsCount
		 *  @var int $itemsPerPage
		 */
		$pagesCount = ceil($itemsCount / $itemsPerPage);
		
		if ($pagesCount == 1) {
			return;
		}
		
		/** @var int $currentPage */
		if ($currentPage > $pagesCount) {
			$currentPage = $pagesCount;
		}
		if($currentPage > 1) {
			$this->buttons[] = new Buttons(1,$pagesCount,'<<');
		}
		$this->buttons[] = new Buttons($currentPage - 1, $currentPage > 1, '<');
		/*$n=0;
		for ($i = 1; $i <= $pagesCount; $i++) {
			$n++;
			if($n <= 5){
				$active = $currentPage != $i;
				$this->buttons[] = new Buttons($i, $active);
			}
		}*/
		$this->pageCount($currentPage, 5, $pagesCount);
		$this->buttons[] = new Buttons($currentPage + 1, $currentPage < $pagesCount, '>');
		if($currentPage != $pagesCount) {
			$this->buttons[] = new Buttons($pagesCount,$pagesCount,'>>');
		}
	}
	public function pageCount($start, $limit, $pagesCount) {
		/*$n=0;
		for ($i = $start; $i <= $pagesCount; $i++) {
			$n++;
			if($n <= $limit){
				$active = $start != $i;
				$this->buttons[] = new Buttons($i, $active);
			}*/
		if($pagesCount != $start){
			$this->buttons[] = new Buttons($start,false);
			$this->buttons[] = new Buttons($start+1);
			$this->buttons[] = new Buttons($start + 2);
			$this->buttons[] = new Buttons($start + 3);
			$this->buttons[] = new Buttons($start + 4);
		}
		
		
	}
}