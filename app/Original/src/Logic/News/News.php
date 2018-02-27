<?php
namespace Kinomania\Original\Logic\News;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\News\Preview;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Country;
use Kinomania\System\Debug\Debug;

/**
 * Class News
 * @package Kinomania\Original\Logic\News
 */
class News
{
    use TRepository;
    use TDate;
    
    public function getMore($category, $id)
    {
        $moreList = [];
        
        switch ($category) {
            case 'Новости кино':
                break;
            case 'Зарубежные сериалы':
                break;
            case 'Российские сериалы':
                break;
            case 'Бокс-офис':
                break;
            case 'Рецензии':
                break;
            case 'Ожидания':
                break;
            case 'Был бы повод':
                break;
            case 'Блог':
                break;
            case 'Арткиномания':
                break;
            case 'Интервью':
                break;
            case 'BOOM':
                break;
            case 'Short':
                break;
            case 'Пресс-обзор':
                break;
            case 'В десятку':
                break;
            case 'Инсайд':
                break;
            case 'Фестивали и премии':
                break;
            case 'Подборки':
                break;
            default:
                $category = '';
        }
        $id = intval($id);
        
        if ('' != $category) {
            $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM `news` as `t1` JOIN 
                                              (SELECT `id` FROM `news` WHERE 
                                                  `status` = 'show' AND `category` = '{$category}' 
                                                  ORDER BY `publish` DESC LIMIT 4) as `t` 
                                              ON t1.`id` = t.`id`
                                              LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                              WHERE t1.`id` != {$id} LIMIT 3
                                            ");
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.235.160.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nnc.jpg';
                }
                
                $moreList[] = [
                    Preview::ID => $row['id'],
                    Preview::IMAGE => $row['image'],
                    Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                    Preview::TITLE => $row['title'],
                    Preview::ANONS => $row['anons'],
                    Preview::COMMENT => $row['comment'],
                ];
            }
        }
        
        return $moreList;
    }
    
    public function getArticleItem($id)
    {
        $item = [];
        
        $id = intval($id);

        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `status`, `category`, `publish`, 
                                            `authorId`, `title`, `title_html`, `text`, `anons`, `filmId`
                                            FROM `news` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $allowed = ['Новости кино', 'Зарубежные сериалы', 'Российские сериалы', 'Арткиномания', 'Фестивали и премии'];
            if (!in_array($row['category'], $allowed)) {
                if (Wrap::$debugEnabled || 'show' == $row['status']) {
                    if ('' != $row['image']) {
                        $imageName = md5($id);
                        $row['image'] = Server::STATIC[$row['s']] . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                    }

                    if (!empty($row['publish'])) {
                        $row['publish'] = $this->formatDate($row['publish'], true, ', ');
                    }
                    
                    if (empty($row['title_html'])) {
                        $row['title_html'] = $row['title'];
                    }
                    
                    /**
                     * Tags.
                     */
                    $row['tags'] = [];
                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`tag` FROM `news_tag_value` as `t1` JOIN `news_tag` as `t2` ON t1.`id` = t2.`tagId` WHERE t2.`newsId` = {$id}");
                    while ($row2 = $result2->fetch_assoc()) {
                        $row['tags'][$row2['id']] = $row2['tag'];
                    }

                    /**
                     * Author.
                     */
                    $row['login'] = '';
                    $row['name'] = '';
                    $row['avatar'] = '';
                    $authorId = intval($row['authorId']);
                    $result2 = $this->mysql()->query("SELECT `s`, `image`, `login`, `name`, `surname` FROM `user` WHERE `id` = {$authorId} LIMIT 1");
                    if ($row2 = $result2->fetch_assoc()) {
                        $row['login'] = $row2['login'];
                        $row['name'] = $row2['name'] . ' ' . $row2['surname'];
                        if (empty(trim($row['name']))) {
                            $row['name'] = $row['login'];
                        }
                        if ('Блог' == $row['category']) {
                            if ('' != $row['image']) {
                                $imageName = md5($authorId);
                                $row['avatar'] = Server::STATIC[$row2['s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row2['image'];
                            } else {
                                $row['avatar'] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
                            }
                        }
                    } else {
                        $authorId = 0;
                    }
                    
                    /**
                     * Film name.
                     */
                    $row['film_name'] = '';
                    if (0 < $row['filmId']) {
                        $filmId = intval($row['filmId']);
                        $result2 = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
                        if ($row2 = $result2->fetch_assoc()) {
                            if (empty($row2['name_ru'])) {
                                $row['film_name'] = $row2['name_origin'];
                            } else {
                                $row['film_name'] = $row2['name_ru'];
                            }
                        }
                        if (empty($row['film_name'])) {
                            $row['film_name'] = $row['title'];
                        }
                    }

                    /**
                     * Category link.
                     */
                    $row['link'] = '';
                    switch ($row['category']) {
                        case 'Бокс-офис':
                            $row['link'] = 'article/boxoffice';
                            break;
                        case 'Рецензии':
                            $row['link'] = 'reviews';
                            break;
                        case 'Ожидания':
                            $row['link'] = 'article/anticipation';
                            break;
                        case 'Был бы повод':
                            $row['link'] = 'article/reason';
                            break;
                        case 'Арткиномания':
                            $row['link'] = 'news/artkinomania';
                            break;
                        case 'Интервью':
                            $row['link'] = 'article/interview';
                            break;
                        case 'BOOM':
                            $row['link'] = 'article/movie_memorial';
                            break;
                        case 'Short':
                            $row['link'] = 'article/shorts';
                            break;
                        case 'Пресс-обзор':
                            $row['link'] = 'article/press_review';
                            break;
                        case 'В десятку':
                            $row['link'] = 'article/in_ten';
                            break;
                        case 'Инсайд':
                            $row['link'] = 'article/inside';
                            break;
                        case 'Подборки':
                            $row['link'] = 'top';
                            break;
                    }
                    
                    $item = [
                        \Kinomania\Original\Key\News\News::IMAGE => $row['image'],
                        \Kinomania\Original\Key\News\News::PUBLISH => $row['publish'],
                        \Kinomania\Original\Key\News\News::TITLE => $row['title'],
                        \Kinomania\Original\Key\News\News::TITLE_HTML => $row['title_html'],
                        \Kinomania\Original\Key\News\News::TEXT => $this->getGallery($row['text']),
                        \Kinomania\Original\Key\News\News::ANONS => $row['anons'],
                        \Kinomania\Original\Key\News\News::ANONS_STRIPED => htmlspecialchars(strip_tags($row['anons'])),
                        \Kinomania\Original\Key\News\News::TITLE_ENCODED => urlencode($row['title']),
                        \Kinomania\Original\Key\News\News::TAGS => $row['tags'],
                        \Kinomania\Original\Key\News\News::AUTHOR_ID => $authorId,
                        \Kinomania\Original\Key\News\News::AUTHOR_LOGIN => $row['login'],
                        \Kinomania\Original\Key\News\News::AUTHOR_NAME => $row['name'],
                        \Kinomania\Original\Key\News\News::AVATAR => $row['avatar'],
                        \Kinomania\Original\Key\News\News::CATEGORY => $row['category'],
                        \Kinomania\Original\Key\News\News::FILM_ID => $row['filmId'],
                        \Kinomania\Original\Key\News\News::FILM_NAME => $row['film_name'],
                        \Kinomania\Original\Key\News\News::LINK => $row['link'],
                    ];
                }
            }
        }
        
        return $item;
    }
    
    public function getNewsItem($id)
    {
        $item = [];
        
        $id = intval($id);
        
        $result = $this->mysql()->query("SELECT 
                                            `id`, `s`, `image`, `status`, `category`, `publish`, 
                                            `authorId`, `title`, `title_html`, `text`, `anons`
                                            FROM `news` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $allowed = ['Новости кино', 'Зарубежные сериалы', 'Российские сериалы', 'Арткиномания', 'Фестивали и премии'];
            if (in_array($row['category'], $allowed)) {
                if (Wrap::$debugEnabled || 'show' == $row['status']) {
                    if ('' != $row['image']) {
                        $imageName = md5($id);
                        $row['image'] = Server::STATIC[$row['s']] . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                    }

                    if (!empty($row['publish'])) {
                        $row['publish'] = $this->formatDate($row['publish'], true, ', ');
                    }
                    
                    if (empty($row['title_html'])) {
                        $row['title_html'] = $row['title'];
                    }
                    
                    /**
                     * Tags.
                     */
                    $row['tags'] = [];
                    $result2 = $this->mysql()->query("SELECT t1.`id`, t1.`tag` FROM `news_tag_value` as `t1` JOIN `news_tag` as `t2` ON t1.`id` = t2.`tagId` WHERE t2.`newsId` = {$id}");
                    while ($row2 = $result2->fetch_assoc()) {
                        $row['tags'][$row2['id']] = $row2['tag'];
                    }

                    /**
                     * Author.
                     */
                    $row['login'] = '';
                    $row['name'] = '';
                    $authorId = intval($row['authorId']);
                    $result2 = $this->mysql()->query("SELECT `login`, `name`, `surname` FROM `user` WHERE `id` = {$authorId} LIMIT 1");
                    if($result2){
                        if ($row2 = $result2->fetch_assoc()) {
                            $row['login'] = $row2['login'];
                            $row['name'] = $row2['name'] . ' ' . $row2['surname'];
                            if (empty(trim($row['name']))) {
                                $row['name'] = $row['login'];
                            }
                        } else {
                            $authorId = 0;
                        }
                    }
                    else {
                        $authorId = 0;
                    }
                    
                    $item = [
                        \Kinomania\Original\Key\News\News::IMAGE => $row['image'],
                        \Kinomania\Original\Key\News\News::PUBLISH => $row['publish'],
                        \Kinomania\Original\Key\News\News::TITLE => $row['title'],
                        \Kinomania\Original\Key\News\News::TITLE_HTML => $row['title_html'],
                        \Kinomania\Original\Key\News\News::TEXT => $this->getGallery($row['text']),
                        \Kinomania\Original\Key\News\News::ANONS => $row['anons'],
                        \Kinomania\Original\Key\News\News::ANONS_STRIPED => htmlspecialchars(strip_tags($row['anons'])),
                        \Kinomania\Original\Key\News\News::TITLE_ENCODED => urlencode($row['title']),
                        \Kinomania\Original\Key\News\News::TAGS => $row['tags'],
                        \Kinomania\Original\Key\News\News::AUTHOR_ID => $authorId,
                        \Kinomania\Original\Key\News\News::AUTHOR_LOGIN => $row['login'],
                        \Kinomania\Original\Key\News\News::AUTHOR_NAME => $row['name'],
                    ];
                }
            }
        }
        
        return $item;
    }

    /**
     * Get list of news (article, blog, review) items.
     * 
     * @param string $category
     * @param int $page
     * @param int $authorId
     * @return array
     */
    public function getList($category, $page, $authorId = 0)
    {
        $list = [];
        
        $dimension = '';
        $default = '';
        $type = '';
        switch ($category) {
            case 'Новости кино':
                $dimension = '365.199';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'news';
                break;
            case 'Зарубежные сериалы':
                $dimension = '365.199';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'news';
                break;
            case 'Российские сериалы':
                $dimension = '365.199';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'news';
                break;
            case 'Бокс-офис':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Рецензии':
                $dimension = '263.261';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'review';
                break;
	        case 'Рецензии к сериалам':
		        $dimension = '263.261';
		        $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
		        $type = 'review_series';
		        break;
            case 'Рецензии ART':
                $dimension = '263.261';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'review_art';
                break;
            case 'Ожидания':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Был бы повод':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Блог':
                $dimension = '251.251';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'blog';
                break;
            case 'Блог USER':
                $dimension = '251.251';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'blog USER';
                break;
            case 'Арткиномания':
                $dimension = '365.199';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'news';
                break;
            case 'Интервью':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'BOOM':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Short':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Пресс-обзор':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'В десятку':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Инсайд':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            case 'Фестивали и премии':
                $dimension = '365.199';
                $default = Server::STATIC[0] . '/app/img/content/nni.jpg';
                $type = 'news';
                break;
            case 'Подборки':
                $dimension = '262.261';
                $default = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $type = 'article';
                break;
            default:
                $category = '';
        }

        $page = intval($page);
        $authorId = intval($authorId);
        if ('' != $category && 0 < $page) {
            $offset = ($page - 1) * 12;

            $query = '';
            if ('news' == $type) {
                /**
                 * News query.
                 */
                $query  = "SELECT 
                            t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM `news` AS `t1`
                            LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                            WHERE 
                            t1.`status` = 'show' AND t1.`category` = '{$category}'
                            ORDER BY t1.`publish` DESC LIMIT {$offset}, 12";
            } else if ('article' == $type) {
                /**
                 * Article query.
                 */
                $query  = "SELECT 
                            t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`authorId`, t1.`title`, t1.`anons`, t2.`comment`, t3.`login`, t3.`name`, t3.`surname` FROM `news` AS `t1`
                            LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                            LEFT JOIN `user` AS `t3` ON t1.`authorId` = t3.`id`
                            WHERE 
                            t1.`status` = 'show' AND t1.`category` = '{$category}'
                            ORDER BY t1.`publish` DESC LIMIT {$offset}, 12";
            } else if ('review' == $type) {
                /**
                 * Review query.
                 */
                $query = "SELECT t1.`id`, t1.`image`, t1.`publish`, t1.`filmId`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`country`, t2.`year`, t3.`comment`, t4.`login`, t4.`name`, t4.`surname`, t2.`type`
                            FROM `news` AS `t1`
                            JOIN (SELECT `id`
                            FROM `news`
                            WHERE `status` = 'show'
                            AND `category` = 'Рецензии') as `t` ON t1.`id` = t.`id`
                            JOIN `film` AS `t2` ON t1.`filmId` = t2.`id`
                            LEFT JOIN `news_stat` AS `t3` ON t1.`id` = t3.`newsId`
                            LEFT JOIN `user` AS `t4` ON t1.`authorId` = t4.`id`
                            WHERE t2.`status` = 'show'
                            AND t2.`type` =''
                            ORDER BY t1.`publish`
                            DESC LIMIT {$offset}, 12";
            } else if ('review_series' == $type) {
	            /**
	             * Review query.
	             */
	            $query = "SELECT
                            t1.`id`, t1.`image`, t1.`publish`, t1.`filmId`, t2.`s`, t2.`image`, t2.`type`, t2.`name_origin`, t2.`name_ru`, t2.`country`, t2.`year`, t3.`comment`, t4.`login`, t4.`name`, t4.`surname`
                            FROM `news` AS `t1`
                            JOIN (SELECT `id`
                            FROM `news`
                            WHERE `status` = 'show'
                            AND `category` = 'Рецензии' ) as `t` ON t1.`id` = t.`id`
                            JOIN `film` AS `t2` ON t1.`filmId` = t2.`id`
                            LEFT JOIN `news_stat` AS `t3` ON t1.`id` = t3.`newsId`
                            LEFT JOIN `user` AS `t4` ON t1.`authorId` = t4.`id`
                            WHERE t2.`status` = 'show'
                            AND t2.`type` != '' ORDER BY `publish` DESC LIMIT {$offset}, 12" ;
            } else if ('review_art' == $type) {
                /**
                 * Review ART query.
                 */
                $query = "SELECT 
                            t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`filmId`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`country`, t2.`year`, t3.`comment`, t4.`login`, t4.`name`, t4.`surname`
                            FROM `news` AS `t1` JOIN (SELECT `id` FROM `news` WHERE `status` = 'show' AND `category` = 'Рецензии' ORDER BY `publish` DESC LIMIT {$offset}, 12) as `t` ON t1.`id` = t.`id`
                            JOIN `film` AS `t2` ON t1.`filmId` = t2.`id` 
                            LEFT JOIN `news_stat` AS `t3` ON t1.`id` = t3.`newsId`
                            LEFT JOIN `user` AS `t4` ON t1.`authorId` = t4.`id` WHERE 
                            t2.`status` = 'show' AND t2.`arthouse` = 'yes'";
            } else if ('blog' == $type) {
                /**
                 * Blog query.
                 */
                $query = "SELECT 
                            t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`authorId`, t1.`title`, t1.`anons`, t2.`comment`, t3.`s` as `user_s`, t3.`image` as `user_image`, t3.`login`, t3.`name`, t3.`surname` FROM `news` AS `t1`
                            LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                            LEFT JOIN `user` AS `t3` ON t1.`authorId` = t3.`id`
                            WHERE 
                            t1.`status` = 'show' AND t1.`category` = 'Блог'
                            ORDER BY t1.`publish` DESC LIMIT {$offset}, 12";
            } else if ('blog USER' == $type) {
                /**
                 * Blog query.
                 */
                $query = "SELECT 
                            t1.`id`, t1.`s`, t1.`image`, t1.`publish`, t1.`authorId`, t1.`title`, t1.`anons`, t2.`comment`, t3.`s` AS `user_s`, t3.`image` AS `user_image`, t3.`login`, t3.`name`, t3.`surname` FROM `news` AS `t1`
                            LEFT JOIN `news_stat` AS `t2` ON t1.`id` = t2.`newsId`
                            LEFT JOIN `user` AS `t3` ON t1.`authorId` = t3.`id`
                            WHERE 
                            t1.`status` = 'show' AND t1.`category` = 'Блог' AND t1.`authorId` = {$authorId}
                            ORDER BY t1.`publish` DESC LIMIT {$offset}, 12";
            }
	
	       
            $result = $this->mysql()->query($query);
            if($result){
                while ($row = $result->fetch_assoc()) {
                    if ('review' == $type || 'review_art' == $type || 'review_series' == $type) {
                        if ('' != $row['image']) {
                            $imageName = md5($row['filmId']);
                            $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $dimension . '.' . $row['image'];
                        } else {
                            $row['image'] = $default;
                        }
                    } else {
                        if ('' != $row['image']) {
                            $imageName = md5($row['id']);
                            $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $dimension . '.' . $row['image'];
                        } else {
                            $row['image'] = $default;
                        }
                    }

                    if ('blog' == $type || 'blog USER' == $type) {
                        if ('' != $row['user_image']) {
                            $imageName = md5($row['authorId']);
                            $row['avatar'] = Server::STATIC[$row['user_s']] . '/image' . Path::USER . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.48.48.' . $row['user_image'];
                        } else {
                            $row['avatar'] = Server::STATIC[0] . '/app/img/content/no-avatar.jpg';
                        }
                    }

                    if ('news' == $type) {
                        /**
                         * News item.
                         */
                        $list[] = [
                            Preview::ID => $row['id'],
                            Preview::IMAGE => $row['image'],
                            Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                            Preview::TITLE => $row['title'],
                            Preview::ANONS => $row['anons'],
                            Preview::COMMENT => $row['comment'],
                        ];
                    } else if ('article' == $type) {
                        /**
                         * Article item.
                         */
                        $row['name'] = $row['name'] . ' ' . $row['surname'];
                        if (empty(trim($row['name']))) {
                            $row['name'] = $row['login'];
                        }

                        $list[] = [
                            Preview::ID => $row['id'],
                            Preview::IMAGE => $row['image'],
                            Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                            Preview::TITLE => $row['title'],
                            Preview::ANONS => $row['anons'],
                            Preview::COMMENT => $row['comment'],
                            Preview::LOGIN => $row['login'],
                            Preview::NAME => $row['name'],
                        ];
                    } else if ('blog' == $type || 'blog USER' == $type) {
                        /**
                         * Blog item.
                         */
                        $row['name'] = $row['name'] . ' ' . $row['surname'];
                        if (empty(trim($row['name']))) {
                            $row['name'] = $row['login'];
                        }

                        $list[] = [
                            Preview::ID => $row['id'],
                            Preview::IMAGE => $row['image'],
                            Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                            Preview::TITLE => $row['title'],
                            Preview::ANONS => $row['anons'],
                            Preview::COMMENT => $row['comment'],
                            Preview::LOGIN => $row['login'],
                            Preview::NAME => $row['name'],
                            Preview::AVATAR => $row['avatar'],
                        ];
                    } else if ('review' == $type || 'review_art' == $type || 'review_series' == $type) {
                        /**
                         * Review item.
                         */
                        $row['name'] = $row['name'] . ' ' . $row['surname'];
                        if (empty(trim($row['name']))) {
                            $row['name'] = $row['login'];
                        }

                        /**
                         * Country.
                         */
                        $row['country'] = explode(',', $row['country']);
                        foreach ($row['country'] as $k => $code) {
                            $row['country'][$k] = Country::RU[$code] ?? '';
                        }
                        $row['country'] = implode(', ', $row['country']);
                        if (!empty($row['country'])) {
                            $row['country'] .= ', ';
                        }

                        /**
                         * Director.
                         */
                        $row['director'] = [];
                        $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_crew` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} AND t1.`type` = 'Режиссер' ORDER BY t1.`order` LIMIT 3");
                        while ($row2 = $result2->fetch_assoc()) {
                            $name = $row2['name_ru'];
                            if (empty($name)) {
                                $name = $row2['name_origin'];
                            }
                            $row['director'][] = [$row2['id'], $name];
                        }

                        /**
                         * Actor.
                         */
                        $row['cast'] = [];
                        $result2 = $this->mysql()->query("SELECT t2.`id`, t2.`name_origin`, t2.`name_ru` FROM `film_cast` as `t1` JOIN `person` as `t2` ON t1.`personId` = t2.`id` WHERE t1.`filmId` = {$row['filmId']} ORDER BY t1.`order` LIMIT 5");
                        while ($row2 = $result2->fetch_assoc()) {
                            $name = $row2['name_ru'];
                            if (empty($name)) {
                                $name = $row2['name_origin'];
                            }
                            $row['cast'][] = [$row2['id'], $name];
                        }


                        $list[] = [
                            Preview::ID => $row['id'],
                            Preview::IMAGE => $row['image'],
                            Preview::PUBLISH => $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">'),
                            Preview::TITLE => '',
                            Preview::ANONS => '',
                            Preview::COMMENT => $row['comment'],
                            Preview::LOGIN => $row['login'],
                            Preview::NAME => $row['name'],
                            Preview::FILM_ID => $row['filmId'],
                            Preview::NAME_ORIGIN => $row['name_origin'],
                            Preview::NAME_RU => $row['name_ru'],
                            Preview::COUNTRY => $row['country'],
                            Preview::YEAR => $row['year'],
                            Preview::DIRECTOR => $row['director'],
                            Preview::CAST => $row['cast'],
                        ];
                    }
                }
            }

        }
        return $list;
    }

    /**
     * Insert gallery in text.
     * 
     * @param $text
     * @return mixed
     */
    private function getGallery($text)
    {
        preg_match_all('/#{gellary=(\d+)}/', $text, $matches);
        foreach ($matches[1] as $key => $galleryId) {
            $galleryId = intval($galleryId);
            $trailerId = 0;
            $result =$this->mysql()->query("SELECT `trailerId` FROM `news_gallery` WHERE `id` = {$galleryId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $trailerId = $row['trailerId'];
            }

            $html = '<div class="gallery section-news"><div class="bxslider" style="visibility: hidden;">';
            $result = $this->mysql()->query("SELECT `id`, `s`, `image` FROM `news_gallery_image` WHERE `galleryId` = {$galleryId} ORDER BY `order`");
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $image = Server::STATIC[$row['s']] . Path::NEWS_GALLERY . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $row['image'];
                    $html .= '<div class="item">
                                <div class="inner-section clear row">
                                    <div class="center-section-preview col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="outer-image-prewiew ">
                                            <div class="inner-image-prewiew ">
                                                <img alt="" src="' . $image . '" class="image-prewiew">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            }
            if (0 < $trailerId) {
                $html .= '</div><span class="w-img-layer" data-id="' . $trailerId . '"></span></div>';
            } else {
                $html .= '</div></div>';
            }

            $text = str_replace($matches[0][$key], $html, $text);
        }
        
        return $text;
    }

	public function saveView( $data ) {
    	$query = " SELECT `view` FROM `news` WHERE `id` = 1";
    	if(!$this->mysql()->query( $query )){
    	    $query = "ALTER TABLE `news` ADD `view` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `filmId`";
		    $this->mysql()->query( $query );
	    }
		if($data){
			$views = ($this->selectNewsView($data)) + 1;
			$query = " UPDATE `news` SET `view`= '".$views."' WHERE `id` = '".$data."'";
			$this->mysql()->query( $query );
		}
		return false;
	}
	
	public function selectNewsView( $data ) {
		if ( $data ) {
			$query  = ( " SELECT * FROM `news` WHERE `id` = '".$data."'" );
			$result = $this->mysql()->query( $query );
			while( $row = $result->fetch_assoc() ) {
				return $row['view'];
			}
		}
		return false;
	}
}