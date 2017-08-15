<?php
namespace Kinomania\Original\Logic\Company;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Key\Company\Film;
use Kinomania\Original\Key\Company\Person;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

/**
 * Class Company
 * @package Kinomania\Original\Company
 */
class Company
{
    use TRepository;
    use TDate;
    
    public function get($companyId)
    {
        $item = [];
        
        $companyId = intval($companyId);
        $result = $this->mysql()->query("SELECT `s`, `image`, `status`, `type`, `name`, `short_name`, `site`, `phone`, `fax`, `text` FROM `company` WHERE `id` = {$companyId} LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            if (Wrap::$debugEnabled || 'hide' != $row['status']) {
                $item[\Kinomania\Original\Key\Company\Company::S] = $row['s'];
                $item[\Kinomania\Original\Key\Company\Company::IMAGE] = $row['image'];
                $item[\Kinomania\Original\Key\Company\Company::TYPE] = $row['type'];
                $item[\Kinomania\Original\Key\Company\Company::NAME] = $row['name'];
                $item[\Kinomania\Original\Key\Company\Company::SHORT_NAME] = $row['short_name'];
                $item[\Kinomania\Original\Key\Company\Company::SITE] = $row['site'];
                $item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY] = [];

                /**
                 * Text.
                 */
                $this->text($item, $row);

                /**
                 * Image.
                 */
                if ('' != $item[\Kinomania\Original\Key\Company\Company::IMAGE]) {
                    $imageName = md5($companyId);
                    $item[\Kinomania\Original\Key\Company\Company::IMAGE] = Server::STATIC[$item[\Kinomania\Original\Key\Company\Company::S]] . Path::COMPANY . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[\Kinomania\Original\Key\Company\Company::IMAGE];
                } else {
                    $item[\Kinomania\Original\Key\Company\Company::IMAGE] = Server::STATIC[0] . '/app/img/content/nni.jpg';
                }

                /**
                 * Filmography.
                 */
                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                $key = 'company:' . $companyId . ':list';
                if (!Wrap::$debugEnabled && $redisStatus && $redis->exists($key)) {
                    $item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY] = unserialize($redis->get($key));
                } else {
                    if ('Кастинг-агентство' == $item[\Kinomania\Original\Key\Company\Company::TYPE]) {
                        $item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY] = $this->person($companyId);
                    } else {
                        $item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY] = $this->filmography($companyId);
                    }
                    if (!Wrap::$debugEnabled && [] != $item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY] && $redisStatus) {
                        $redis->set($key, serialize($item[\Kinomania\Original\Key\Company\Company::FILMOGRAPHY]), 10800); // 3 hours
                    }
                }
            }
        }
        
        return $item;
    }

    /**
     * @param $companyId
     * @return array
     */
    private function filmography($companyId)
    {
        $list = [];

        $result = $this->mysql()->query("SELECT t1.`filmId`, t1.`type`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`year`, t3.`rate`, t3.`rate_count` 
                                         FROM (SELECT `id` FROM `film_company_rel` WHERE `companyId` = {$companyId} ORDER BY `type` DESC) as `t` 
                                         JOIN `film_company_rel` as `t1` ON t1.`id` = t.`id`
                                         JOIN `film` as `t2` ON t1.`filmId` = t2.`id`
                                         LEFT JOIN `film_stat` as `t3` ON t1.`filmId` = t3.`filmId`
                                         WHERE t2.`status` = 'show' ORDER BY t1.`type`, t2.`year` DESC");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nof.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['filmId']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.44.63.' . $row['image'];
            }

            $item = [];
            $item[Film::ID] = $row['filmId'];
            $item[Film::IMAGE] = $image;
            $item[Film::NAME_ORIGIN] = $row['name_origin'];
            $item[Film::NAME_RU] = $row['name_ru'];
            $item[Film::YEAR] = $row['year'];
            if (10 > $row['rate_count']) {
                $row['rate'] = 0;
            }
            $item[Film::RATE] = $row['rate'];

            $list[$row['type']][] = $item;
        }

        return $list;
    }

    /**
     * @param int $castingId
     * @return array
     */
    private function person($castingId)
    {
        $list = [];

        $castingId = intval($castingId);

        $result = $this->mysql()->query("SELECT t2.`id`, t2.`s`, t2.`image`, t2.`name_origin`, t2.`name_ru`, t2.`birthday` 
                                        FROM (SELECT `id` FROM `person_casting` WHERE `castingId` = {$castingId}) as `t`
                                        JOIN `person_casting` as `t1` ON t1.`id` = t.`id`
                                        JOIN `person` as `t2` ON t1.`personId` = t2.`id`
                                        WHERE t2.`status` = 'show' ORDER BY t2.`weight` DESC
                                        ");
        while ($row = $result->fetch_assoc()) {
            $image = Server::STATIC[0] . '/app/img/content/nop.jpg';
            if ('' != $row['image']) {
                $imageName = md5($row['id']);
                $image = Server::STATIC[$row['s']] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.88.116.' . $row['image'];
            }

            if (5 > mb_strlen($row['name_origin'], 'UTF-8')) {
                $row['name_origin'] = '';
            }

            $item = [];
            $item[Person::ID] = $row['id'];
            $item[Person::IMAGE] = $image;
            $item[Person::NAME_ORIGIN] = $row['name_origin'];
            $item[Person::NAME_RU] = $row['name_ru'];
            $item[Person::BIRTHDAY] = $this->formatDate($row['birthday']);

            $list[] = $item;
        }

        return $list;
    }

    /**
     * @param $item
     * @param $row
     * @return array
     */
    private function text(&$item, &$row)
    {
        $text = strip_tags($row['text']);
        $more = mb_strlen($text, 'UTF-8');
        if (!empty($row['phone'])) {
            $row['text'] = '<p>Телефон: ' . $row['phone'] . '</p>' . $row['text'];
            $text = '_';
        }
        if (!empty($row['fax'])) {
            $row['text'] = '<p>Факс: ' . $row['fax'] . '</p>' . $row['text'];
            $text = '_';
        }
        if ($more > 790) {
            $more = true;
        } else {
            if (empty($text)) {
                $row['text'] = 'Информация о компании отсутствует';
            }
            $more = false;
        }

        $item[\Kinomania\Original\Key\Company\Company::TEXT_MORE] = $more;
        $item[\Kinomania\Original\Key\Company\Company::TEXT] = $row['text'];
        
        return $item;
    }
}