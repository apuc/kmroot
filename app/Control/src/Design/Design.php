<?php
namespace Kinomania\Control\Design;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Common\TFileSystem;
use Kinomania\System\Base\DB;

/**
 * Class Design
 * @package Kinomania\Control\Design
 */
class Design extends DB
{
    use TFileSystem;
    
    public function getById($id)
    {
        $id = intval($id);
        $item = new Item();

        $result = $this->db->query("SELECT * FROM `design` WHERE `id` = {$id} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $item->initFromArray($row);
        }

        return $item;
    }

    public function delete()
    {
        $this->error = '';
        $post = new PostBag();
        $id = $post->fetchInt('id');

        $this->db->query("DELETE FROM `design` WHERE `id` = {$id} LIMIT 1");
        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @param string $root
     * @return bool
     */
    public function edit($root)
    {
        $this->error = '';
        $post = new PostBag();

        $id = $post->fetchInt('id');
        $status = $post->fetchEscape('status', $this->db);
        $name = $post->fetchEscape('name', $this->db);
        $html_header = $post->fetchEscape('html_header', $this->db);
        $html_footer = $post->fetchEscape('html_footer', $this->db);
        $path_css = $post->fetchEscape('path_css', $this->db);
        $includes = $post->fetchEscape('includes', $this->db);
        $right_banner = $post->fetchEscape('right_banner', $this->db);
        $center_banner = $post->fetchEscape('center_banner', $this->db);
        $pre_roll = $post->fetchEscape('pre_roll', $this->db);
        $pre_roll_link = $post->fetchEscape('pre_roll_link', $this->db);

        $this->db->query("UPDATE `design` SET
                          `status` = '{$status}',
                          `name` = '{$name}',
                          `html_header` = '{$html_header}',
                          `html_footer` = '{$html_footer}',
                          `path_css` = '{$path_css}',
                          `includes` = '{$includes}',
                          `right_banner` = '{$right_banner}',
                          `center_banner` = '{$center_banner}',
                          `pre_roll` = '{$pre_roll}',
                          `pre_roll_link` = '{$pre_roll_link}'
                          WHERE `id` = {$id} LIMIT 1");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        $root = dirname($root) . '/Original/view/_cache';
        self::removeFromDir($root);

        return true;
    }

    /**
     * @return bool
     */
    public function add()
    {
        $this->error = '';
        $post = new PostBag();
        
        $status = $post->fetchEscape('status', $this->db);
        $name = $post->fetchEscape('name', $this->db);
        $html_header = $post->fetchEscape('html_header', $this->db);
        $html_footer = $post->fetchEscape('html_footer', $this->db);
        $path_css = $post->fetchEscape('path_css', $this->db);
        $includes = $post->fetchEscape('includes', $this->db);
        $right_banner = $post->fetchEscape('right_banner', $this->db);
        $center_banner = $post->fetchEscape('center_banner', $this->db);
        $pre_roll = $post->fetchEscape('pre_roll', $this->db);
        $pre_roll_link = $post->fetchEscape('pre_roll_link', $this->db);

        $this->db->query("INSERT INTO `design` SET
                          `status` = '{$status}',
                          `name` = '{$name}',
                          `html_header` = '{$html_header}',
                          `html_footer` = '{$html_footer}',
                          `path_css` = '{$path_css}',
                          `includes` = '{$includes}',
                          `right_banner` = '{$right_banner}',
                          `center_banner` = '{$center_banner}',
                          `pre_roll` = '{$pre_roll}',
                          `pre_roll_link` = '{$pre_roll_link}'
                          ");

        if (!empty($this->db->error)) {
            $this->error = $this->db->error;
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];
        
        $result = $this->db->query("SELECT `id`, `status`, `date`, `name` FROM `design` ORDER BY `id` DESC");
        while ($row = $result->fetch_assoc()) {
            $item = new Item();
            $item->initFromArray($row);
            $list[] = $item;
        }
        
        return $list;
    }
}