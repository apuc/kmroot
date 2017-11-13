<?php
/**
 * @link https://github.com/himiklab/yii2-ipgeobase-component
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Kinomania\System\GeoLocation;

use Kinomania\System\Common\TRepository;
use Kinomania\System\Debug\Debug;

/**
 * Компонент для работы с базой IP-адресов сайта IpGeoBase.ru,
 * он Реализует поиск географического местонахождения IP-адреса,
 * выделенного RIPE локальным интернет-реестрам (LIR-ам).
 * Для Российской Федерации и Украины с точностью до города.
 *
 * @author HimikLab
 * @package himiklab\ipgeobase
 */
class IpGeoBase
{
    use TRepository;
    const XML_URL = 'http://ipgeobase.ru:7020/geo?ip=';
    const ARCHIVE_URL = 'http://ipgeobase.ru/files/db/Main/geo_files.zip';
    const ARCHIVE_IPS_FILE = 'cidr_optim.txt';
    const ARCHIVE_CITIES_FILE = 'cities.txt';
    const DB_IP_INSERTING_ROWS = 20000; // максимальный размер (строки) пакета для INSERT запроса
    const DB_IP_TABLE_NAME = '{{%geobase_ip}}';
    const DB_CITY_TABLE_NAME = '{{%geobase_city}}';
    const DB_REGION_TABLE_NAME = '{{%geobase_region}}';
    /** @var bool $useLocalDB Использовать ли локальную базу данных */
    public $useLocalDB = true;

    /**
     * Определение географического положеня по IP-адресу.
     * @param string $ip
     * @param bool $asArray
     * @return array|IpData ('ip', 'country', 'city', 'region', 'lat', 'lng') или false если ничего не найдено.
     */
    public function getLocation($asArray = true)
    {
        $ip = '217.118.81.17';
        //$ip = '195.218.132.1';
        //$ip = self::getRealIpAddr();
        if ($this->useLocalDB) {
            $ipDataArray = $this->fromDB($ip) + ['ip' => $ip];
        } else {
            $ipDataArray = $this->fromSite($ip) + ['ip' => $ip];
        }
        if ($asArray) {
            return $ipDataArray;
        }

        return new IpData($ipDataArray);
    }

    public static function getCityInfo()
    {
        $obj = new IpGeoBase();
        $city = unserialize($_COOKIE['city'] ?? '', []);
        if (empty($city)) {
            $city = $obj->getLocation();
        }
        return $city;
    }

    public static function getSelf()
    {
        return get_class();
    }

    /**
     * Тест скорости получения данных из БД.
     * @param int $iterations
     * @return float IP/second
     */
    public function speedTest($iterations)
    {
        $ips = [];
        for ($i = 0; $i < $iterations; ++$i) {
            $ips[] = mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
        }
        $begin = microtime(true);
        foreach ($ips as $ip) {
            $this->getLocation($ip);
        }
        $time = microtime(true) - $begin;
        if ($time != 0 && $iterations != 0) {
            return $iterations / $time;
        } else {
            return 0.0;
        }
    }

    /**
     * Метод создаёт или обновляет локальную базу IP-адресов.
     * @throws Exception
     */
    public function updateDB()
    {
        if (($fileName = $this->getArchive()) == false) {
            throw new Exception('Ошибка загрузки архива.');
        }
        $zip = new \ZipArchive;
        if ($zip->open($fileName) !== true) {
            @unlink($fileName);
            throw new Exception('Ошибка распаковки.');
        }
        $this->generateIpTable($zip);
        $this->generateCityTables($zip);
        $zip->close();
        @unlink($fileName);
    }

    /**
     * @param string $ip
     * @return array
     */
    protected function fromSite($ip)
    {
        $xmlData = $this->getRemoteContent(self::XML_URL . urlencode($ip));
        $ipData = (new \SimpleXMLElement($xmlData))->ip;
        if (isset($ip->message)) {
            return [];
        }
        return [
            'country' => (string)$ipData->country,
            'city' => isset($ipData->city) ? (string)$ipData->city : null,
            'region' => isset($ipData->region) ? (string)$ipData->region : null,
            'lat' => isset($ipData->lat) ? (string)$ipData->lat : null,
            'lng' => isset($ipData->lng) ? (string)$ipData->lng : null,
        ];
    }

    /**
     * @param string $ip
     * @return array
     */
    protected function fromDB($ip)
    {
        $result = $this->mysql()->query(
            "SELECT tIp.country_code AS country, tCity.name AS city, tCity.id AS city_id,
                    tRegion.name AS region, tCity.latitude AS lat,
                    tCity.longitude AS lng
            FROM (SELECT * FROM `geobase_ip` WHERE ip_begin <= INET_ATON('" . $ip . "') ORDER BY ip_begin DESC LIMIT 1) AS tIp
            LEFT JOIN `geobase_city` AS tCity ON tCity.id = tIp.city_id
            LEFT JOIN `geobase_region` AS tRegion ON tRegion.id = tCity.region_id
            WHERE INET_ATON('" . $ip . "') <= tIp.ip_end"
        );

        if ($row = $result->fetch_assoc()) {
            return $row;
        } else {
            return [];
        }
    }

    /**
     * Метод производит заполнение таблиц городов и регионов используя
     * данные из файла self::ARCHIVE_CITIES.
     * @param $zip \ZipArchive
     * @throws \yii\db\Exception
     */
    protected function generateCityTables($zip)
    {
        $citiesArray = explode("\n", $zip->getFromName(self::ARCHIVE_CITIES_FILE));
        array_pop($citiesArray); // пустая строка
        $cities = [];
        $uniqueRegions = [];
        $regionId = 1;
        $queryValues = '';
        $queryValuesRegions = '';

        foreach ($citiesArray as $city) {
            $queryValues .= '(';
            $row = explode("\t", $city);
            $regionName = iconv('WINDOWS-1251', 'UTF-8', $row[2]);
            if (!isset($uniqueRegions[$regionName])) {
                // новый регион
                $uniqueRegions[$regionName] = $regionId++;
            }
            $cities[$row[0]][0] = $row[0]; // id
            $cities[$row[0]][1] = "'" . iconv('WINDOWS-1251', 'UTF-8', $row[1]) . "'"; // name
            $cities[$row[0]][2] = "'" . $uniqueRegions[$regionName] . "'"; // region_id
            $cities[$row[0]][3] = $row[4]; // latitude
            $cities[$row[0]][4] = $row[5]; // longitude
            $queryValues .= implode(',', $cities[$row[0]]) . ')';

            if (next($citiesArray)) {
                $queryValues .= ',';
            }
        }
        // города
        //Yii::$app->db->createCommand()->truncateTable(self::DB_CITY_TABLE_NAME)->execute();
        $this->mysql()->query(
            "TRUNCATE TABLE `geobase_city`"
        );
        $this->mysql()->query(
            "INSERT INTO `geobase_city` (`id`, `name`, `region_id`, `latitude`, `longitude`) VALUES " . $queryValues
        );
        // регионы
        //$regions = [];
        foreach ($uniqueRegions as $regionUniqName => $regionUniqId) {
            $queryValuesRegions .= '(';
            $queryValuesRegions .= $regionUniqId . ", '" . $regionUniqName . "'";
            $queryValuesRegions .= ')';
            if (next($uniqueRegions)) {
                $queryValuesRegions .= ',';
            }
        }
        //Yii::$app->db->createCommand()->truncateTable(self::DB_REGION_TABLE_NAME)->execute();
        //Debug::prn("INSERT INTO `geobase_region` (`id`, `name`) VALUES ". $queryValuesRegions);die();
        $this->mysql()->query(
            "TRUNCATE TABLE `geobase_region`"
        );
        $this->mysql()->query(
            "INSERT INTO `geobase_region` (`id`, `name`) VALUES " . $queryValuesRegions
        );
    }

    /**
     * Метод производит заполнение таблиц IP-адресов используя
     * данные из файла self::ARCHIVE_IPS.
     * @param $zip \ZipArchive
     * @throws \yii\db\Exception
     */
    protected function generateIpTable($zip)
    {
        $ipsArray = explode("\n", $zip->getFromName(self::ARCHIVE_IPS_FILE));
        array_pop($ipsArray); // пустая строка
        $i = 0;
        $values = '';
        $this->mysql()->query(
            "TRUNCATE TABLE `geobase_ip`"
        );
        foreach ($ipsArray as $ip) {
            $row = explode("\t", $ip);
            $values .= '(' . (float)$row[0] .
                ',' . (float)$row[1] .
                ",'" . (string)($row[3]) . "'" .
                ',' . ($row[4] !== '-' ? (int)$row[4] : 0) .
                ')';
            ++$i;

            if ($i === self::DB_IP_INSERTING_ROWS) {
                /*$this->mysql()->query(
                    "TRUNCATE TABLE `geobase_ip`"
                );*/
                $this->mysql()->query(
                    "INSERT INTO `geobase_ip` (ip_begin, ip_end, country_code, city_id)
                    VALUES " . $values
                );
                $i = 0;
                $values = '';
                continue;
            }
            $values .= ',';
        }
        // оставшиеся строки не вошедшие в пакеты
        $this->mysql()->query(
            "INSERT INTO `geobase_ip` (ip_begin, ip_end, country_code, city_id)
            VALUES " . rtrim($values, ',')
        );
    }

    /**
     * Метод загружает архив с данными с адреса self::ARCHIVE_URL.
     * @return bool|string путь к загруженному файлу или false если файл загрузить не удалось.
     */
    protected function getArchive()
    {
        $fileData = $this->getRemoteContent(self::ARCHIVE_URL);
        if ($fileData == false) {
            return false;
        }
        $fileName = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR .
            'System' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'GeoLocation' . DIRECTORY_SEPARATOR .
            substr(strrchr(self::ARCHIVE_URL, '/'), 1);
        if (file_put_contents($fileName, $fileData) != false) {
            return $fileName;
        }
        return false;
    }

    public function test()
    {
        return $this->getArchive();
    }

    /**
     * Метод возвращает содержимое документа полученного по указанному url.
     * @param string $url
     * @return mixed|string
     */
    protected function getRemoteContent($url)
    {
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt_array($curl, [
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
            ]);
            $data = curl_exec($curl);
            curl_close($curl);
            return $data;
        } else {
            return file_get_contents($url);
        }
    }

    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
