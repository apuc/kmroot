<?php
namespace Kinomania\Original\Logic\TV;

use Kinomania\Original\Key\TV\Film;
use Kinomania\Original\Key\TV\Chanel;
use Kinomania\Original\Key\TV\Program;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class TV
 * @package Kinomania\Original\Company
 */
class TV
{
    use TRepository;
    use TDate;

    public function get($date, $chanelId = 0)
    {
        $list = [
            'chanel' => [],
            'filmList' => []
        ];
        $filmIdList = [];

        $date = $this->mysql()->real_escape_string($date);
        $chanelId = intval($chanelId);

        $query = "SELECT t1.`chanelId`, t1.`time`, t1.`name`, t1.`filmId`, t2.`name` as `chanel` FROM  
                  `tv_program` as `t1` JOIN
                  `tv_chanel` as `t2` ON t1.`chanelId` = t2.`id` 
                  WHERE t1.`date` = '{$date}' 
                  ";
        if (0 < $chanelId) {
            $query .= " AND t1.`chanelId` = {$chanelId} ";
        }
        $query .= " ORDER BY t2.`id`, t1.`time`";
        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            $hourCurrent = date('H');
            $minuteCurrent = date('i');
            $hour = explode(':', $row['time']);
            $minute = $hour[1];
            $hour = $hour[0];
            $past = '';
            if ($hourCurrent == $hour && $minuteCurrent > $minute) {
                $past = 'past-programm';
            } elseif ($hourCurrent > $hour) {
                $past = 'past-programm';
            }

            $row['time'] = rtrim($row['time'], '00');
            $row['time'] = rtrim($row['time'], ':');

            if (!isset($list['chanel'][$row['chanelId']])) {
                $list['chanel'][$row['chanelId']] = [
                    Chanel::NAME => $row['chanel'],
                    Chanel::LIST => []
                ];
            }
            $list['chanel'][$row['chanelId']][Chanel::LIST][] = [
                Program::TIME => $row['time'],
                Program::NAME => $row['name'],
                Program::PAST => $past,
                Program::FILM_ID => $row['filmId'],
            ];

            if (0 < $row['filmId'] && !in_array($row['filmId'], $filmIdList)) {
                $filmIdList[] = $row['filmId'];

                $name = '';
                $image = Server::STATIC[0] . '/app/img/content/nnb.jpg';
                $result2 = $this->mysql()->query("SELECT `s`, `image`, `name_origin`, `name_ru` FROM `film` WHERE `id` = {$row['filmId']} LIMIT 1");
                if ($row2 = $result2->fetch_assoc()) {
                    if ('' != $row2['image']) {
                        $imageName = md5($row['filmId']);
                        $image = Server::STATIC[$row2['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.274.206.' . $row2['image'];
                    }

                    $name = $row2['name_ru'];
                    if (empty($name)) {
                        $name = $row2['name_origin'];
                    }
                }
                $list['filmList'][] = [
                    Film::ID => $row['filmId'],
                    Film::NAME => $name,
                    Film::IMAGE => $image,
                    Film::TIME => $row['time'],
                    Film::CHANEL => $row['chanel'],
                ];
            }
        }

        return $list;
    }

    public function getAjax($date, $chanelId = 0)
    {
        $list = [];

        $date = $this->mysql()->real_escape_string($date);
        $chanelId = intval($chanelId);

        $query = "SELECT t1.`chanelId`, t1.`time`, t1.`name`, t1.`filmId`, t2.`name` as `chanel` FROM  
                  `tv_program` as `t1` JOIN
                  `tv_chanel` as `t2` ON t1.`chanelId` = t2.`id` 
                  WHERE t1.`date` = '{$date}' 
                  ";
        if (0 < $chanelId) {
            $query .= " AND t1.`chanelId` = {$chanelId} ";
        }

        $query .= " ORDER BY t2.`id`, t1.`time`";
        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            $hourCurrent = date('H');
            $minuteCurrent = date('i');
            $hour = explode(':', $row['time']);
            $minute = $hour[1];
            $hour = $hour[0];
            $past = '';
            if ($date == date('Y-m-d')) {
                if ($hourCurrent == $hour && $minuteCurrent > $minute) {
                    $past = 'past-programm';
                } elseif ($hourCurrent > $hour) {
                    $past = 'past-programm';
                }
            }

            $row['time'] = rtrim($row['time'], '00');
            $row['time'] = rtrim($row['time'], ':');

            if (!isset($list[$row['chanelId']])) {
                $list[$row['chanelId']] = [
                    Chanel::NAME => $row['chanel'],
                    Chanel::LIST => []
                ];
            }
            $list[$row['chanelId']][Chanel::LIST][] = [
                Program::TIME => $row['time'],
                Program::NAME => $row['name'],
                Program::PAST => $past,
                Program::FILM_ID => $row['filmId'],
            ];
        }

        return $list;
    }

    public function filmData($filmId)
    {
        $date = date('Y-m-d');
        $filmId = intval($filmId);
        
        $list = [];

        $query = "SELECT t1.`date`, t1.`time`, t2.`name` as `chanel` FROM  
                  `tv_program` as `t1` JOIN
                  `tv_chanel` as `t2` ON t1.`chanelId` = t2.`id` 
                  WHERE t1.`date` >= '{$date}' AND t1.`filmId` = {$filmId} ORDER BY  t1.`date`, t1.`time`
                  ";
        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            $dowMap = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
            $raw = $row['date'];
            $row['date'] = $this->formatDate($row['date']);
            $row['date'] = explode('&nbsp;', $row['date']);
            unset($row['date'][count($row['date']) - 1]);
            $row['date'] = implode('&nbsp;', $row['date']) . ', ' . $dowMap[date('w', strtotime($raw))];
            
            $row['time'] = rtrim($row['time'], '00');
            $row['time'] = rtrim($row['time'], ':');
            
            $list[] = [
                \Kinomania\Original\Key\Film\TV::CHANEL => $row['chanel'],
                \Kinomania\Original\Key\Film\TV::DATE => $row['date'],
                \Kinomania\Original\Key\Film\TV::TIME => $row['time'],
            ];
        }
        
        return $list;
    }

    public function personData($personId)
    {
        $date = date('Y-m-d');
        $personId = intval($personId);

        $list = [];

        $query = "SELECT t1.`date`, t1.`filmId`, t1.`time`, t2.`name` as `chanel` FROM  
                  `tv_program` as `t1` JOIN
                  `tv_chanel` as `t2` ON t1.`chanelId` = t2.`id` JOIN 
                  `tv_program_person` as `t3` ON t1.`id` = t3.`programId`
                  WHERE t1.`date` >= '{$date}' AND t3.`personId` = {$personId} ORDER BY t1.`date`, t1.`time`
                  ";
        $result = $this->mysql()->query($query);
        while ($row = $result->fetch_assoc()) {
            $dowMap = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
            $raw = $row['date'];
            $row['date'] = $this->formatDate($row['date']);
            $row['date'] = explode('&nbsp;', $row['date']);
            unset($row['date'][count($row['date']) - 1]);
            $row['date'] = implode('&nbsp;', $row['date']) . ', ' . $dowMap[date('w', strtotime($raw))];

            $row['time'] = rtrim($row['time'], '00');
            $row['time'] = rtrim($row['time'], ':');

            if (!isset($list[$row['filmId']])) {
                $name = '';
                $result2 = $this->mysql()->query("SELECT `name_origin`, `name_ru` FROM `film` WHERE `id` = {$row['filmId']}");
                if ($row2 = $result2->fetch_assoc()) {
                    $name = $row2['name_ru'];
                    if (empty($name)) {
                        $name = $row2['name_origin'];
                    }
                }
                $list[$row['filmId']] = [
                    \Kinomania\Original\Key\Person\TV::NAME => $name,
                    \Kinomania\Original\Key\Person\TV::LIST => []
                ];
            }
            $list[$row['filmId']][Chanel::LIST][] = [
                \Kinomania\Original\Key\Person\TV::CHANEL => $row['chanel'],
                \Kinomania\Original\Key\Person\TV::DATE => $row['date'],
                \Kinomania\Original\Key\Person\TV::TIME => $row['time'],
            ];
        }

        return $list;
    }
}