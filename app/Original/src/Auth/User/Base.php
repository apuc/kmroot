<?php
namespace Kinomania\Original\Auth\User;

use Kinomania\System\Common\TError;
use Kinomania\System\Common\TTextTransform;

/**
 * Class Base
 * @package Kinomania\Original\Auth\User
 */
class Base
{
    use TError;
    use TTextTransform;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }
    
    protected $db;
}