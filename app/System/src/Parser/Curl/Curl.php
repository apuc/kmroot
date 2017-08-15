<?php
namespace Kinomania\System\Parser\Curl;

/**
 * Class Curl
 * @package Kinomania\System\Parser
 */
class Curl
{
    public function __construct($id){
        $root = dirname(__FILE__) . '/file/';

        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true); // вывод в перменную?
        curl_setopt($this->ch, CURLOPT_HEADER, false); // включить заголовки в вывод?
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true); // идти по редиректам?
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // проверять сертификат узла сети?
        curl_setopt($this->ch, CURLOPT_VERBOSE, true); // выводить доп инф?
        curl_setopt($this->ch, CURLOPT_HTTPPROXYTUNNEL, false);
        curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36');

        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $root . "cookie_j_{$id}.txt");
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $root . "cookie_f_{$id}.txt");

        $this->url = '';
        $this->referrer = '';
    }
    
    public function url()
    {
        return $this->url;
    }

    public function referrer()
    {
        return $this->referrer;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;
        curl_setopt($this->ch, CURLOPT_REFERER, $referrer);
    }

    public function setUA($ua)
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $ua);
    }

    public function setProxy($proxy)
    {
        if (!empty($proxy)) {
            curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
        } else {
            curl_setopt($this->ch, CURLOPT_PROXY, null);
        }
    }

    public function getPage()
    {
        $page = curl_exec($this->ch);
        if (200 == curl_getinfo($this->ch, CURLINFO_HTTP_CODE)) {
            if (!preg_match('//u', $page)) {
                $page = iconv('windows-1251', 'UTF-8', $page);
            }
            return $page;
        }
        
        return '';
    }

    public function ajax($data = [])
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
        $data = http_build_query($data);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        $page = curl_exec($this->ch);
        
        if (200 == curl_getinfo($this->ch, CURLINFO_HTTP_CODE)) {
            if (!preg_match('//u', $page)) {
                $page = iconv('windows-1251', 'UTF-8', $page);
            }
            return $page;
        }

        return '';
    }

    public function GET_form($url, $data)
    {
        $data = http_build_query($data);
        $this->setUrl($url . '?' . $data);
        $page = curl_exec($this->ch);
        return $page;
    }

    private $ch;
    private $url;
    private $referrer;
}