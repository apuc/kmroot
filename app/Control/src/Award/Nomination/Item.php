<?php
namespace Kinomania\Control\Award\Nomination;

use Dspbee\Bundle\Data\TDataInit;

/**
 * Class Item
 * @package Kinomania\Control\Award\Nomination
 */
class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->name_ru = '';
        $this->name_en = '';
        $this->awardId = 0;
        $this->type = '';
    }
    
    public function id()
    {
        return $this->id;
    }

    public function name_ru()
    {
        return $this->name_ru;
    }

    public function name_en()
    {
        return $this->name_en;
    }

    public function awardId()
    {
        return $this->awardId;
    }

    public function type()
    {
        return $this->type;
    }

    protected $id;
    protected $name_ru;
    protected $name_en;
    protected $awardId;
    protected $type;
}