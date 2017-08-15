<?php
namespace Kinomania\Control\Film\Company;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;
    
    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->companyId = 0;
        $this->type = '';
        
        $this->name = '';
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function filmId()
    {
        return $this->filmId;
    }
    
    public function companyId()
    {
        return $this->companyId;
    }
    
    public function type()
    {
        return $this->type;
    }

    
    public function name()
    {
        return $this->name;
    }

    protected $id;
    protected $filmId;
    protected $companyId;
    protected $type;
    
    protected $name;
}