<?php
namespace Kinomania\Control\Award;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->code = '';
        $this->name_ru = '';
        $this->name_en = '';
        $this->type = '';
        $this->description = '';

        $this->yearList = [];
    }


    public function id()
    {
        return $this->id;
    }

    public function code()
    {
        return $this->code;
    }

    public function name_ru()
    {
        return $this->name_ru;
    }

    public function name_en()
    {
        return $this->name_en;
    }

    public function type($raw = false)
    {
        if ($raw) {
            return $this->type;
        }

        switch ($this->type) {
            case 'award':
                return 'Премия';
                break;
            case 'festival':
                return 'Фестиваль';
                break;
        }

        return 'Скрыто';
    }

    public function description()
    {
        return $this->description;
    }
    
    public function yearList()
    {
        return $this->yearList;
    }

    protected $id;
    protected $code;
    protected $name_ru;
    protected $name_en;
    protected $type;
    protected $description;
    
    protected $yearList;
}