<?php

namespace Kinomania\System\Options;

//use Kinomania\System\Common\TRepository;

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 21:43
 */
class Options extends Model_Options
{

    //use TRepository;

    public function get($key)
    {
    	$result = $this->query_get($key);
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
            $this->query_set($key,$value);
        } else {
            // нет данных
            $this->query_insert($key,$value);
        }
    }

}