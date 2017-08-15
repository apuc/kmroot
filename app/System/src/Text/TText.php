<?php
namespace Kinomania\System\Text;

/**
 * Trait TText
 * @package Kinomania\System\Text
 */
trait TText
{
    /**
     * Delete all special chars and tags.
     * @param $val
     * @return string
     */
    public function clearText($val)
    {
        $val = htmlspecialchars_decode($val);
        $val = html_entity_decode($val);
        $val = str_replace('"', '&quot;', $val);
        $val = trim($val);
        return strip_tags($val);
    }
    
    /**
     * @param string $text
     * @param bool $removeTags
     * @return string
     */
    public function repairText($text, $removeTags = true)
    {
        $text = str_replace('*amp;', '&', $text);
        $text = str_replace('*quot;', '"', $text);
        $text = str_replace('*gt;', '>', $text);
        $text = str_replace('*lt;', '<', $text);
        $text = htmlspecialchars_decode($text);
        if ($removeTags) {
            $text = html_entity_decode($text);
            $text = strip_tags($text);
            $text = str_replace('"', '&quot;', $text);
        }
        return $this->clearSpaces($text);

    }

    /**
     * Delete multiple spaces.
     * @param string $text
     * @return string
     */
    public function clearSpaces($text)
    {
        return trim(preg_replace('/\s\s+/', ' ', $text));
    }
}