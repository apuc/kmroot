<?php
namespace Kinomania\System\Parser\Person;

use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class KPPerson
 * @package Kinomania\System\Parser\Person
 */
class KPPerson
{
    use TText;
    use TError;

    const URL_ERROR = 'URL_ERROR';
    const BAD_ID = 'BAD_ID';
    const HTTP_ERROR = 'HTTP_ERROR';
    const DOM_ERROR = 'DOM_ERROR';

    public function __construct()
    {
        $this->init();
    }

    public function parseMain($kpId, $local = false)
    {
        $this->init();
        $this->error = '';

        $kpId = intval($kpId);

        if (1 > $kpId) {
            $this->error = self::BAD_ID;
            return $this->person;
        }

        $url = 'https://www.kinopoisk.ru/name/' . $kpId . '/';

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->person;
        }
        
        $data = $this->loadPage($url);
        if (!empty($this->error)) {
            return $this->person;
        }
        $data = str_replace('charset="windows-1251"', 'charset="UTF-8"', $data);

        /**
         * Start parsing.
         */
        $this->person['kpId'] = $kpId;

        /**
         * Name.
         */
        $name = explode('<h1 class="moviename-big" itemprop="name">', $data);
        $name = $name[1] ?? '';
        $name = explode('<', $name);
        $name = $name[0];
        $name = trim(preg_replace('/\s+/', ' ', $name));
        $this->person['name_ru'] = $name;

        $name = explode('<span itemprop="alternateName">', $data);
        $name = $name[1] ?? '';
        $name = explode('<', $name);
        $name = $name[0];
        $name = trim(preg_replace('/\s+/', ' ', $name));
        $this->person['name_original'] = $name;

        /**
         * Sex.
         */
        $sex = explode('<meta itemprop="gender" content="', $data);
        $sex = $sex[1] ?? '';
        $sex = explode('"', $sex);
        $this->person['sex'] = $sex[0];

        /**
         * Date.
         */
        $date = explode('<meta itemprop="birthDate" content="', $data);
        $date = $date[1] ?? '';
        $date = explode('"', $date);
        $this->person['born'] = $date[0];

        $date = explode('<meta itemprop="deathDate" content="', $data);
        $date = $date[1] ?? '';
        $date = explode('"', $date);
        $this->person['die'] = $date[0];

        /**
         * Location.
         */
        $place = explode('место рождения</td>', $data);
        $place = $place[1] ?? '';
        $place = explode('</span>', $place);
        $this->person['place'] = trim(strip_tags($place[0]));

        /**
         * Image.
         */
        $this->person['image'] = 'https://st.kp.yandex.net/images/actor_iphone/iphone360_' . $this->person['kpId'] . '.jpg';

        /**
         * Height.
         */
        $height = explode('рост</td><td ><span>', $data);
        $height = $height[1] ?? '';
        $height = explode('м', $height);
        $height = str_replace('.', '', $height[0]);
        $this->person['height'] = trim($height);

        /**
         * Cast.
         */
        $document = explode('<div class="personPageItems" data-work-type="actor">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }

                $voice = false;
                if (false !== stripos($role, 'озвучка')) {
                    $voice = true;
                }

                $self = false;
                if (false !== stripos($role, 'играет самого себя')) {
                    $self = true;
                }

                $role = explode(',', $role);
                $role = trim($role[0]);
                if ($self) {
                    $role = '';
                }

                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';
                $role = $role[1] ?? '';
                $role = trim($role);

                $this->person['Actor'][] = [$year, $nameOrigin, $id, $name, $role, $voice, $uncredited, $self, '', ''];
            }
        }

        /**
         * Crew.
         */
        $document = explode('<div class="personPageItems" data-work-type="director">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $name = str_replace('&nbsp;', ' ', $name);
                $name = trim($name);
                $name = trim($name, "\xC2\xA0");
                $name = trim($name, "\xC2\xA0\n");
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }
                
                $role = explode(',', $role);
                $role = trim($role[0]);
                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';
                $nameOrigin = str_replace('&nbsp;', ' ', $nameOrigin);
                $nameOrigin = trim($nameOrigin);
                $nameOrigin = trim($nameOrigin, "\xC2\xA0");
                $nameOrigin = trim($nameOrigin, "\xC2\xA0\n");

                $this->person['crew']['Режиссер'] = [$year, $nameOrigin, $id, $name, $uncredited];
            }
        }
        
        $document = explode('<div class="personPageItems" data-work-type="writer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $name = str_replace('&nbsp;', ' ', $name);
                $name = trim($name);
                $name = trim($name, "\xC2\xA0");
                $name = trim($name, "\xC2\xA0\n");
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }
                
                $role = explode(',', $role);
                $role = trim($role[0]);
                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';
                $nameOrigin = str_replace('&nbsp;', ' ', $nameOrigin);
                $nameOrigin = trim($nameOrigin);
                $nameOrigin = trim($nameOrigin, "\xC2\xA0");
                $nameOrigin = trim($nameOrigin, "\xC2\xA0\n");

                $this->person['crew']['Сценарист'] = [$year, $nameOrigin, $id, $name, $uncredited];
            }
        }
        
        $document = explode('<div class="personPageItems" data-work-type="producer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }
                
                $role = explode(',', $role);
                $role = trim($role[0]);
                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';

                $this->person['crew']['Продюсер'] = [$year, $nameOrigin, $id, $name, $uncredited];
            }
        }
        
        $document = explode('<div class="personPageItems" data-work-type="composer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }
                
                $role = explode(',', $role);
                $role = trim($role[0]);
                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';

                $this->person['crew']['Композитор'] = [$year, $nameOrigin, $id, $name, $uncredited];
            }
        }
        
        $document = explode('<div class="personPageItems" data-work-type="operator">', $data);
        $document = $document[1] ?? '';
        $document = explode('<div class="personPageItems" data-work-type="', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<table>(.*)</table>|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $info = str_replace('&nbsp;', ' ', $info);
                $id = explode(' href="/film/', $info);
                $id = $id[1] ?? '';
                $id = explode('/', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/film/' . $id . '/', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];
                $name = explode('>', $name);
                $name = $name[1] ?? '';
                $name = explode('(', $name);
                $year = $name[1] ?? '';
                $name = $name[0];
                $year = explode(')', $year);
                $year = intval($year[0]);


                $role = explode('<span class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</span>', $role);
                $role = $role[0];

                $role = ltrim($role, '.');
                $role = trim($role);

                $uncredited = false;
                if (false !== stripos($role, 'в титрах не указан')) {
                    $uncredited = true;
                }
                
                $role = explode(',', $role);
                $role = trim($role[0]);
                $role = explode('...', $role);
                $nameOrigin = $role[0] ?? '';

                $this->person['crew']['Оператор'] = [$year, $nameOrigin, $id, $name, $uncredited];
            }
        }

        return $this->person;
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
            return $this->person;
        }
        $data = mb_convert_encoding($data, "UTF-8", mb_detect_encoding($data));

        if (false !== strpos($data, 'вашего IP-адреса поступило необычно много запросов. Система защиты')) {
            $this->error = self::HTTP_ERROR;
            return $this->person;
        }

        return $data;
    }

    private function init()
    {
        $this->person = [
            'kpId' => 0,
            'name_original' => '',
            'name_ru' => '',
            'sex' => '',
            'born' => '',
            'die' => '',
            'place' => '',
            'countPhoto' => '',
            'countVideo' => '',
            'image' => '',
            'officialPhoto' => '',
            'Actor' => [],
            'crew' => [
                'Режиссер' => [],
                'Сценарист' => [],
                'Продюсер' => [],
                'Оператор' => [],
                'Композитор' => [],
            ],
            'height' => '',
        ];
    }

    private $person;
}