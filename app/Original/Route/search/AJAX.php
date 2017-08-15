<?php
namespace Original\Route_search;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class AJAX extends DefaultController
{
    use TRepository;
    
    public function index()
    {
        $post = new PostBag();
        $query = $post->fetch('q');

        $data = [
            'film' => [],
            'person' => [],
            'news' => []
        ];

        $suggest = '';

        /**
         * Film.
         */
        $q = explode(' ', $query);
        if (1 == count($q)) {
            $query .= '*';
        }
        $query = $this->sphinx()->real_escape_string($query);
        $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$query}') ORDER BY `weight` DESC LIMIT 6 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
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

            $suggest = $this->suggest($words, $query);
        } else {
            $idList = implode(',', $idList);

            $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `name_origin`, `name_ru` FROM `film` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 4");
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
                }

                $data['film'][] = [
                    'id' => $row['id'],
                    'image' => $row['image'],
                    'name_origin' => $row['name_origin'],
                    'name_ru' => $row['name_ru'],
                ];
            }
        }

        if (!empty($suggest) && false === stripos($query, $suggest)) {
            $suggest = $this->sphinx()->real_escape_string($suggest);
            $result = $this->sphinx()->query("SELECT * FROM `film` WHERE MATCH('{$suggest}') ORDER BY `weight` DESC LIMIT 5 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($rowData = $result->fetch_assoc()) {
                $idList[] = $rowData['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }

            if (0 < count($idList)) {
                $idList = implode(',', $idList);

                $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `name_origin`, `name_ru` FROM `film` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 4");
                while ($row = $result->fetch_assoc()) {
                    if ('' != $row['image']) {
                        $imageName = md5($row['id']);
                        $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
                    } else {
                        $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
                    }

                    $data['film'][] = [
                        'id' => $row['id'],
                        'image' => $row['image'],
                        'name_origin' => $row['name_origin'],
                        'name_ru' => $row['name_ru'],
                    ];
                }
            }
            $suggest = '';
        }

        /**
         * Person.
         */
        $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$query}') ORDER BY `weight` DESC LIMIT 6 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
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
            $suggest = $this->suggest($words, $query);
        } else {
            $idList = implode(',', $idList);

            $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `name_origin`, `name_ru` FROM `person` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 4");
            while ($row = $result->fetch_assoc()) {
                if ('' != $row['image']) {
                    $imageName = md5($row['id']);
                    $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
                } else {
                    $row['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                }

                $data['person'][] = [
                    'id' => $row['id'],
                    'image' => $row['image'],
                    'name_origin' => $row['name_origin'],
                    'name_ru' => $row['name_ru'],
                ];
            }

        }

        if (!empty($suggest) && false === stripos($query, $suggest)) {
            $suggest = $this->sphinx()->real_escape_string($suggest);
            $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$suggest}') ORDER BY `weight` DESC LIMIT 6 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
            $idList = [];
            while ($rowData = $result->fetch_assoc()) {
                $idList[] = $rowData['id'];
            }

            $result = $this->sphinx()->query("SHOW META");
            $map = [];
            while ($row = $result->fetch_assoc()) {
                $map[$row['Variable_name']] = $row['Value'];
            }

            if (0 < count($idList)) {
                $idList = implode(',', $idList);

                $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `name_origin`, `name_ru` FROM `person` WHERE `id` IN ({$idList}) AND `status` = 'show' ORDER BY `weight` DESC LIMIT 4");
                while ($row = $result->fetch_assoc()) {
                    if ('' != $row['image']) {
                        $imageName = md5($row['id']);
                        $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
                    } else {
                        $row['image'] = Server::STATIC[0] . '/app/img/content/nof.jpg';
                    }

                    $data['person'][] = [
                        'id' => $row['id'],
                        'image' => $row['image'],
                        'name_origin' => $row['name_origin'],
                        'name_ru' => $row['name_ru'],
                    ];
                }
            }
        }

        /**
         * News.
         */
        $result = $this->sphinx()->query("SELECT * FROM `news` WHERE MATCH('{$query}') LIMIT 6 OPTION ranker=sph04,field_weights=(title=100,text=10)");
        $idList = [];
        while ($rowData = $result->fetch_assoc()) {
            $idList[] = $rowData['id'];
        }

        $result = $this->sphinx()->query("SHOW META");
        $map = [];
        while ($row = $result->fetch_assoc()) {
            $map[$row['Variable_name']] = $row['Value'];
        }

        if (0 < count($idList)) {
            $idList = implode(',', $idList);

            if (!empty($idList)) {
                $result = $this->mysql()->query("SELECT `id`, `s`, `image`, `category`, `title` FROM `news` WHERE `id` IN ({$idList}) AND `status` = 'show' LIMIT 4");
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
                        $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
                    } else {
                        $row['image'] = Server::STATIC[0] . '/app/img/content/nop.jpg';
                    }

                    $data['news'][] = [
                        'id' => $row['id'],
                        'image' => $row['image'],
                        'category' => $row['category'],
                        'name_origin' => '',
                        'name_ru' => $row['title'],
                    ];
                }
            }
        }

        
        $this->setContent(json_encode($data));
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