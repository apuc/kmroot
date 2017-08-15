<?php
namespace Control\Route_film_credits;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;

class AJAX extends AdminController
{
    /**
     * Person autocomplete.
     */
    public function getPerson()
    {
        $get = new GetBag();

        $results = [];
        $query = $get->fetch('term');

        if (0 == intval($query)) {
            $suggest = '';

            $q = explode(' ', $query);
            if (1 == count($q)) {
                $query .= '*';
            }
            $query = $this->sphinx()->real_escape_string($query);

            $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$query}') LIMIT 6 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
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
                foreach ($map as $k => $v) {

                    if (preg_match('/keyword\[\d+]/', $k)) {
                        preg_match('/\d+/', $k, $key);
                        $key = $key[0];
                        $words[$key]['keyword'] = $v;
                    }

                    if (preg_match('/docs\[\d+]/', $k)) {
                        preg_match('/\d+/', $k, $key);
                        $key = $key[0];
                        $words[$key]['docs'] = $v;
                    }
                }
                $suggest = $this->suggest($words, $query);
            } else {
                $idList = implode(',', $idList);

                $result = $this->mysql()->query("SELECT `id`, `name_origin`, `name_ru` FROM `person` WHERE `id` IN ({$idList}) LIMIT 4");
                while ($row = $result->fetch_assoc()) {
                    $row['value'] = $row['name_ru'];
                    if (empty($row['value'])) {
                        $row['value'] = $row['name_origin'];
                    }
                    $results[] = ['id' => $row['id'], 'label' => $row['value'] . ', ID = ' . $row['id']];
                }

            }

            if (!empty($suggest) && false === stripos($query, $suggest)) {
                $suggest = $this->sphinx()->real_escape_string($suggest);
                $result = $this->sphinx()->query("SELECT * FROM `person` WHERE MATCH('{$suggest}') LIMIT 6 OPTION ranker=sph04,field_weights=(name_ru=100,name_origin=90,search=80)");
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

                    $result = $this->mysql()->query("SELECT `id`, `name_origin`, `name_ru` FROM `person` WHERE `id` IN ({$idList}) LIMIT 4");
                    while ($row = $result->fetch_assoc()) {
                        $row['value'] = $row['name_ru'];
                        if (empty($row['value'])) {
                            $row['value'] = $row['name_origin'];
                        }
                        $results[] = ['id' => $row['id'], 'label' => $row['value'] . ', ID = ' . $row['id']];
                    }
                }
            }
        }

        $this->setContent(json_encode($results));
    }


    public function castOrder()
    {
        $post = new PostBag();
        $data = json_decode($post->fetch('data'), true);

        $order = 1;
        foreach ($data[0] as $id) {
            $id = intval($id['id'] ?? 0);
            if (0 < $id) {
                $this->mysql()->query("UPDATE `film_cast` SET `order` = {$order} WHERE `id` = {$id} LIMIT 1");
                $order++;
            }
        }

        $this->setContent('');
    }

    public function orderCrew()
    {
        $post = new PostBag();
        $data = json_decode($post->fetch('data'), true);

        $order = 1;
        foreach ($data[0] as $id) {
            $id = intval($id['id']);
            if (0 < $id) {
                $this->mysql()->query("UPDATE `film_crew` SET `order` = {$order} WHERE `id` = {$id} LIMIT 1");
                $order++;
            }
        }

        $this->setContent('');
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