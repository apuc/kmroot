<?php
namespace Kinomania\System\Search;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 28.08.2017
 * Time: 13:41
 */
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;


class Search
{
	use TRepository;
	use TDate;
	public function getList($startPage,$limit, $genre, $country, $year)
	{
		$list = [];
		
		$startPage = intval(($startPage * $limit) - $limit);
		$limit = intval($limit);
		$query = "SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
										FROM `film` as `t1`
										JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId`
										";
		if ('' != $genre) {
			$query .=  " JOIN `film_genre` as `t3` ON t1.`id` = t3.`filmId` ";
		}
		if ('' != $country) {
			$query .= " JOIN `film_country` as `t4` ON t1.`id` = t4.`filmId` ";
		}
		if (0 < $year) {
			$year_b = $year + 10;
			$query .= " AND t1.`year` >= {$year} AND t1.`year` < {$year_b}";
		}
		
		if ('' != $country) {
			$query .= " AND t4.`country` = '{$country}' ";
		}
		
		if ('' != $genre) {
			$query .= " AND t3.`genre` = '{$genre}' ";
		}
		$query .= "WHERE t1.`status` = 'show' ORDER BY t2.`rate_count` DESC LIMIT $limit OFFSET $startPage";
		$result = $this->mysql()->query($query);
		while($row = $result->fetch_assoc()) {
			$list[] = $row;
		}
		
		return $list;
	}
}