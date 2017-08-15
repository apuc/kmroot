<?php
namespace Kinomania\System\Common;

/**
 * Class TTextTransform
 * @package Kinomania\System\Common
 */
trait TTextTransform
{
    /**
     * Delte all special chars and tags.
     * @param $val
     * @return string
     */
    public function clearText($val)
    {
        $val = htmlspecialchars_decode($val);
        $val = html_entity_decode($val);
        return strip_tags($val);
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