<?php
namespace Kinomania\System\Common;

/**
 * Class TDate
 * @package Dspbee\System\Common
 */
trait TDate
{
    /**
     * @param string $d
     * @param bool $time
     * @param string $delimiter
     * @return string
     */
    public function formatDate($d, $time = false, $delimiter = '<br />')
    {
        if (false === strpos($d, '-')) {
            return '';
        }
        
        $date = explode('-', $d);

        switch ($date[1]) {
            case 1:
                $m = 'января';
                break;
            case 2:
                $m = 'февраля';
                break;
            case 3:
                $m = 'марта';
                break;
            case 4:
                $m = 'апреля';
                break;
            case 5:
                $m = 'мая';
                break;
            case 6:
                $m = 'июня';
                break;
            case 7:
                $m = 'июля';
                break;
            case 8:
                $m = 'августа';
                break;
            case 9:
                $m = 'сентября';
                break;
            case 10:
                $m = 'октября';
                break;
            case 11:
                $m = 'ноября';
                break;
            case 12:
                $m = 'декабря';
                break;
            default:
                $m = '';
                break;
        }

        $dat = explode(' ', $date[2]);

        if ($time) {
            $time = explode(' ', $d);
            $time = $time[1];
            $date[2] = intval($dat[0]);
            return $date[2] . '&nbsp;' . $m . '&nbsp;' . $date[0] . $delimiter . $time;
        } else {
            $date[2] = intval($dat[0]);
            return $date[2] . '&nbsp;' . $m . '&nbsp;' . $date[0];
        }
    }

    /**
     * @param $name
     * @return int
     */
    public function getMonthByName($name) {
        switch ($name) {
            case 'января':
                $m = 1;
                break;
            case 'февраля':
                $m = 2;
                break;
            case 'марта':
                $m = 3;
                break;
            case 'апреля':
                $m = 4;
                break;
            case 'мая':
                $m = 5;
                break;
            case 'июня':
                $m = 6;
                break;
            case 'июля':
                $m = 7;
                break;
            case 'августа':
                $m = 8;
                break;
            case 'сентября':
                $m = 9;
                break;
            case 'октября':
                $m = 10;
                break;
            case 'ноября':
                $m = 11;
                break;
            case 'декабря':
                $m = 12;
                break;
            default:
                $m = 0;
                break;
        }
        return $m;
    }
}