<?php
namespace Kinomania\System\Base;

use Kinomania\System\Common\TError;

/**
 * Often used constructor.
 *
 * Class DB
 * @package Kinomania\System\Base
 */
class DB
{
    use TError;
    
    /**
     * DB constructor.
     * @param \mysqli $db
     */
    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    protected $db;
}