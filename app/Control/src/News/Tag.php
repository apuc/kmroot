<?php
namespace Kinomania\Control\News;

use Dspbee\Bundle\Common\Bag\GetBag;

/**
 * Class Tag
 * @package Kinomania\Control\News
 */
class Tag
{
    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    /**
     * Get tag suggestions.
     * @return string
     */
    public function autoComplete()
    {
        $results = [];
        $term = (new GetBag())->fetchEscape('term', $this->db);
        if (0 < mb_strlen($term, 'UTF-8')) {
            $term = explode(' ', $term);
            $term = array_map(function ($val) {
                return $val . '*';
            }, $term);
            $term = $this->db->real_escape_string(implode(' ', $term));

            $result = $this->db->query("SELECT `id`, `tag` FROM `news_tag_value` WHERE MATCH(`tag`) AGAINST ('{$term}' IN BOOLEAN MODE)  LIMIT 10");
            while ($row = $result->fetch_assoc()) {
                $results[] = ['id' => $row['id'], 'label' => $row['tag']];
            }
        }
        
        return json_encode($results);
    }

    private $db;
}