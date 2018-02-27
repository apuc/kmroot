<?php
namespace Kinomania\Control\News;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Comment\Comment;
use Kinomania\Control\Person\Stat;
use Kinomania\Control\Server\StaticS;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Text\TText;

/**
 * Class News
 * @package Kinomania\Control\News
 */
class News extends DB
{
    use TDate;
    use TText;
    use TRepository;

    const TITLE_EXIST = 1;

    /**
     * @return bool
     */
    public function changeCategory()
    {
        $this->error = '';
        
        $post = new PostBag();
        $id = $post->fetchInt('id');
        $category = $post->fetchEscape('category', $this->db);
        
        $this->db->query("UPDATE `news` SET `category` = '{$category}' WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }
        
        return true;
    }

    /**
     * @return array
     */
    public function awardsList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT `name_ru`, `name_en` FROM `awards` WHERE `type` != 'hidden'");
        while ($row = $result->fetch_assoc()) {
            $name = $row['name_ru'];
            if (empty($name)) {
                $name = $row['name_en'];
            }
            $list[] = $name;
        }
        
        return $list;
    }

    /**
     * @param $id
     * @return Item
     */
    public function getById($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `news` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $row['tag'] = '';
            $result2 = $this->db->query("SELECT GROUP_CONCAT(t1.`tag`) as `tag` FROM `news_tag_value` as `t1` JOIN `news_tag` as `t2` ON t1.`id` = t2.`tagId` WHERE t2.`newsId` = {$id}");
            if ($row2 = $result2->fetch_assoc()) {
                $row['tag'] = $row2['tag'];
            }
            $item->initFromArray($row);
        }

        return $item;
    }

    public function edit()
    {
        $this->error = 0;
        $post = new PostBag();

        $title = $this->clearText($post->fetch('title'));
        $title = $this->db->real_escape_string($title);
        if (!empty($title)) {
            $id = $post->fetchInt('id');
            $authorId = $post->fetchInt('authorId');
            $publish = strtotime($post->fetch('postDate'));
            $status = $post->fetchEscape('status', $this->db);
            $center = $post->fetchEscape('center', $this->db);
            $popular = $post->fetchEscape('popular', $this->db);
            $title_html = $this->db->real_escape_string($this->clearText($post->fetch('titleHtml')));
            $md = $post->fetchEscape('metaDescription', $this->db);
            $anons = $post->fetchEscape('anons', $this->db);
            $text = $post->fetchEscape('text', $this->db);
            $filmId = $post->fetchInt('filmId');
            $title_short = $post->fetchEscape('title_short', $this->db);

            $this->db->query("UPDATE `news` SET `status` = '{$status}', `center` = '{$center}', `popular` = '{$popular}', `publish` = FROM_UNIXTIME('{$publish}'),
                              `authorId` = {$authorId}, `title` = '{$title}', `title_html` = '{$title_html}', `meta_description` = '{$md}', `title_short` = '{$title_short}', `text`  = '{$text}', `text_short` = '', `anons` ='{$anons}', `filmId` = {$filmId}
                              WHERE `id` = {$id} LIMIT 1
                              ");
            if (!empty($this->db->error)) {
                $this->error = $this->db->error;
                return false;
            }

            $this->insertId = $this->db->insert_id;

            if ('show' == $status) {
                /**
                 * Links film and person.
                 */
                $result = $this->db->query("SELECT `id`, `filmId` FROM `news_link` WHERE `newsId` = {$id} AND `personId` = 0");
                while ($row = $result->fetch_assoc()) {
                    if (false === strpos($post->fetch('text'), '/film/' . $row['filmId'])) {
                        $this->db->query("DELETE FROM `news_link` WHERE `id` = {$row['id']} LIMIT 1");
                    }
                }
                preg_match_all('|"([^\"]*)/film/([^\"]*)"|iU', $post->fetch('text'), $matches);
                foreach ($matches[2] as $filmId) {
                    $filmId = trim($filmId, '/');
                    $filmId = intval($filmId);

                    $result = $this->db->query("SELECT 1 FROM `film` WHERE `id` = {$filmId} LIMIT 1");
                    if (0 < $result->num_rows) {
                        $result = $this->db->query("SELECT 1 FROM `news_link` WHERE `newsId` = {$id} AND `filmId` = {$filmId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `news_link` SET `newsId` = {$id}, `personId` = 0, `filmId` = {$filmId}");
                        }
                    }
                }

                $result = $this->db->query("SELECT `id`, `personId` FROM `news_link` WHERE `newsId` = {$id} AND `filmId` = 0");
                while ($row = $result->fetch_assoc()) {
                    if (false === strpos($post->fetch('text'), '/people/' . $row['personId'])) {
                        $this->db->query("DELETE FROM `news_link` WHERE `id` = {$row['id']} LIMIT 1");
                    }
                }
                preg_match_all('|"([^\"]*)/people/([^\"]*)"|iU', $post->fetch('text'), $matches);
                foreach ($matches[2] as $personId) {
                    $personId = trim($personId, '/');
                    $personId = intval($personId);

                    $result = $this->db->query("SELECT 1 FROM `person` WHERE `id` = {$personId} LIMIT 1");
                    if (0 < $result->num_rows) {
                        $result = $this->db->query("SELECT 1 FROM `news_link` WHERE `newsId` = {$id} AND `personId` = {$personId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `news_link` SET `newsId` = {$id}, `personId` = {$personId}, `filmId` = 0");

                            /**
                             * Person stat.
                             */
                            $stat = new Stat($this->db);
                            $stat->updateNewsCount($personId);
                        }
                    }
                }
            } else {
                $this->db->query("DELETE FROM `news_link` WHERE `newsId` = {$id}");
            }

            /**
             * Tag.
             */
            $tagList = $post->fetch('tag');
            $tagList = explode(',', $tagList);

            $result = $this->db->query("SELECT t1.`id`, t2.`tag` FROM `news_tag` as `t1` JOIN `news_tag_value` as `t2` ON t1.`tagId` = t2.`id` WHERE t1.`newsId` = {$id}");
            while ($row = $result->fetch_assoc()) {
                $found = false;
                foreach ($tagList as $tag) {
                    $tag = trim($tag);
                    if (!empty($tag)) {
                        if ($tag == $row['tag']) {
                            $found = true;
                            break;
                        }
                    }
                }
                if (!$found) {
                    $this->db->query("DELETE FROM `news_tag` WHERE `id` = {$row['id']} LIMIT 1");
                }
            }
            foreach ($tagList as $tag) {
                $tag = trim($tag);
                if (!empty($tag)) {
                    $tag = $this->db->real_escape_string($tag);
                    $result = $this->db->query("SELECT `id` FROM `news_tag_value` WHERE `tag` = '{$tag}' LIMIT 1");
                    if ($row = $result->fetch_assoc()) {
                        $tagId = $row['id'];
                    } else {
                        $this->db->query("INSERT INTO `news_tag_value` SET `tag` = '{$tag}'");
                        $tagId = intval($this->db->insert_id);
                    }

                    if (0 < $tagId) {
                        $result = $this->db->query("SELECT 1 FROM `news_tag` WHERE `tagId` = {$tagId} AND `newsId` = {$id} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `news_tag` SET `newsId` = {$id}, `tagId` = {$tagId}");
                        }
                    }
                }
            }
            
            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('news:' . $id)) {
                $redis->delete('news:' . $id);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $adminId
     * @return bool
     */
    public function add($adminId)
    {
        $this->error = 0;
        $post = new PostBag();

        $title = $this->clearText($post->fetch('title'));
        $title = $this->db->real_escape_string($title);
        
        if (!empty($title)) {
            /**
             * Title must be unique.
             */
            $result = $this->db->query("SELECT 1 FROM `news` WHERE `title` = '{$title}' LIMIT 1");
	        
            if (1 == $result->num_rows) {
                $this->error = self::TITLE_EXIST;
                return false;
            }

            /**
             * Get authorId.
             */
            $authorId = 0;
            $adminId = intval($adminId);
            $result = $this->db->query("SELECT `userId` FROM `admin` WHERE `id` = {$adminId} LIMIT 1");
            if ($row = $result->fetch_assoc()) {
                $authorId = $row['userId'];
            }
            
            $category = $post->fetchEscape('category', $this->db);

            $publish = strtotime('now');
            
            $this->db->query("INSERT INTO `news`
									SET `s` = 0, `image` = '',
                              		`status` = 'hide', `category` = '{$category}',
                              		`center` = 'no', `popular` = 'no',
                              		`publish` = FROM_UNIXTIME('{$publish}'),
                              		`authorId` = '{$authorId}',
                              		`title` = '{$title}',
                              		`title_html` = '',
                              		`title_short` = '', `text`  = '', `text_short` = '',
                              		`anons` ='', `filmId` = 0,
                              		`meta_description` = ''
                              ");
            
            if (!empty($this->db->error)) {
	            
                $this->error = $this->db->error;
                return false;
            }

            $this->insertId = $this->db->insert_id;

            $this->db->query("UPDATE `count` SET `count` = `count` + 1 WHERE `key` = 'news' LIMIT 1");

            return true;
        }

        return false;
    }

    /**
     * Get json data for DataTable plugin. List of companies.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();
        $category = $get->fetchEscape('category', $this->db);

        $useSphinx = false;
        $search = $get->fetch('search');
        if (!preg_match('/^[1-9][0-9]*$/', $search['value'])) {
            $search = trim($search['value']);
            if (!empty($search)) {
                $useSphinx = true;
            }
        } else {
            $search = intval($search['value']);
        }

        /**
         * Column order.
         */
        $order = $get->fetch('order');
        $order = $order[0]['column'];
        switch ($order) {
            case 0:
                $order = 'id';
                break;
            default:
                $order = 'id';
        }

        $direction = $get->fetch('order');
        $direction = $direction[0]['dir'];

        /**
         * Page offset.
         */
        $length = $get->fetchInt('length');
        $offset = $get->fetchInt('start');

        $order = $this->db->real_escape_string($order);
        $direction = $this->db->real_escape_string($direction);

        $from = $get->fetch('from');
        $to = $get->fetch('to');
        if (!empty($from)) {
            $from = strtotime($from);
            $from = $this->db->real_escape_string($from);
        }
        if (!empty($to)) {
            $to = strtotime($to) + 86399;
            $to = $this->db->real_escape_string($to);
        }

        $total = 0;
        if ($useSphinx) {
            $search = explode(' ', $search);
            $search = array_map(function($search){
                return $search . '*';
            }, $search);
            $search = $this->db->real_escape_string(implode(' ', $search));

            $result = $this->sphinx()->query("SELECT * FROM `news` WHERE MATCH('{$search}') LIMIT 50 OPTION ranker=sph04,field_weights=(title=100,text=90)");
            $idList = [];
            while ($row = $result->fetch_assoc()) {
                $idList[] = $row['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }

            $total = $map['total'];

            $idList = implode(',', $idList);
            if (empty($idList)) {
                $query = "SELECT `id`, `status`, `category`, `publish`, `title` FROM `news` WHERE `id` = 0";
            } else {
                $query = "SELECT `id`, `status`, `category`, `publish`, `title` FROM `news` WHERE 1 ";
                $query .= " AND `id` IN ($idList)";
                if (!empty($from) && !empty($to)) {
                    $query .= " AND `publish` >= FROM_UNIXTIME('{$from}') AND `publish` <= FROM_UNIXTIME('{$to}') ";
                } else if (!empty($from)) {
                    $query .= " AND `publish` >= FROM_UNIXTIME('{$from}') ";
                } else if (!empty($to)) {
                    $query .= " AND `publish` <= FROM_UNIXTIME('{$to}')";
                }
                if (!empty($category)) {
                    if ('null' == $category) {
                        $category = '';
                    }
                    $query .= " AND `category` = '{$category}' ";
                }
            }
        } else {
            $query = "SELECT `id`, `status`, `category`, `publish`, `title` FROM `news` WHERE 1 ";
            if (!empty($from) && !empty($to)) {
                $query .= " AND `publish` >= FROM_UNIXTIME('{$from}') AND `publish` <= FROM_UNIXTIME('{$to}') ";
            } else if (!empty($from)) {
                $query .= " AND `publish` >= FROM_UNIXTIME('{$from}') ";
            } else if (!empty($to)) {
                $query .= " AND `publish` <= FROM_UNIXTIME('{$to}')";
            }
            if (!empty($category)) {
                if ('null' == $category) {
                    $category = '';
                }
                $query .= " AND `category` = '{$category}' ";
            }
            if (!empty($search)) {
                $search = $this->db->real_escape_string($search);
                $query .= " AND `id` = {$search} ";
            }
        }

        /**
         * Total.
         */
        if (!$useSphinx) {
            $total = 0;
            if (!empty($search)) {
                $result = $this->db->query(str_replace('`id`, `status`, `category`, `publish`, `title`', 'COUNT(*) as `count`', $query));
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                }
            } else {
                $result = $this->db->query("SELECT `count` FROM `count` WHERE `key` = 'news'");
                if ($row = $result->fetch_assoc()) {
                    $total = $row['count'];
                } else {
                    $result = $this->db->query(str_replace('`id`, `status`, `category`, `publish`, `title`', 'COUNT(*) as `count`', $query));
                    if ($row = $result->fetch_assoc()) {
                        $total = $row['count'];
                    }
                }
            }

            $query .= " ORDER BY `{$order}` {$direction} LIMIT {$offset}, {$length}";
        }

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['publish'])) {
                $row['publish'] = $this->formatDate($row['publish'], true);
            }
            $item[0] = $row['id'];
            $item[1] = $row['publish'];
            $item[2] = $row['category'];
            $item[3] = $row['title'];
            $item[4] = $row['status'];
            $item[5] = '';

            $data[] = $item;
        }

        $data = [
            'draw' => $get->fetchInt('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];

        return json_encode($data);
    }
    
    public function getInsertId()
    {
        return $this->insertId;
    }

    /**
     * Create new gallery.
     * @return bool
     */
    public function addGallery()
    {
        $this->error = '';
        $post = new PostBag();
        $id = $post->fetchInt('id');

        if (0 < $id) {
            $result = $this->db->query("SELECT 1 FROM `news` WHERE `id` = {$id} LIMIT 1");
            if (0 < $result->num_rows) {
                $this->db->query("INSERT INTO `news_gallery` SET `newsId` = {$id}, `trailerId` = 0");
                if (empty($this->db->error)) {
                    return true;
                }
                $this->error = $this->db->error;
            }
        }

        return false;
    }

    /**
     * @param int $galleryId
     * @return array
     */
    public function getGalleryPhoto($galleryId)
    {
        $list = [];
        $galleryId = intval($galleryId);

        $result = $this->db->query("SELECT `id`, `s`, `image` FROM `news_gallery_image` WHERE `galleryId` = {$galleryId} ORDER BY `order`");
        while ($row = $result->fetch_assoc()) {
            $iName = md5($row['id']);
            $image = Server::STATIC[$row['s']] . Path::NEWS_GALLERY . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $row['image'];
            $list[$row['id']] = $image;
        }

        return $list;
    }

    /**
     * @param $id
     * @return array
     */
    public function getPhoto($id)
    {
        $id = intval($id);
        $image = '';
        
        $result = $this->db->query("SELECT `id`, `s`, `image` FROM `news_gallery_image` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $iName = md5($row['id']);
            $image = Server::STATIC[$row['s']] . Path::NEWS_GALLERY . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $row['image'];
            return [$image, $row['image']];
        }
        
        return [$image, ''];
    }

    /**
     * @param $newsId
     * @return array
     */
    public function getList($newsId)
    {
        $newsId = intval($newsId);
        $list = [];

        $result = $this->db->query("SELECT `id`, `trailerId` FROM `news_gallery` WHERE `newsId` = {$newsId} ORDER BY `id`");
        while ($row = $result->fetch_assoc()) {
            if (0 == $row['trailerId']) {
                $row['trailerId'] = '';
            }

            $row['image'] = '';
            $result2 = $this->mysql()->query("SELECT `id`, `s`, `image` FROM `news_gallery_image` WHERE `galleryId` = {$row['id']} ORDER BY `order` LIMIT 1");
            if ($row2 = $result2->fetch_assoc()) {
                $iName = md5($row2['id']);
                $row['image'] = Server::STATIC[$row2['s']] . Path::NEWS_GALLERY . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $row2['image'];
            }


            $list[] = [
                'id' => $row['id'],
                'image' => $row['image'],
                'trailerId' => $row['trailerId']
            ];
        }

        return $list;
    }

    /**
     * @return bool
     */
    public function trailer()
    {
        $post = new PostBag();
        $id = $post->fetchInt('id');
        $trailerId = $post->fetchInt('trailerId');
        $this->db->query("UPDATE `news_gallery` SET `trailerId` = {$trailerId} WHERE `id` = {$id} LIMIT 1");
        if (empty($this->db->error)) {
            return true;
        }
        $this->error = $this->db->error;
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteGallery($id = 0)
    {
        if (0 < $id) {
            $id = intval($id);
        } else {
            $post = new PostBag();
            $id = $post->fetchInt('id');

            $redis = new \Redis();
            $redisStatus = $redis->connect('127.0.0.1');
            if ($redisStatus && $redis->exists('news:' . $id)) {
                $redis->delete('news:' . $id);
            }
        }

        $this->db->query("DELETE FROM `news_gallery` WHERE `id` = {$id}");
        if (!empty($this->db->error)) {
            return false;
        }
        
        $s = 0;
        $idList = [];
        $result = $this->db->query("SELECT `id`, `s` FROM `news_gallery_image` WHERE `galleryId` = {$id}");
        while ($row = $result->fetch_assoc()) {
            $s = $row['s'];
            $idList[] = $row['id'];
        }
        //$idList = implode(',', $idList);
        $server = new StaticS();
        $server->deleteList('gallery', $s, $idList);
        
        $this->db->query("DELETE FROM `news_gallery_image` WHERE `galleryId` = {$id}");
        if (!empty($this->db->error)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $post = new PostBag();

        $id = $post->fetchInt('id');
        
        $result = $this->db->query("SELECT `s`, `image`, `text` FROM `news` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $static = new StaticS();

            if ('' != $row['image']) {
                $static->delete('news', $row['s'], $id, $row['image']);
            }
            
            preg_match_all('/#{gellary=(\d+)}/', $row['text'], $matches);
            foreach ($matches[1] as $key => $galleryId) {
                $galleryId = intval($galleryId);
                $this->deleteGallery($galleryId);
            }

            preg_match_all('/src="(.*?)"/', $row['text'], $matches);
            foreach ($matches[1] as $src) {
                $src = explode('/', $src);
                $src = $src[count($src) - 1];
                $src = explode('.', $src);
                $src = $src[0];
                $result2 = $this->mysql()->query("SELECT `id`, `s`, `image` FROM `news_file` WHERE `hash` = UNHEX('{$src}') LIMIT 1");
                while ($row2 = $result2->fetch_assoc()) {
                    $static = new StaticS();
                    $data = json_decode($static->delete('news_text', $row2['s'], $row2['id'], $row2['image']), true);

                    if ('' == $data) {
                        $this->mysql()->query("DELETE FROM `news_file` WHERE `id` = {$row2['id']} LIMIT 1");
                    }
                }
            }

            $personIdList = [];
            $result2 = $this->db->query("SELECT `personId` FROM `news_link` WHERE `newsId` = {$id}");
            while ($row2 = $result2->fetch_assoc()) {
                $personIdList[] = $row2['personId'];
            }

            $this->db->query("DELETE FROM `news_link` WHERE `newsId` = {$id}");
            if (!empty($this->db->error)) {
                return false;
            }

            $this->db->query("DELETE FROM `news_stat` WHERE `newsId` = {$id}");
            if (!empty($this->db->error)) {
                return false;
            }

            $this->db->query("DELETE FROM `news_tag` WHERE `newsId` = {$id}");
            if (!empty($this->db->error)) {
                return false;
            }

            $this->db->query("DELETE FROM `news` WHERE `id` = {$id}");
            if (!empty($this->db->error)) {
                return false;
            }

            $comment = new Comment($this->db);
            $result = $this->db->query("SELECT `id` FROM `comment` WHERE `relatedId` = {$id} AND `type` = 'news' AND `parent` = 0");
            while ($row = $result->fetch_assoc()) {
                $comment->delete($row['id']);
            }

            $stat = new Stat($this->db);
            foreach ($personIdList as $personId) {
                $stat->updateNewsCount($personId);
            }

            $this->db->query("UPDATE `count` SET `count` = `count` - 1 WHERE `key` = 'news' LIMIT 1");
        }

        $redis = new \Redis();
        $redisStatus = $redis->connect('127.0.0.1');
        if ($redisStatus && $redis->exists('news:' . $id)) {
            $redis->delete('news:' . $id);
        }

        return true;
    }

    private $insertId;
}