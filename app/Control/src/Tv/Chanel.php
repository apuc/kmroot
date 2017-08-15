<?php
namespace Kinomania\Control\Tv;

use Dspbee\Bundle\Data\TDataInit;

class Chanel
{
    use TDataInit;
    
    public function __construct()
    {
        $this->id = 0;
        $this->date = '';
        $this->chanel = '';
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function date()
    {
        return $this->date;
    }
    
    public function chanel()
    {
        return $this->chanel;
    }

    protected $id;
    protected $date;
    protected $chanel;
}