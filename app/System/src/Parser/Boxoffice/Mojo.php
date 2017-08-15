<?php
namespace Kinomania\System\Parser\Boxoffice;

use DiDom\Document;
use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class Mojo
 * @package Kinomania\System\Parser\Boxoffice
 */
class Mojo
{
    use TText;
    use TError;

    const URL_ERROR = 'URL_ERROR';
    const HTTP_ERROR = 'HTTP_ERROR';
    const DOM_ERROR = 'DOM_ERROR';

    public function __construct()
    {
    }

    public function parse($url)
    {
        $this->error = 0;
        $table = [];

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $table;
        }

        $curl = new Curl(0);
        $curl->setUrl($url);
        $data = $curl->getPage();
        if (empty($data)) {
            $this->error = self::HTTP_ERROR;
            return $table;
        }

        $data = str_replace('<sup>1</sup>', '', $data);
        $data = str_replace('<sup>2</sup>', '', $data);
        $data = str_replace('<sup>3</sup>', '', $data);

        $date = explode('Results for ', $data);
        if (!isset($date[1])) {
            $this->error = self::DOM_ERROR;
            return $table;
        }
        $date = explode('<', $date[1]);
        $date = explode('-', $date[0] ?? '');

        $temp = explode(', ', $date[1]);
        $date[1] = $temp[0];
        $year = $temp[1] ?? '';
        $year = str_replace(',', '', $year);
        $year = trim($year);

        $date_from = $date[0];
        $date_from = explode(' ', $date_from);

        $month = $date_from[0] ?? '';
        switch ($month) {
            case 'January':
                $month = '01';
                break;
            case 'February':
                $month = '02';
                break;
            case 'March':
                $month = '03';
                break;
            case 'April':
                $month = '04';
                break;
            case 'May':
                $month = '05';
                break;
            case 'June':
                $month = '06';
                break;
            case 'July':
                $month = '07';
                break;
            case 'August':
                $month = '08';
                break;
            case 'September':
                $month = '09';
                break;
            case 'October':
                $month = '10';
                break;
            case 'November':
                $month = '11';
                break;
            case 'December':
                $month = '12';
                break;
        }

        $date_from = $year . '-' . $month . '-' . $date_from[1] ?? '';

        $date_to = $date[1];
        $date_to = explode(' ', $date_to);
        $month_to = $month;
        if (isset($date_to[1])) {
            $month_to = $date_to[0] ?? 0;
            switch ($month_to) {
                case 'January':
                    $month_to = '01';
                    break;
                case 'February':
                    $month_to = '02';
                    break;
                case 'March':
                    $month_to = '03';
                    break;
                case 'April':
                    $month_to = '04';
                    break;
                case 'May':
                    $month_to = '05';
                    break;
                case 'June':
                    $month_to = '06';
                    break;
                case 'July':
                    $month_to = '07';
                    break;
                case 'August':
                    $month_to = '08';
                    break;
                case 'September':
                    $month_to = '09';
                    break;
                case 'October':
                    $month_to = '10';
                    break;
                case 'November':
                    $month_to = '11';
                    break;
                case 'December':
                    $month_to = '12';
                    break;
            }
            $date_to = $year . '-' . $month_to . '-' . $date_to[1] ?? '';
        } else {
            $date_to = $year . '-' . $month . '-' . $date_to[0] ?? '';
        }

        if ('12' == $month && '01' == $month_to) {
            $date_from = explode('-', $date_from);
            $year = $date_from[0] - 1;
            $date_from = $year . '-' . $date_from[1] . '-' . $date_from[2];
        }

        try {
            $document = new Document($data);
            if ($document->has('table')) {
                $skip = true;
                $count = 0;
                foreach ($document->find('table')[4]->find('tr') as $tr) {
                    if ($skip) {
                        $skip = false;
                        continue;
                    }
                    if (10 == $count) {
                        break;
                    }
                    $count++;

                    $item = [
                        $tr->find('td')[0]->text(),  // position
                        $tr->find('td')[1]->text(),  // previous week
                        $tr->find('td')[2]->text(),  // name
                        $tr->find('td')[3]->text(),  // company
                        $tr->find('td')[4]->text(),  // gross
                        $tr->find('td')[6]->text(),  // copy
                        $tr->find('td')[9]->text(),  // gross total
                        $tr->find('td')[11]->text(),  // week
                        $tr->find('td')[10]->text(),  // budget
                    ];

                    $item[0] = intval($item[0]);
                    $item[1] = intval($item[1]);

                    $item[4] = str_replace('$', '', $item[4]);
                    $item[4] = str_replace(',', '', $item[4]);
                    $item[4] = intval($item[4]);

                    $item[5] = str_replace(',', '', $item[5]);
                    $item[5] = intval($item[5]);

                    $item[6] = str_replace('$', '', $item[6]);
                    $item[6] = str_replace(',', '', $item[6]);
                    $item[6] = intval($item[6]);

                    $item[7] = intval($item[7]);

                    $item[8] = str_replace('$', '', $item[8]);
                    $item[8] = str_replace(',', '', $item[8]);
                    $item[8] = intval($item[8]);

                    $item[9] = $date_from;
                    $item[10] = $date_to;

                    $table[] = $item;
                }
            } else {
                throw new \Exception('DOM changed');
            }
        } catch (\Exception $e) {
            $this->error = self::DOM_ERROR;
        }

        return $table;
    }
}