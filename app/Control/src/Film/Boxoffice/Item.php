<?php
namespace Kinomania\Control\Film\Boxoffice;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->world = 0;
        $this->ru = 0;
        $this->usa;
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function filmId()
    {
        return $this->filmId;
    }
    
    public function world()
    {
        if (0 == $this->world) {
            return '';
        }
        return $this->world;
    }
    
    public function ru()
    {
        if (0 == $this->ru) {
            return '';
        }
        return $this->ru;
    }
    
    public function usa()
    {
        if (0 == $this->usa) {
            return '';
        }
        return $this->usa;
    }

    protected $id;
    protected $filmId;
    protected $world;
    protected $ru;
    protected $usa;
}