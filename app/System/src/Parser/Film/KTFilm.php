<?php
namespace Kinomania\System\Parser\Film;

use DiDom\Document;
use DiDom\Element;
use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class KTFilm
 * @package Kinomania\System\Parser\Film
 */
class KTFilm
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

    public function parseMain($ktId, $local = false)
    {
        $this->init();
        $this->error = '';

        $ktId = intval($ktId);

        if (1 > $ktId) {
            $this->error = self::BAD_ID;
            return $this->film;
        }

        $url = 'http://kino-teatr.ru/kino/movie/ros/' . $ktId . '/titr/';

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
        $document = new Document($data);

        $this->film['ktId'] = $ktId;

        /**
         * Cast.
         */
        foreach ($document->find('div[itemprop=actors]') as $wrap) {
            $voice = false;
            $max = 0;
            $sibling = $wrap->previousSibling();
            $skip = false;
            while (1) {
                $max++;
                if (null != $sibling && property_exists($sibling, 'getAttribute') && 'category_sub_header' == $sibling->getAttribute('class')) {
                    $text = $sibling->text();
                    if (false !== stripos($text, 'озвучивание')) {
                        $voice = true;
                    } elseif (false !== stripos($text, 'вокал')) {
                        $skip = true;
                    } elseif (false !== stripos($text, 'каскадеры')) {
                        $skip = true;
                    }
                    break;
                }
                if (500 == $max) {
                    break;
                }
                $sibling = $sibling->previousSibling();
                if (null == $sibling) {
                    break;
                }
            }
            if ($skip) {
                continue;
            }

            $id = 0;
            if ($wrap->has('a[itemprop=url]')) {
                $url = $wrap->find('a[itemprop=url]')[0]->getAttribute('href');
                $url = preg_replace('/\D/', '', $url);
                $id = intval($url);
            }

            $name = '';
            if ($wrap->has('strong[itemprop=name]')) {
                $name = $wrap->find('strong[itemprop=name]')[0]->text();
                $name = str_replace('&nbsp;', ' ', $name);
                $name = trim($name);
                $name = trim($name, "\xC2\xA0");
                $name = trim($name, "\xC2\xA0\n");
            }

            $character = '';
            $episode = false;
            $self = false;
            if ($wrap->has('div.film_role')) {
                $character = $wrap->find('div.film_role')[0]->text();
                $character = explode('—', $character);
                $character = $character[0];
                $character = str_replace('&nbsp;', ' ', $character);
                $character = trim($character);
                $character = trim($character, "\xC2\xA0");
                $character = trim($character, "\xC2\xA0\n");
            }
            if (false !== stripos($character, 'эпизод')) {
                $character = '';
                $episode = true;
            } else {
                if (false !== stripos($character, 'себя')) {
                    $character = '';
                    $self = true;
                }
            }

            $year = '';

            $uncredited = false;
            if ($wrap->has('div.film_role_descript')) {
                $text = $wrap->find('div.film_role_descript')[0]->text();
                if (false !== stripos($text, '(нет в титрах)')) {
                    $uncredited = true;
                }
            }

            $this->film['cast'][] = [$id, $name, $character, $episode, $year, $voice, $uncredited, $self];
        }


        $url = 'http://kino-teatr.ru/kino/movie/ros/' . $ktId . '/annot/';

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->film;
        }

        $data = $this->loadPage($url);
        $data = str_replace('charset="windows-1251"', 'charset="UTF-8"', $data);

        /**
         * Start parsing.
         */
        $document = new Document($data);

        /**
         * Crew.
         */
        foreach ($document->find('.film_persons_block') as $wrap) {
            $type = $wrap->find('.film_persons_type')[0]->text();
            if (false !== stripos($type, 'Режиссер')) {
                $this->addCrew($wrap, 'Режиссер');
            } else if (false !== stripos($type, 'Сценарист')) {
                $this->addCrew($wrap, 'Сценарист');
            } else if (false !== stripos($type, 'Продюсер')) {
                $this->addCrew($wrap, 'Продюсер');
            } else if (false !== stripos($type, 'Композитор')) {
                $this->addCrew($wrap, 'Композитор');
            } else if (false !== stripos($type, 'Оператор')) {
                $this->addCrew($wrap, 'Оператор');
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
        return $data;
    }

    private function addCrew(Element $wrap, $type)
    {
        foreach ($wrap->find('span[itemprop=name]') as $person) {
            $name = $person->text();
            $name = str_replace('&nbsp;', ' ', $name);
            $name = trim($name);
            $name = trim($name, "\xC2\xA0");
            $name = trim($name, "\xC2\xA0\n");

            $id = 0;
            if ($person->parent()->has('a[itemprop=url]')) {
                $url = $person->parent()->find('a[itemprop=url]')[0]->getAttribute('href');
                $url = preg_replace('/\D/', '', $url);
                $id = intval($url);
            }

            $item = [$id, $name, ''];
            $this->film['crew'][$type][] = $item;
        }
    }

    private function init()
    {
        $this->film = [
            'ktId' => 0,
            'crew' => [],
            'cast' => [],
        ];
    }

    private $film;
}