<?php
namespace Original\Route_search;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Genre;
use Kinomania\System\Debug\Debug;

class GET extends DefaultController
{
    use TRepository;
    
    public function index()
    {
        $get = new GetBag();
        $query = $get->fetch('q');

        $found = false;
        $data = [
            'prob' => [
                'type' => '',
                'item' => []
            ],
            'film' => [],
            'film_total' => 0,
            'person' => [],
            'person_total' => 0,
            'news' => [],
            'news_total' => 0,
            'genre' => [],
        ];

        /*get genre*/
        if('' !== $query){
            foreach (Genre::RU as $key => $genre){
                if(false !== stristr($genre, $query)){
                    $data['genre'][] = [
                        'id' => $key,
                        'name' => $genre
                    ];
                }
            }
        }


        $suggest = '';

        /**
         * Film.
         */
        $sqlQuery = '';
        $q = explode(' ', $query);
        if (1 == count($q)) {
            $query .= '*';
        }
        $query = $this->sphinx()->real_escape_string($query);

        $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$query}') ORDER BY `weight` DESC LIMIT 16 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");

        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }
        $data['film_total'] = $map['total'];

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

            $suggest = $this->suggest($words, $query);
        } else {
            $idList = implode(',', $idList);
            $sqlQuery = "SELECT `id`, `s`, `image`, `name_origin`, `name_ru`, `year` FROM `film` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 12";
        }

        if (!empty($suggest) && false === stripos($query, $suggest)) {
            $suggest = $this->sphinx()->real_escape_string($suggest);
            $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$suggest}') ORDER BY `weight` DESC LIMIT 14 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($rowData = $result->fetch_assoc()) {
                $idList[] = $rowData['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }
            $data['film_total'] = $map['total'];

            if (0 < count($idList)) {
                $idList = implode(',', $idList);
                $sqlQuery = "SELECT `id`, `s`, `image`, `name_origin`, `name_ru`, `year` FROM `film` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 12";
            }
            $suggest = '';
        }

        if ('' != $sqlQuery) {
            $result = $this->mysql()->query($sqlQuery);
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
                }
                
                $found = true;
                $data['film'][] = [
                    'id' => $row['id'],
                    'image' => $row['image'],
                    'name_origin' => $row['name_origin'],
                    'name_ru' => $row['name_ru'],
                    'year' => $row['year'],
                ];
            }
        }

        /**
         * Person.
         */
        $sqlQuery = '';
        $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$query}') ORDER BY `weight` DESC LIMIT 16 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }
        $data['person_total'] = $map['total'];

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

            $suggest = $this->suggest($words, $query);
        } else {
            $idList = implode(',', $idList);
            $sqlQuery = "SELECT `id`, `s`, `image`, `name_origin`, `name_ru`, `birthday` FROM `person` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 12";
        }

        if (!empty($suggest) && false === stripos($query, $suggest)) {
            $suggest = $this->sphinx()->real_escape_string($suggest);
            $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$suggest}') ORDER BY `weight` DESC LIMIT 14 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($rowData = $result->fetch_assoc()) {
                $idList[] = $rowData['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }
            $data['person_total'] = $map['total'];

            if (0 < count($idList)) {
                $idList = implode(',', $idList);
                $sqlQuery = "SELECT `id`, `s`, `image`, `name_origin`, `name_ru`, `birthday` FROM `person` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 12";
            }
        }

        if ('' != $sqlQuery) {
            $result = $this->mysql()->query($sqlQuery);
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.130.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
                }

                $row['birthday'] = explode('-', $row['birthday']);
                if (isset($row['birthday'][2])) {
                    $row['birthday'] = $row['birthday'][2] . '.' . $row['birthday'][1] . '.' . $row['birthday'][0];
                } else {
                    $row['birthday'] = '';
                }
                
                $found = true;
                $data['person'][] = [
                    'id' => $row['id'],
                    'image' => $row['image'],
                    'name_origin' => $row['name_origin'],
                    'name_ru' => $row['name_ru'],
                    'birthday' => $row['birthday'],
                ];
            }
        }

        /**
         * News.
         */
        $result = $this->sphinx()->query("SELECT * FROM `news` WHERE MATCH('{$query}') LIMIT 8 OPTION ranker=sph04,field_weights=(title=100,text=10)");
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }
        $data['news_total'] = $map['total'];

        if (0 < count($idList)) {
            $idList = implode(',', $idList);

            if (!empty($idList)) {
                $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `category`, `title`, `anons` FROM `news` WHERE `id` IN ({$idList}) AND `status` = 'show' LIMIT 6");
                while ($row = $result->fetch_assoc()) {
                    switch ($row['category']) {
                        case 'Новости кино':
                            $row['url'] = 'news';
                            break;
                        case 'Зарубежные сериалы':
                            $row['url'] = 'news';
                            break;
                        case 'Российские сериалы':
                            $row['url'] = 'news';
                            break;
                        case 'Арткиномания':
                            $row['url'] = 'news';
                            break;
                        case 'Фестивали и премии':
                            $row['url'] = 'news';
                            break;
                        default:
                            $row['url'] = 'article';
                    }

                    $row['anons'] = str_replace($get->fetch('q'), '<span class="pick">' . $get->fetch('q') . '</span>', $row['anons']);
                    
                    $found = true;
                    $data['news'][] = [
                        'id' => $row['id'],
                        'category' => $row['category'],
                        'url' => $row['url'],
                        'title' => $row['title'],
                        'anons' => $row['anons'],
                    ];
                }
            }
        }

        $prob = false;
        if (count($data['film'])) {
            $prob = true;
            $data['prob']['item'] = array_shift($data['film']);
            $data['prob']['type'] = 'film';
            $data['film_total'] -= 1;
        }
        if (!$prob && count($data['person'])) {
            $data['prob']['item'] = array_shift($data['person']);
            $data['prob']['type'] = 'person';
            $data['person_total'] -= 1;
        }

        $this->addData([
            'data' => $data,
            'found' => $found,
            'q' => $get->fetch('q')
        ]);
        $this->setTemplate('search/index.html.php');
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
        $keyword = rtrim($keyword, '*');
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

// Didactic example showing the usage of the previous conversion function but,
// for better performance, in a real application with a single input string
// matched against many strings from a database, you will probably want to
// pre-encode the input only once.
//
    public function levenshtein_utf8($s1, $s2)
    {
        $charMap = array();
        $s1 = $this->utf8_to_extended_ascii($s1, $charMap);
        $s2 = $this->utf8_to_extended_ascii($s2, $charMap);

        return levenshtein($s1, $s2);
    }
}