<?php
namespace Kinomania\System\Parser\Boxoffice;

use DiDom\Document;
use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class Kinometro
 * @package Kinomania\System\Parser\Boxoffice
 */
class Kinometro
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

        $course = explode('$1 = ', $data);
        $course = $course[1] ?? '';
        $course = explode(' ', $course);
        $course = $course[0];

        $date = explode(' - ', $data);
        $date_from = $date[0];
        $date_from = explode(' ', $date_from);
        $date_from = $date_from[count($date_from) - 1];
        $date_to = $date[1];
        $date_to = explode('<', $date_to);
        $date_to = $date_to[0];

        $temp = explode('.', $date_from);
        $date_from = '20';
        $date_from .= $temp[2] ?? '';
        $date_from .= '-';
        $date_from .= $temp[1] ?? '';
        $date_from .= '-';
        $date_from .= $temp[0] ?? '';

        $temp = explode('.', $date_to);
        $date_to = '20';
        $date_to .= $temp[2] ?? '';
        $date_to .= '-';
        $date_to .= $temp[1] ?? '';
        $date_to .= '-';
        $date_to .= $temp[0] ?? '';

        try {
            $document = new Document($data);
            if ($document->has('.box_full')) {
                $skip = true;
                $count = 0;
                foreach ($document->find('.box_full tr') as $tr) {
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
                        $tr->find('td')[2]->html(),  // name
                        $tr->find('td')[3]->text(),  // company
                        $tr->find('td')[4]->text(),  // week
                        $tr->find('td')[5]->html(),  // copy
                        $tr->find('td')[6]->html(),  // gross
                        $tr->find('td')[7]->html(),  // gross total
                        $tr->find('td')[9]->text(),  // views
                        $tr->find('td')[10]->text(), // views total
                    ];

                    $item[2] = explode('<br>', $item[2]);
                    $item[2] = array_map(function ($val) {
                        return $this->clearSpaces(strip_tags($val));
                    }, $item[2]);

                    $item[5] = explode('<br>', $item[5]);
                    $item[5] = strip_tags($item[5][0]);

                    $item[6] = explode('<br>', $item[6]);
                    $item[6] = array_map(function ($val) {
                        return $this->clearSpaces(strip_tags($val));
                    }, $item[6]);


                    $item[7] = explode('<br>', $item[7]);
                    $item[7] = array_map(function ($val) {
                        return $this->clearSpaces(strip_tags($val));
                    }, $item[7]);
                    $item[10] = $course;
                    $item[11] = $date_from;
                    $item[12] = $date_to;

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