<?php
namespace Kinomania\Control\Auth;

/**
 * Class Auth
 * @package Kinomania\System\Auth\Admin
 */
class Auth extends \Dspbee\Auth\Auth
{
    public function __construct(\mysqli $db)
    {
        parent::__construct($db);

        $this->tableUser = 'admin';
        $this->tableGroup = 'admin_group';
        $this->tableToken = 'admin_token';
        $this->tokenName = '__admin__';
        $this->tableUserAccess = 'admin_access';
    }
}