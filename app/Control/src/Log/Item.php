<?php
namespace Kinomania\Control\Log;

use Dspbee\Bundle\Data\TDataInit;

/**
 * Class Item
 * @package Kinomania\Control\Log
 */
class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->date = '';
        $this->adminId = 0;
        $this->route = '';
        $this->handler = '';
        $this->error = '';
        $this->comment = '';
        $this->data = '';
    }
    
    public function id()
    {
        return $this->id;
    }

    public function date()
    {
        return $this->date;
    }

    public function adminId()
    {
        return $this->adminId;
    }

    public function route()
    {
        return $this->route;
    }

    public function handler()
    {
        return $this->handler;
    }

    public function error()
    {
        return $this->error;
    }

    public function comment()
    {
        return $this->comment;
    }

    public function data()
    {
        return $this->data;
    }

    protected $id;
    protected $date;
    protected $adminId;
    protected $route;
    protected $handler;
    protected $error;
    protected $comment;
    protected $data;
}