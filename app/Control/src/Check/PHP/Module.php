<?php
namespace Kinomania\Control\Check\PHP;

/**
 * Class Module
 * @package Kinomania\Control\Check\PHP
 */
class Module
{
    /**
     * Module constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return bool
     */
    public function xml()
    {
        return extension_loaded('xml');
    }

    /**
     * @return bool
     */
    public function curl()
    {
        return extension_loaded('curl');
    }

    /**
     * @return bool
     */
    public function mbstring()
    {
        return extension_loaded('mbstring');
    }

    /**
     * @return bool
     */
    public function mysql()
    {
        return extension_loaded('mysqli');
    }

    /**
     * @return bool
     */
    public function gd()
    {
        return extension_loaded('gd');
    }
}

