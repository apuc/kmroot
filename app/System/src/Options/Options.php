<?php

namespace Kinomania\System\Options;

use Kinomania\System\Common\TRepository;

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 21:43
 */
class Options
{

    use TRepository;

    public function get($key)
    {
        $result = $this->mysql()->query("SELECT * FROM `options` WHERE `key` LIKE '{$key}' LIMIT 1");
        if ($result) {
            $value = '';
            while ($row = $result->fetch_assoc()) {
                $value = $row['value'];
            }
            return $value;
        }
        return false;
    }

    public function set($key, $value)
    {
        if ($this->get($key)) {
            // Есть данные
            $this->mysql()->query("UPDATE `options` SET `value` = '{$value}' WHERE `key` LIKE '{$key}'");
        } else {
            // нет данных
            $this->mysql()->query("INSERT INTO `options` (`key`, `value`) VALUES ('{$key}', '{$value}')");
        }
    }

}