<?php
namespace Kinomania\Original\Logic\News;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\News\Preview;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;

/**
 * Class Tag
 * @package Kinomania\Original\Logic\News
 */
class Tag
{
    use TRepository;
    use TDate;

    /**
     * Get list of tag items.
     *
     * @param int $tagId
     * @param int $page
     * @return array
     */
    public function getList($tagId, $page)
    {
        $list = [];

        $tagId = intval($tagId);
        $page = intval($page);

        if (0 < $page) {
            $offset = ($page - 1) * 12;
            
            $result = $this->mysql()->query("SELECT 
                                    t2.`id`, t2.`s`, t2.`image`, t2.`category`, t2.`publish`, t2.`title`, t2.`anons`, t3.`comment` FROM 
                                    `news_tag` as `t1` 
                                    JOIN `news` as `t2` ON t1.`newsId` = t2.`id` 
                                    LEFT JOIN `news_stat` as `t3` ON t2.`id` = t3.`newsId` 
                                    WHERE 
                                    t1.`tagId` = {$tagId} AND t2.`status` = 'show'
                                    ORDER BY t2.`publish` DESC LIMIT {$offset}, 12");
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
                

                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.365.199.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nni.jpg';
                }
                
                $list[] = [
                    Preview::ID => $row['id'],
                    Preview::IMAGE => $row['image'],
                    Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                    Preview::TITLE => $row['title'],
                    Preview::ANONS => $row['anons'],
                    Preview::COMMENT => $row['comment'],
                    Preview::CATEGORY => $row['category'],
                ];
            }
        }

        return $list;
    }
    
}