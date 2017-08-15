<?php
namespace Kinomania\Control\Admin\Group;

use Dspbee\Bundle\Data\TDataInit;

/**
 * Class Item
 * @package Kinomania\Control\Admin
 */
class Item
{
    use TDataInit;
    
    public function __construct()
    {
        $this->id = 0;
        $this->name = '';
        $this->userCount = 0;

    }
    
    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function userCount()
    {
        return $this->userCount;
    }

    protected $id;
    protected $name;
    protected $userCount;
}