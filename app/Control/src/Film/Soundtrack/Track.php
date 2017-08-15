<?php
namespace Kinomania\Control\Film\Soundtrack;

use Dspbee\Bundle\Data\TDataInit;

class Track
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->dirId = 0;
        $this->m = 0;
        $this->author = '';
        $this->name = '';
        $this->time = '';
        $this->order = 0;
    }
    
    public function id()
    {
        return $this->id;
    }

    public function dirId()
    {
        return $this->dirId;
    }

    public function m()
    {
        return $this->m;
    }

    public function author()
    {
        return $this->author;
    }

    public function name()
    {
        return $this->name;
    }

    public function time()
    {
        return $this->time;
    }

    public function order()
    {
        return $this->order;
    }

    protected function setTime($val)
    {
        $val = explode(':', $val);
        $index = count($val) - 1;
        if (isset($val[$index])) {
            unset($val[$index]);
        }
        $val = implode(':', $val);
        $this->time = $val;
    }

    protected $id;
    protected $dirId;
    protected $m;
    protected $author;
    protected $name;
    protected $time;
    protected $order;
}