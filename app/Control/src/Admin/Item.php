<?php
namespace Kinomania\Control\Admin;

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
        $this->groupId = 0;
        $this->email = '';
        $this->password = '';
        $this->status = '';
        $this->hash = '';
        $this->hashChange = '';
        $this->name = '';
        $this->surname = '';
        $this->userId = 0;
    }

    public function id()
    {
        return $this->id;
    }

    public function groupId()
    {
        return $this->groupId;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function status()
    {
        return $this->status;
    }

    public function hash()
    {
        return $this->hash;
    }

    public function hashChange()
    {
        return $this->hashChange;
    }

    public function name()
    {
        return $this->name;
    }

    public function surname()
    {
        return $this->surname;
    }

    public function userId()
    {
        if (0 == $this->userId) {
            return '';
        }
        return $this->userId;
    }

    protected $id;
    protected $groupId;
    protected $email;
    protected $password;
    protected $status;
    protected $hash;
    protected $hashChange;
    protected $name;
    protected $surname;
    protected $userId;
}