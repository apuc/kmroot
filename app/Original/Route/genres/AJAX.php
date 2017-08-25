<?php
namespace Original\Route\genres;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Data\Country;
use Kinomania\System\Data\Genre;

class AJAX extends DefaultController
{
    use TRepository;
    use TDate;

    public function search()
    {
        $list = [];

        $post = new PostBag();
        $filter = json_decode($post->fetch('filter'), JSON_UNESCAPED_UNICODE);

        $genre = $filter['genre'];
        $temp = Genre::RU;
        if (!isset($temp[$genre])) {
            $genre = '';
        }

        $country = $filter['country'];
        $temp = Country::RU;
        if (!isset($temp[$country])) {
            $country = '';
        }
        $year = intval($filter['year']);
        if (1900 > $year || 2010 < $year) {
            $year = 0;
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');

        $key = 'top:films';
        if (false && !Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
            $list = unserialize($redis->get($key));
        } else {
            $query = "SELECT t1.`id`, t1.`name_origin`, t1.`name_ru`, t2.`rate`, t2.`rate_count`
                                            FROM `film` as `t1`
                                            JOIN `film_stat` as `t2` ON t1.`id` = t2.`filmId` 
                                            ";
            if ('' != $genre) {
                $query .= " JOIN `film_genre` as `t3` ON t1.`id` = t3.`filmId` ";
            }
            if ('' != $country) {
                $query .= " JOIN `film_country` as `t4` ON t1.`id` = t4.`filmId` ";
            }
            $query .= "WHERE t1.`status` = 'show' ";


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

            $query .= " AND t2.`rate_count` > 10 ORDER BY t2.`rate` DESC LIMIT 100 ";

            $result = $this->mysql()->query($query);
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
            if (false && !Wrap::$debugEnabled && [] != $list && $redisStatus) {
                $redis->set($key, serialize($list), 300); // 5 min
            }
        }

        $this->setContent(json_encode($list));
    }
	
	// Пагинация Ajax
	public static function pagination_ajax($total, $per_page, $num_links, $start_row, $action = '', $ident = '', $before = '', $form = '') {
		$num_pages = ceil($total / $per_page); // Общее число страниц
		if ($num_pages == 1)
			return '';
		$cur_page = $start_row; // Количество элементов на страницы
		if ($cur_page > $total) {
			$cur_page = ($num_pages - 1) * $per_page;
		}
		$cur_page = floor(($cur_page / $per_page) + 1); // Номер текущей страницы
		$start = (($cur_page - $num_links) > 0) ? $cur_page - $num_links : 0; // Номер стартовой страницы выводимой в пейджинге
		$end = (($cur_page + $num_links) < $num_pages) ? $cur_page + $num_links : $num_pages; // Номер последней страницы выводимой в пейджинге
		
		// Формируем ссылку на первую страницу
		$output = '';
		$output .= $cur_page > ($num_links + 1) ? '<span onclick="process(\''.$action.'\',\''.$ident.'\',\''.$before.'\',\''.$form.'\')" class="pagination__button pagination__button--first pagination__button--enable"></span>' : '<span class="pagination__button pagination__button--first"></span>';
		
		// Формируем ссылку на предыдущую страницу
		if ($cur_page != 1) {
			$i = $start_row - $per_page;
			if ($i <= 0)
				$i = 0;
			$output .= '<span onclick="process(\''.$action.'/p/'.$i.'\',\''.$ident.'\',\''.$before.'\',\''.$form.'\')" class="pagination__button pagination__button--prev pagination__button--enable"></span>';
		}
		else {
			$output .='<span class="pagination__button pagination__button--prev"></span>';
		}
		
		// Формируем список страниц с учетом стартовой и последней страницы   >
		for ($loop = $start; $loop <= $end; $loop++) {
			$i = ($loop * $per_page) - $per_page;
			
			if ($i >= 0) {
				if ($cur_page == $loop) {
					
					// Текущая страница
					$output .= '<span class="pagination__button pagination__button--active">'.$loop.'</span>';
				} else {
					
					$n = ($i == 0) ? '' : $i;
					
					$output .= '<span onclick="process(\''.$action.'/p/'.$n.'\',\''.$ident.'\',\''.$before.'\',\''.$form.'\')" class="pagination__button pagination__button--enable">'.$loop.'</span>';
				}
			}
		}
		$output .= $cur_page < $num_pages ? '<span onclick="process(\''.$action.'/p/'.($cur_page * $per_page).'\',\''.$ident.'\',\''.$before.'\',\''.$form.'\')" class="pagination__button pagination__button--next pagination__button--enable"></span>' : '<span class="pagination__button pagination__button--next"></span>'; // Формируем ссылку на следующую страницу
		
		// Формируем ссылку на последнюю страницу
		if (($cur_page + $num_links) < $num_pages) {
			$i = (($num_pages * $per_page) - $per_page);
			$output .= '<span onclick="process(\''.$action.'/p/'.$i.'\',\''.$ident.'\',\''.$before.'\',\''.$form.'\')" class="pagination__button pagination__button--last pagination__button--enable"></span>';
		} else {
			$output .='<span class="pagination__button pagination__button--last"></span>';
		}
		return '<div class="pagination">'.$output.'</div>';
	}
 
 
 
}