<?php
namespace Kinomania\Control\Boxoffice;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\System\Base\DB;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Parser\Parser;

class Boxoffice extends DB
{
    use TRepository;

    const WEEKEND_EXIST = 'WEEKEND_EXIST';

    public function editFilmId()
    {
        $this->error = '';
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $filmId = $post->fetchInt('filmId');

        $this->db->query("UPDATE `film_boxoffice` SET `filmId` = {$filmId} WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    public function getList()
    {
        $list = [];

        $get = new GetBag();
        $date = $get->fetchEscape('id', $this->db);
        $result = $this->db->query("SELECT * FROM `film_boxoffice` WHERE `date_from` = '{$date}' ORDER BY `position`");
        while ($row = $result->fetch_assoc()) {
            if (0 < $row['filmId']) {
                /**
                 * Film name.
                 */
                $result2 = $this->db->query("SELECT `name_origin`, `name_ru` FROM `film` WHERE `id` = {$row['filmId']} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    $row['name_origin'] = $row2['name_origin'];
                    $row['name_ru'] = $row2['name_ru'];
                }
            }
            
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }

        return $list;
    }

    /**
     * Remove weekend data.
     * @return bool
     */
    public function delete()
    {
        $this->error = '';
        $post = new PostBag();
        $date_from = $post->fetchEscape('date_from', $this->db);
        if (empty($date_from)) {
            return false;
        }

        $this->db->query("DELETE FROM `film_boxoffice` WHERE `date_from` = '{$date_from}'");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    public function add()
    {
        $this->error = '';
        $post = new PostBag();

        $type = $post->fetchEscape('type', $this->db);
        $url = $post->fetchEscape('url', $this->db);

        if (empty($url)) {
            return false;
        }

        if ('usa' == $type) {
            $parser = new Parser(false);
            $parser->mojo($url);
            $parser->log($this->db);
            if (empty($parser->error())) {
                $data = $parser->data();

                $date_from = $this->db->real_escape_string($data[0][9]);
                $date_to = $this->db->real_escape_string($data[0][10]);

                $result = $this->db->query("SELECT 1 FROM `film_boxoffice` WHERE `type` = '{$type}' AND `date_from` = '{$date_from}' LIMIT 1");
                if (0 < $result->num_rows) {
                    $this->error = self::WEEKEND_EXIST;
                    return false;
                }

                foreach ($data as $item) {
                    $position = intval($item[0] ?? 0);
                    $previous = intval($item[1] ?? 0);
                    $filmId = 0;
                    $name_origin = $this->db->real_escape_string($item[2] ?? '');
                    $name_ru = '';
                    $company_name = $this->db->real_escape_string($item[3] ?? '');
                    $week = intval($item[7] ?? 0);
                    $copy = intval($item[5] ?? 0);

                    $gross = intval($item[4]);
                    $gross_total = intval($item[6]);

                    $gross_rub = 0;
                    $gross_total_rub = 0;
                    $views = 0;
                    $views_total = 0;
                    $course = 0;

                    $this->db->query("INSERT INTO `film_boxoffice` SET
                    `type` = '{$type}',
                    `position` = {$position},
                    `previous` = {$previous},
                    `filmId` = {$filmId},
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '{$name_ru}',
                    `company_name` = '{$company_name}',
                    `week` = {$week},
                    `copy` = {$copy},
                    `gross` = {$gross},
                    `gross_total` = {$gross_total},
                    `gross_rub` = {$gross_rub},
                    `gross_total_rub` = {$gross_total_rub},
                    `views` = {$views},
                    `views_total` = {$views_total},
                    `date_from` = '{$date_from}',
                    `date_to` = '{$date_to}',
                    `course` = {$course}
                    ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }
                }

                /**
                 * Get film ID.
                 */
                $result = $this->db->query("SELECT `id`, `name_origin`, `gross_total`  FROM `film_boxoffice` WHERE `type` = '{$type}' AND `date_from` = '{$date_from}'");
                while ($row = $result->fetch_assoc()) {
                    $filmId = 0;
                    if (!empty($row['name_origin'])) {
                        $filmId = $this->getFilmIdByName($row['name_origin']);
                    }
                    $gross = $row['gross_total'];

                    if (0 < $filmId) {
                        $this->db->query("UPDATE `film_boxoffice` SET `filmId` = {$filmId} WHERE `id` = {$row['id']} LIMIT 1");

                        /**
                         * Budget.
                         */
                        $result2 = $this->db->query("SELECT `budget` FROM `film` WHERE `id` = {$filmId} LIMIT 1");
                        if ($row2 = $result2->fetch_assoc()) {
                            if (0 == $row2['budget']) {
                                foreach ($data as $item) {
                                    if (!empty($item[2]) && $item[2] == $row['name_origin']) {
                                        $budget = intval($item[8]);
                                        if (0 < $budget) {
                                            $this->db->query("UPDATE `film` SET `budget` = {$budget} WHERE `id` = {$filmId} LIMIT 1");
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        /**
                         * Gross.
                         */
                        $result2 = $this->mysql()->query("SELECT `id` FROM `film_gross` WHERE `filmId` = {$filmId}");
                        if ($row2 = $result2->fetch_assoc()) {
                            $this->mysql()->query("UPDATE `film_gross` SET `usa` = {$gross} WHERE `id` = {$row2['id']}");
                        } else {
                            $this->mysql()->query("INSERT INTO `film_gross` SET `filmId` = {$filmId}, `world` = 0, `ru` = 0, `usa` = {$gross}");
                        }
                    }

                    /**
                     * Clear cache.
                     */
                    $redis = new \Redis();
                    $redisStatus = $redis->connect('127.0.0.1');
                    if ($redisStatus) {
                        $redis->delete('boxoffice:russia');
                    }
                }
            } else {
                return false;
            }
        } else {
            $parser = new Parser(false);
            $parser->kinometro_ru($url);
            $parser->log($this->db);
            if (empty($parser->error())) {
                $data = $parser->data();

                $date_from = $this->db->real_escape_string($data[0][11]);
                $date_to = $this->db->real_escape_string($data[0][12]);

                $result = $this->db->query("SELECT 1 FROM `film_boxoffice` WHERE `type` = '{$type}' AND `date_from` = '{$date_from}' LIMIT 1");
                if (0 < $result->num_rows) {
                    $this->error = self::WEEKEND_EXIST;
                    return false;
                }


                foreach ($data as $item) {
                    $position = intval($item[0] ?? 0);
                    $previous = intval($item[1] ?? 0);
                    $filmId = 0;
                    $name_origin = $this->db->real_escape_string($item[2][1] ?? '');
                    $name_ru = $this->db->real_escape_string($item[2][0] ?? '');
                    $company_name = $this->db->real_escape_string($item[3] ?? '');
                    $week = intval($item[4] ?? 0);
                    $copy = intval($item[5] ?? 0);

                    $gross = $item[6][1] ?? 0;
                    $gross = str_replace('$', '', $gross);
                    $gross = str_replace(' ', '', $gross);
                    $gross = intval($gross);

                    $gross_total = $item[7][1] ?? 0;
                    $gross_total = str_replace('$', '', $gross_total);
                    $gross_total = str_replace(' ', '', $gross_total);
                    $gross_total = intval($gross_total);

                    $gross_rub = $item[6][0] ?? 0;
                    $gross_rub = str_replace(' ', '', $gross_rub);
                    $gross_rub = intval($gross_rub);

                    $gross_total_rub = $item[7][0] ?? 0;
                    $gross_total_rub = str_replace(' ', '', $gross_total_rub);
                    $gross_total_rub = intval($gross_total_rub);

                    $views = $item[8] ?? 0;
                    $views = str_replace(' ', '', $views);
                    $views = intval($views);

                    $views_total = $item[9] ?? 0;
                    $views_total = str_replace(' ', '', $views_total);
                    $views_total = intval($views_total);

                    $course = floatval($item[10] ?? 0);

                    $this->db->query("INSERT INTO `film_boxoffice` SET
                    `type` = '{$type}',
                    `position` = {$position},
                    `previous` = {$previous},
                    `filmId` = {$filmId},
                    `name_origin` = '{$name_origin}',
                    `name_ru` = '{$name_ru}',
                    `company_name` = '{$company_name}',
                    `week` = {$week},
                    `copy` = {$copy},
                    `gross` = {$gross},
                    `gross_total` = {$gross_total},
                    `gross_rub` = {$gross_rub},
                    `gross_total_rub` = {$gross_total_rub},
                    `views` = {$views},
                    `views_total` = {$views_total},
                    `date_from` = '{$date_from}',
                    `date_to` = '{$date_to}',
                    `course` = {$course}
                    ");

                    if (!empty($this->db->error)) {
                        $this->error = $this->db->error;
                        return false;
                    }
                }

                /**
                 * Get film ID.
                 */
                $result = $this->db->query("SELECT `id`, `name_origin`, `name_ru`, `company_name`, `gross_total_rub`  FROM `film_boxoffice` WHERE `type` = '{$type}' AND `date_from` = '{$date_from}'");
                while ($row = $result->fetch_assoc()) {
                    $filmId = 0;
                    if (!empty($row['name_origin'])) {
                        $filmId = $this->getFilmIdByName($row['name_origin']);
                    }
                    if (0 == $filmId) {
                        $filmId = $this->getFilmIdByName($row['name_ru']);
                    }
                    $gross = $row['gross_total_rub'];

                    if (0 < $filmId) {
                        $this->db->query("UPDATE `film_boxoffice` SET `filmId` = {$filmId} WHERE `id` = {$row['id']} LIMIT 1");

                        if (0 < $filmId) {
                            /**
                             * Company.
                             */
                            $result2 = $this->mysql()->query("SELECT 1 FROM `company` as `t1` JOIN `film_company_rel` as `t2` ON t1.`id` = t2.`companyId` 
                                                  WHERE t2.`filmId` = {$filmId} AND t2.`type` = 'Прокат' LIMIT 1
                                                  ");
                            if (0 == $result2->num_rows) {
                                $company_name = $this->mysql()->real_escape_string($row['company_name']);
                                $result2 = $this->mysql()->query("SELECT `id` FROM `company` WHERE `short_name` LIKE '{$company_name}%' LIMIT 1");
                                if ($row2 = $result2->fetch_assoc()) {
                                    $this->mysql()->query("INSERT INTO `film_company_rel` SET `filmId` = {$filmId}, `companyId` = {$row2['id']}, `type` = 'Прокат'");
                                }
                            }

                            /**
                             * Gross.
                             */
                            if ('russia' == $type) {
                                $result2 = $this->mysql()->query("SELECT `id` FROM `film_gross` WHERE `filmId` = {$filmId}");
                                if ($row2 = $result2->fetch_assoc()) {
                                    $this->mysql()->query("UPDATE `film_gross` SET `ru` = {$gross} WHERE `id` = {$row2['id']}");
                                } else {
                                    $this->mysql()->query("INSERT INTO `film_gross` SET `filmId` = {$filmId}, `world` = 0, `ru` = {$gross}, `usa` = 0");
                                }
                            }
                        }
                    }

                    /**
                     * Clear cache.
                     */
                    $redis = new \Redis();
                    $redisStatus = $redis->connect('127.0.0.1');
                    if ($redisStatus) {
                        if ('cis' == $type) {
                            $redis->delete('boxoffice:cis');
                        } else {
                            $redis->delete('boxoffice:russia');
                        }
                    }
                }
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Get json data for DataTable plugin. List of companies.
     * @return mixed
     */
    public function renderTable()
    {
        $get = new GetBag();

        $type = $get->fetchEscape('type', $this->db);
        
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

        $query = "SELECT `date_from`, ANY_VALUE(`date_to`) as `date_to`, ANY_VALUE(`type`) as `type` FROM `film_boxoffice` WHERE 1 ";
        if (!empty($type)) {
            if ('null' == $type) {
                $type = '';
            }
            $query .= " AND `type` = '{$type}' ";
        }

        /**
         * Total.
         */
        $total = 0;
        $result = $this->db->query(str_replace('`date_from`, ANY_VALUE(`date_to`) as `date_to`, ANY_VALUE(`type`) as `type`', 'COUNT(*) as `count`', $query));
        if ($row = $result->fetch_assoc()) {
            $total = $row['count'];
        }

        $query .= " GROUP BY `date_from` ORDER BY `date_from` {$direction} LIMIT {$offset}, {$length}";

        $data = [];
        $result = $this->db->query($query);
        while ($row = $result->fetch_assoc()) {
            $item[0] = $row['date_from'];
            $item[1] = $row['date_to'];
            $item[2] = $row['type'];
            $item[3] = '';

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

    private function getFilmIdByName($search)
    {
        iconv(mb_detect_encoding($search, mb_detect_order(), true), "UTF-8", $search);
        $search = preg_replace('/[^0-9a-zA-ZА-Яа-яёЁ_ -]+/u', '', $search);;
        $q = explode(' ', $search);
        if (1 == count($q)) {
            $search .= '*';
        }
        $search = $this->sphinx()->real_escape_string($search);
        $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        if (!empty($this->sphinx()->error)) {
            echo "SELECT * FROM `film` WHERE MATCH('{$search}') LIMIT 8 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)";
            echo $this->sphinx()->error;
            exit;
        }
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            if (0 < $rowData['id']) {
                $idList[] = $rowData['id'];
            }
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }

        if (0 == count($idList)) {
            $words = [];
            foreach($map as $k => $v) {

                if(preg_match('/keyword\[\d+]/', $k)) {
                    preg_match('/\d+/', $k, $key);
                    $key = $key[0];
                    $words[$key]['keyword'] = $v;
                }

                if(preg_match('/docs\[\d+]/', $k)) {
                    preg_match('/\d+/', $k, $key);
                    $key = $key[0];
                    $words[$key]['docs'] = $v;
                }
            }

            $suggest = $this->suggest($words, $search);
        } else {
            $idList = implode(',', $idList);
        }

        if (!empty($suggest) && false === stripos($search, $suggest)) {
            $suggest = $this->sphinx()->real_escape_string($suggest);
            $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$suggest}') LIMIT 7 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($rowData = $result->fetch_assoc()) {
                if (0 < $rowData['id']) {
                    $idList[] = $rowData['id'];
                }
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }

            if (0 < count($idList)) {
                $idList = implode(',', $idList);
            }
        }

        if (empty($idList)) {
            return 0;
        }

        $year = date('Y') - 1;
        $result = $this->db->query("SELECT `id` FROM `film` WHERE `id` IN ($idList) AND `year` >= {$year} ORDER BY `year` DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }

        return 0;
    }

    private function suggest($words, $query)
    {
        $suggested = [];
        $mis = [];
        $llimf = 0;
        $i = 0;
        foreach ($words  as $key => $word) {
            if ($word['docs'] != 0)
                $llimf += $word['docs'];$i++;
        }
        if (0 == $i) {
            return false;
        }
        $llimf = $llimf / ($i * $i);
        foreach ($words  as $key => $word) {
            if ($word['docs'] == 0 | $word['docs'] < $llimf) {
                $mis[] = $word['keyword'];
            }
        }
        if (count($mis) > 0) {
            foreach ($mis as $m) {
                $re = $this->makeSuggest($m);

                if ($re) {
                    if($m!=$re) {
                        $suggested[$m] = $re;
                    }
                }
            }
            if(count($words) ==1 && empty($suggested)) {
                return false;
            }
            $phrase = explode(' ', $query);
            foreach ($phrase as $k => $word) {
                if (isset($suggested[mb_strtolower($word, 'UTF-8')])) {
                    $phrase[$k] = $suggested[mb_strtolower($word, 'UTF-8')];
                }
            }
            $phrase = implode(' ', $phrase);
            return $phrase;
        }else{
            return false;
        }
    }

    private function makeSuggest($keyword)
    {
        $trigrams = $this->buildTrigrams($keyword);
        $query = "\"$trigrams\"/1";
        $len = strlen($keyword);
        $delta = LENGTH_THRESHOLD;

        $lowlen = $len - $delta;
        $highlen = $len + $delta;

        $result = $this->sphinx()->query("SELECT *, weight() as w, w+{$delta}-ABS(len-{$len}) as myrank FROM suggest WHERE MATCH('{$query}') AND len BETWEEN {$lowlen} AND {$highlen}
			ORDER BY myrank DESC, freq DESC
			LIMIT 1 OPTION ranker=wordcount");

        if (!$row = $result->fetch_assoc()) {
            return '';
        }

        $suggested = $row["keyword"];
        if ($this->levenshtein_utf8($keyword, $suggested) <= LEVENSHTEIN_THRESHOLD) {
            return $suggested;
        }

        return $keyword;
    }

    public function buildTrigrams($keyword)
    {
        $t = "__" . $keyword . "__";
        $trigrams = "";
        for ($i = 0; $i < mb_strlen($t, 'UTF-8') - 2; $i++)
            $trigrams .= mb_substr($t, $i, 3, 'UTF-8') . " ";
        return $trigrams;
    }

    public function utf8_to_extended_ascii($str, &$map)
    {
        // find all multibyte characters (cf. utf-8 encoding specs)
        $matches = array();
        if (!preg_match_all('/[\xC0-\xF7][\x80-\xBF]+/', $str, $matches))
            return $str; // plain ascii string

        // update the encoding map with the characters not already met
        foreach ($matches[0] as $mbc)
            if (!isset($map[$mbc]))
                $map[$mbc] = chr(128 + count($map));

        // finally remap non-ascii characters
        return strtr($str, $map);
    }


    public function levenshtein_utf8($s1, $s2)
    {
        $charMap = array();
        $s1 = $this->utf8_to_extended_ascii($s1, $charMap);
        $s2 = $this->utf8_to_extended_ascii($s2, $charMap);

        return levenshtein($s1, $s2);
    }
}