<?php
namespace Kinomania\Control\Storage;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\System\Base\DB;

/**
 * Class Autocomplete
 * @package Kinomania\Control\Storage
 */
class Autocomplete extends DB
{
    /**
     * @param string $term
     * @return string
     */
    public function ethnic($term = '')
    {
        return $this->autocomplete('ethnic', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function sport($term = '')
    {
        return $this->autocomplete('sport', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function language($term = '')
    {
        return $this->autocomplete('language', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function musicInstrument($term = '')
    {
        return $this->autocomplete('music_instrument', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function dance($term = '')
    {
        return $this->autocomplete('dance', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function sing($term = '')
    {
        return $this->autocomplete('sing', $this->initTerm($term));
    }
    
    /**
     * @param string $term
     * @return string
     */
    public function university($term = '')
    {
        return $this->autocomplete('university', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function department($term = '')
    {
        return $this->autocomplete('department', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function studio($term = '')
    {
        return $this->autocomplete('studio', $this->initTerm($term));
    }

    /**
     * @param string $term
     * @return string
     */
    public function theatre($term = '')
    {
        return $this->autocomplete('theatre', $this->initTerm($term));
    }

    /**
     * @param $term
     * @return string
     */
    private function initTerm($term)
    {
        if (empty($term)) {
            $term = (new GetBag())->fetch('term');
        }

        return $term;
    }


    /**
     * @param $key
     * @param string $term
     * @return string
     */
    private function autocomplete($key, $term = '')
    {
        switch ($key) {
            case 'ethnic':
                break;
            case 'sport':
                break;
            case 'language':
                break;
            case 'music_instrument':
                break;
            case 'dance':
                break;
            case 'sing':
                break;
            case 'university':
                break;
            case 'studio':
                break;
            case 'department':
                break;
            case 'theatre':
                break;
            default:
                $term = '';
        }

        $results = [];
        if (0 < mb_strlen($term, 'UTF-8')) {
            $term = explode(' ', $term);
            $term = array_map(function($val){
                return '+' . $val . '*';
            }, $term);
            $term = $this->db->real_escape_string(implode(' ', $term));
            $result = $this->db->query("SELECT `id`, `value` FROM `eav_storage` WHERE `key` = '{$key}' AND MATCH(`value`) AGAINST ('{$term}' IN BOOLEAN MODE) LIMIT 10");
            while ($row = $result->fetch_assoc()) {
                $results[] = ['id' => $row['id'], 'label' => $row['value']];
            }
        }

        return json_encode($results);
    }
}