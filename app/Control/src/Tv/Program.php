<?php
namespace Kinomania\Control\Tv;

use Dspbee\Bundle\Data\TDataInit;

class Program
{
    use TDataInit;
    
    public function __construct()
    {
        $this->id = 0;
        $this->time = '';
        $this->name = '';
        $this->filmId = 0;
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function time()
    {
        $time = rtrim($this->time, '00');
        return rtrim($time, ':');
    }
    
    public function name()
    {
        return $this->name;
    }
    
    public function filmId()
    {
        return $this->filmId;
    }

    protected $id;
    protected $time;
    protected $name;
    protected $filmId;
}