<?php
namespace Kinomania\System\Parser\Film;

use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class KPFilm
 * @package Kinomania\System\Parser\Film
 */
class KPFilm
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
            return $this->film;
        }

        $url = 'https://www.kinopoisk.ru/film/' . $kpId . '/';
	   
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
	        
            return $this->film;
        }
	
	    
        $data = $this->loadPage($url);
	    
	    
        if (!empty($this->error)) {
            return $this->film;
        }
        $data = str_replace('charset="windows-1251"', 'charset="UTF-8"', $data);

        /**
         * Start parsing.
         */
        $this->film['kpId'] = $kpId;
		
        /**
         * Name.
         */
        $name = explode('<h1 class="moviename-big" itemprop="name">', $data);
        $name = $name[1] ?? '';
        $name = explode('<', $name);
        $name = $name[0];
        if (false !== strpos($name, '(')) {
            $temp = explode('(', $name);
            $temp = $temp[1] ?? '';
            $temp = explode(')', $temp);
            $temp = $temp[0] ?? '';
            if (false !== stripos($temp, 'сериал')) {
                $this->film['type'] = 'series';
            }
        }
        $name = explode('(', $name);
        $name = trim($name[0] ?? '');
        $name = trim(preg_replace('/\s+/', ' ', $name));
        $name = str_replace('&nbsp;', ' ', $name);
        $name = trim($name);
        $name = trim($name, "\xC2\xA0");
        $name = trim($name, "\xC2\xA0\n");
        $this->film['ru_name'] = $name;

        $name = explode('<span itemprop="alternativeHeadline">', $data);
        $name = $name[1] ?? '';
        $name = explode('<', $name);
        $name = $name[0];
        $name = trim(preg_replace('/\s+/', ' ', $name));
        $name = str_replace('&nbsp;', ' ', $name);
        $name = trim($name);
        $name = trim($name, "\xC2\xA0");
        $name = trim($name, "\xC2\xA0\n");
        $this->film['original_name'] = $name;

        /**
         * Year.
         */
        $year = explode('/lists/m_act%5Byear%5D/', $data);
        $year = $year[1] ?? '';
        $year = explode('/', $year);
        $year = $year[0];
        $this->film['year'] = intval($year);

        if (0 < $this->film['year']) {
            $yearFinish = explode($this->film['year'] . '-', $data);
            $yearFinish = $yearFinish[1] ?? '';
            $yearFinish = explode(')', $yearFinish);
            $yearFinish = intval($yearFinish[0]);
            if ($yearFinish > $this->film['year']) {
                $this->film['yearFinish'] = $yearFinish;
            }
        }

        /**
         * Duration.
         */
        $duration = explode('id="runtime">', $data);
        $duration = $duration[1] ?? '';
        $duration = explode('<', $duration);
        $duration = $duration[0];
        $this->film['duration'] = intval($duration);

        /**
         * Rate.
         */
        $rate = explode('alt="рейтинг ', $data);
        $rate = $rate[1] ?? '';
        $rate = explode('"', $rate);
        $this->film['rate_mpaa'] = trim($rate[0]);

        $rate = explode('class="rating_ball">', $data);
        $rate = $rate[1] ?? '';
        $rate = explode('<', $rate);
        $this->film['rating_value'] = floatval($rate[0]);


        $rate = explode('itemprop="ratingCount">', $data);
        $rate = $rate[1] ?? '';
        $rate = explode('<', $rate);
        $this->film['rating_count'] = $rate[0];
        $this->film['rating_count'] = str_replace('&nbsp;', '', $this->film['rating_count']);
        $this->film['rating_count'] = intval($this->film['rating_count']);

        /**
         * Genre.
         */
        preg_match_all('|<a href="/lists/m_act%5Bgenre%5D/(.*)/">(.*)<|iU', $data, $match);
        if (isset($match[2])) {
            foreach ($match[2] as $genre) {
                $genre = trim($genre);
                if (!empty($genre)) {
                    $this->film['genre'][] = $genre;
                }
            }
        }

        /**
         * Country.
         */
        preg_match_all('|<a href="/lists/m_act%5Bcountry%5D/(.*)/">(.*)<|iU', $data, $match);
        if (isset($match[2])) {
            foreach ($match[2] as $country) {
                $country = trim($country);
                if (!empty($country)) {
                    $this->film['country'][] = $country;
                }
            }
        }

        /**
         * Image.
         */
        $this->film['image'] = 'https://st.kp.yandex.net/images/film_big/' . $this->film['kpId'] . '.jpg';

        /**
         * Budget.
         */
        $budget = explode('<a href="/film/278522/box/" title="">', $data);
        $budget = $budget[1] ?? '';
        $budget = explode('</a>', $budget);
        $budget = $budget[0];
        $budget = str_replace('&nbsp;', '', $budget);
        $budget = str_replace('$', '', $budget);
        $this->film['budget'] = intval($budget);

        /**
         * Release.
         */
        $release = explode('dateCreated" title="">', $data);
        $release = $release[1] ?? '';
        $release = explode('<', $release);
        $release = $release[0];
        $this->film['release_world'] = $release;

        preg_match_all('|title="" href="/premiere/ru/(.*)">(.*)<|iU', $data, $match);
        if (isset($match[2])) {
            $this->film['release_ru'] = $match[2][0] ?? '';
        }


        /**
         * Cast.
         */
        $url .= 'cast/';

        $data = $this->loadPage($url);
        if (!empty($this->error)) {
            return $this->film;
        }
        $data = str_replace('charset="windows-1251"', 'charset="UTF-8"', $data);

        /**
         * Cast.
         */
        $document = explode('<a name="actor">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];


                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $role = explode('<div class="role">', $info);
                $role = $role[1] ?? '';
                $role = explode('</div>', $role);
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

                $this->film['cast'][] = [$id, $name, $role, $nameOrigin, '', $voice, $uncredited, $self];
            }
        }

        /**
         * Crew.
         */
        $document = explode('<a name="director">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];

                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $this->film['crew']['Режиссер'][] = [$id, $name, $nameOrigin];
            }
        }

        $document = explode('<a name="writer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];

                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $this->film['crew']['Сценарист'][] = [$id, $name, $nameOrigin];
            }
        }

        $document = explode('<a name="producer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];

                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $this->film['crew']['Продюсер'][] = [$id, $name, $nameOrigin];
            }
        }

        $document = explode('<a name="composer">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];

                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $this->film['crew']['Композитор'][] = [$id, $name, $nameOrigin];
            }
        }

        $document = explode('<a name="operator">', $data);
        $document = $document[1] ?? '';
        $document = explode('<a name=', $document);
        $document = $document[0];
        if (!empty($document)) {
            preg_match_all('|<div class="actorInfo"(.*)<div class="clear">|isU', $document, $dubInfo);
            foreach ($dubInfo[1] as $info) {
                $id = explode(' href="/name/', $info);
                $id = $id[1] ?? '';
                $id = explode('/">', $id);
                $id = $id[0];

                $name = explode('"name"><a href="/name/' . $id . '/">', $info);
                $name = $name[1] ?? '';
                $name = explode('</a>', $name);
                $name = $name[0];

                $nameOrigin = explode('class="gray">', $info);
                $nameOrigin = $nameOrigin[1] ?? '';
                $nameOrigin = explode('</span>', $nameOrigin);
                $nameOrigin = $nameOrigin[0];

                $this->film['crew']['Оператор'][] = [$id, $name, $nameOrigin];
            }
        }

        return $this->film;
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
            return $this->film;
        }
        $data = mb_convert_encoding($data, "UTF-8", mb_detect_encoding($data));

        if (false !== strpos($data, 'вашего IP-адреса поступило необычно много запросов. Система защиты')) {
            $this->error = self::HTTP_ERROR;
            return $this->film;
        }

        return $data;
    }

    private function init()
    {
        $this->film = [
            'kpId' => 0,
            'episode' => false,
            'original_name' => '',
            'ru_name' => '',
            'year' => '',
            'yearFinish' => '',
            'type' => '',
            'duration' => '',
            'rate_mpaa' => '',
            'rating_value' => '',
            'rating_count' => '',
            'genre' => [],
            'country' => [],
            'productionStatus' => '',
            'countPhoto' => '',
            'countVideo' => '',
            'image' => '',
            'budget' => '',
            'release_world' => '',
            'release_usa' => '',
            'release_ru' => '',
            'crew' => [],
            'cast' => [],
        ];
    }

    private $film;
}