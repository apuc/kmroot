<?php
namespace Kinomania\Control\Design;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Common\TDate;

class Item
{
    use TDataInit;
    use TDate;

    public function __construct()
    {
        $this->id = 0;
        $this->status = '';
        $this->name = '';
        $this->date = '';
        $this->html_header = '';
        $this->html_footer = '';
        $this->path_css = '';
        $this->includes = '';
        $this->right_banner = '';
        $this->center_banner = '';
        $this->pre_roll = '';
        $this->pre_roll_link = '';
    }


    public function id()
    {
        return $this->id;
    }

    public function status()
    {
        return $this->status;
    }

    public function name()
    {
        return $this->name;
    }

    public function date()
    {
        return $this->formatDate($this->date, true, '&nbsp;');
    }

    public function html_header()
    {
        return $this->html_header;
    }

    public function html_footer()
    {
        return $this->html_footer;
    }

    public function path_css()
    {
        return $this->path_css;
    }

    public function includes()
    {
        return $this->includes;
    }

    public function right_banner()
    {
        return $this->right_banner;
    }

    public function center_banner()
    {
        return $this->center_banner;
    }

    public function pre_roll()
    {
        return $this->pre_roll;
    }

    public function pre_roll_link()
    {
        return $this->pre_roll_link;
    }

    protected $id;
    protected $status;
    protected $name;
    protected $date;
    protected $html_header;
    protected $html_footer;
    protected $path_css;
    protected $includes;
    protected $right_banner;
    protected $center_banner;
    protected $pre_roll;
    protected $pre_roll_link;
}