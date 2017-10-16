<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 12.10.2017
 * Time: 18:20
 */

namespace Kinomania\System\Db;

use Kinomania\System\Common\TRepository;

class BdConnect
{

    use TRepository;

    public function getConnect()
    {
        return $this->mysql();
    }

}