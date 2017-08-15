<?php
namespace Kinomania\Original\Auth\Social;

/**
 * Class Social
 * @package Kinomania\Original\Auth\Social
 */
abstract class Social
{
    /**
     * Social constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    abstract public function getAuthLink();

    /**
     * @return bool
     */
    abstract public function authorize();

    /**
     * Make get request.
     *
     * @param string $url
     * @param array $params
     * @param bool $parse
     * @return mixed
     */
    protected function get($url, $params, $parse = true)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url . '?' . urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($parse) {
            $result = json_decode($result, true);
        }
        return $result;
    }

    /**
     * Make post request.
     *
     * @param string $url
     * @param array $params
     * @param bool $parse
     * @return mixed
     */
    protected function post($url, $params, $parse = true)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($parse) {
            $result = json_decode($result, true);
        }
        return $result;
    }
}