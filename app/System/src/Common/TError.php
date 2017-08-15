<?php
namespace Kinomania\System\Common;

/**
 * Trait TError
 * @package Kinomania\System\Common
 */
trait TError
{
    /**
     * Get error.
     * @return mixed
     */
    public function error()
    {
        return $this->error;
    }
    
    protected $error;
}