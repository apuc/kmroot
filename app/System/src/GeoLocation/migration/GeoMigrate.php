<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 14.09.2017
 * Time: 15:13
 */

namespace Kinomania\System\GeoLocation\migration;




use Kinomania\System\Common\TRepository;
use Kinomania\System\GeoLocation\IpGeoBase;

class GeoMigrate
{
    use TRepository;

    public static function init()
    {
        return New self();
    }

    /**
     * Создание таблиц геолокаций
     */
    public function setTables()
    {
        $this->mysql()->query("CREATE TABLE IF NOT EXISTS `geobase_ip` (
                            `ip_begin` INT UNSIGNED NOT NULL,
            				`ip_end`  INT UNSIGNED NOT NULL,
           					`country_code` VARCHAR(2) NOT NULL,
            				`city_id` INT(6) UNSIGNED NOT NULL)");

        $this->mysql()->query("CREATE TABLE IF NOT EXISTS `geobase_city`(
                            `id` INT(6) UNSIGNED NOT NULL,
                            `name` VARCHAR(50) NOT NULL,
                            `region_id` INT(6) UNSIGNED NOT NULL,
                            `latitude` DOUBLE NOT NULL,
                            `longitude` DOUBLE NOT NULL)");

        $this->mysql()->query("CREATE TABLE IF NOT EXISTS `geobase_region`( 
                            `id` INT(6) UNSIGNED NOT NULL,
                            `name` VARCHAR(50) NOT NULL)");

        $this->mysql()->query("CREATE UNIQUE INDEX `ip_begin` IF NOT EXISTS
                                              ON `geobase_ip` (`ip_begin`)");
        $this->mysql()->query("CREATE UNIQUE INDEX `id` IF NOT EXISTS
                                              ON `geobase_city` (`id`)");
        $this->mysql()->query("CREATE UNIQUE INDEX `id` IF NOT EXISTS
                                              ON `geobase_region` (`id`)");
    }
}