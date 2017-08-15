<?php
namespace Kinomania\Control\Package ;

use Dspbee\Bundle\Data\TDataInit;

/**
 * Class Item
 * @package Kinomania\Control\System
 */
class Item
{
    use TDataInit;
    
    public function __construct()
    {
        $this->id = 0;
        $this->route = '';
        $this->title = '';
        $this->access = null;
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function route()
    {
        return $this->route;
    }
    
    public function title()
    {
        return $this->title;
    }
    
    public function access()
    {
        return $this->access;
    }
    
    public function setAccess($access)
    {
        if (is_bool($access)) {
            $this->access = $access;
        } else {
            if ('false' == strtolower($access)) {
                $this->access = false;
            } else if ('true' == strtolower($access)) {
                $this->access = true;
            }
        }
    }
    
    protected $id;
    protected $route;
    protected $title;
    protected $access;
}