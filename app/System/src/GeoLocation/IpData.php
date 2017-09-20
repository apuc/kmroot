<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 15.09.2017
 * Time: 9:39
 */

namespace Kinomania\System\GeoLocation;


class IpData
{
    public $ip;
    public $country;
    public $city;
    public $region;
    public $lat;
    public $lng;

    public function __construct(array $data)
    {
        foreach ($data as $fieldName => $fieldValue) {
            if (property_exists($this, $fieldName)) {
                $this->$fieldName = $fieldValue;
            }
        }
    }
}