<?php
namespace Kinomania\System\Parser\VseTV;

use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class VseTV
 * @package Kinomania\System\Parser\VseTV
 */
class VseTV
{
    use TText;
    use TError;

    const URL_ERROR = 'URL_ERROR';
    const HTTP_ERROR = 'HTTP_ERROR';
    const DOM_ERROR = 'DOM_ERROR';

    public function __construct()
    {
        $this->init();
    }

    public function parse($link, $local = false)
    {
        $this->init();
        $this->error = '';

        if (false === filter_var($link, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->tv;
        }

        if ($local) {
            $data = '';
            $path = dirname(__FILE__) . '/data.html';
            if (file_exists($path)) {
                $fh = fopen($path, 'rb');
                while (!feof($fh)) {
                    $data .= fread($fh, 4096);
                }
                fclose($fh);
            }
            
            if (empty($data)) {
                $data = $this->loadPage($link);
                $fh = fopen($path, 'wb');
                fwrite($fh, $data);
                fclose($fh);
            }
        } else {
            $data = $this->loadPage($link);
        }

        /**
         * Parse time data.
         */
        $classList = $this->ajaxPage('http://www.vsetv.com/s2.php?l');
        $classList = json_decode($classList, true);

        /**
         * Parse time fix script.
         */
        $replaceMap = $this->loadPage('http://www.vsetv.com/jquery-gs.js');
        $replaceMap = explode('myData.f;', $replaceMap);
        $replaceMap = $replaceMap[1] ?? '';
        $replaceMap = explode('}', $replaceMap);
        $replaceMap = $replaceMap[0];
        preg_match_all('|\$\((.*)\).replaceWith\("(.*)"\);|iU', $replaceMap, $replaceMap);
        $temp = [];
        foreach ($replaceMap[1] as $k => $v) {
            $temp[$v] = $replaceMap[2][$k];
        }
        $replaceMap = $temp;

        /**
         * Start parsing.
         */
        preg_match_all('|class="channeltitle">(.*)<|iU', $data, $chanelList);
        foreach ($chanelList[1] as $chanel) {
            foreach ($this->tv as $item => $empty) {
                if ($item == $chanel) {
                    $programData = explode($chanel . '</td>', $data);
                    $programData = $programData[1] ?? '';
                    $programData = explode('<div class="chname">', $programData);
                    $programData = $programData[0];

                    /**
                     * Time.
                     */
                    preg_match_all('|<div class="pasttime">(.*)</div>|iU', $programData, $timeData);
                    $timeList = $timeData[1];
                    preg_match_all('|<div class="onair">(.*)</div>|iU', $programData, $timeData);
                    $timeList = array_merge($timeList, $timeData[1]);
                    preg_match_all('|<div class="time">(.*)</div>|iU', $programData, $timeData);
                    $timeList = array_merge($timeList, $timeData[1]);

                    /**
                     * Program.
                     */
                    preg_match_all('|<div class="pastprname2">(.*)</div>|iU', $programData, $programTemp);
                    $programList = $programTemp[1];
                    preg_match_all('|<div class="prname2">(.*)</div>|iU', $programData, $programTemp);
                    $programList = array_merge($programList, $programTemp[1]);

                    foreach ($timeList as $k => $v) {
                        foreach ($replaceMap as $from => $num) {
                            $class = ltrim($classList[$from], '.');
                            $v = str_replace('<a class=' . $class . '></a>', $num, $v);
                        }
                        $timeList[$k] = $v;
                    }

                    foreach ($programList as $k => $v) {
                        $v = str_replace('&nbsp;', '', $v);
                        $programList[$k] = strip_tags($v);
                    }

                    $temp = [];
                    foreach ($timeList as $k => $v) {
                        $temp[$v] = $programList[$k];
                    }
                    $this->tv[$item] = $temp;
                    break;
                }
            }
        }
        
        return $this->tv;
    }

    /**
     * @param $url
     * @return string
     */
    private function loadPage($url)
    {
        $curl = new Curl(1);
        $curl->setUrl($url);
        $data = $curl->getPage();
        if (empty($data)) {
            $this->error = self::HTTP_ERROR;
            return $this->tv;
        }
        return $data;
    }

    /**
     * @param $url
     * @return string
     */
    private function ajaxPage($url)
    {
        $curl = new Curl(1);
        $curl->setUrl($url);
        $data = $curl->ajax();
        if (empty($data)) {
            $this->error = self::HTTP_ERROR;
            return $this->tv;
        }
        return $data;
    }

    private function init()
    {
        $this->tv = [
            'Первый канал (Россия)' => [],
            'Россия 1' => [],
            'НТВ' => [],
            '5 канал (Россия)' => [],
            'Карусель' => [],
            'ОТР' => [],
            'СТС' => [],
            'ТНТ' => [],
            'РЕН ТВ' => [],
            'ТВ Центр' => [],
            'Домашний' => [],
            'Мир' => [],
        ];
    }

    private $tv;
}