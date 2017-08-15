<?php
namespace Kinomania\Original\Logic\Person;

use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class News
 * @package Kinomania\Original\Person
 */
class News
{
    use TRepository;
    use TDate;

    /**
     * @param int $personId
     * @param int $page
     * @return array
     */
    public function get($personId, $page = 1)
    {
        $list = [];
        
        $personId = intval($personId);
        $page = intval($page);
        $offset = ($page - 1) * 12;
        
        $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`category`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM
                                              `news_link` as `t` JOIN   
                                              `news` as `t1` ON t.`newsId` = t1.`id`
                                              LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                              WHERE t.`personId` = {$personId} AND t1.`status` = 'show' ORDER BY t1.`publish` DESC LIMIT {$offset}, 12
                                            ");
        while ($row = $result->fetch_assoc()) {
            switch ($row['category']) {
                case 'Новости кино':
                    $row['category'] = 'news';
                    break;
                case 'Зарубежные сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Российские сериалы':
                    $row['category'] = 'news';
                    break;
                case 'Арткиномания':
                    $row['category'] = 'news';
                    break;
                case 'Фестивали и премии':
                    $row['category'] = 'news';
                    break;
                default:
                    $row['category'] = 'article';
            }
            $row['publish'] = $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">');
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.353.188.' . $row['image'];
            } else {
                $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
            }
            $list[] = $row;
        }

        return $list;
    }
}