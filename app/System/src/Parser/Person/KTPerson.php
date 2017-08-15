<?php
namespace Kinomania\System\Parser\Person;

use DiDom\Document;
use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class KTPerson
 * @package Kinomania\System\Parser\Person
 */
class KTPerson
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
            return $this->person;
        }

        $url = 'http://kino-teatr.ru/kino/acter/' . $ktId . '/works/';

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
        $document = new Document($data);

        $this->person['ktId'] = $ktId;
        foreach ($document->find('.film_block') as $wrap) {
            $self = false;
            $characterVoice = false;

            $category = '';
            $sibling = $wrap->previousSibling();
            while (1) {
                if (is_object($sibling) && !property_exists($sibling, 'getAttribute')) {
                    $sibling = $sibling->previousSibling();
                    if (null == $sibling) {
                        break;
                    }
                }
                if ('category_sub_header' == $sibling->getAttribute('class')) {
                    $text = $sibling->text();
                    if (false !== stripos($text, 'роли в кино') || false !== stripos($text, 'участие в фильмах') || false !== stripos($text, 'озвучивание')) {
                        if (false !== stripos($text, 'участие в фильмах')) {
                            $self = true;
                        } elseif (false !== stripos($text, 'участие в фильмах')) {
                            $characterVoice = true;
                        }
                        $category = 'Actor';
                    } elseif (false !== stripos($text, 'Режиссер')) {
                        $category = 'Режиссер';
                    } elseif (false !== stripos($text, 'Сценарист')) {
                        $category = 'Сценарист';
                    } elseif (false !== stripos($text, 'Продюсер')) {
                        $category = 'Продюсер';
                    } elseif (false !== stripos($text, 'Оператор')) {
                        $category = 'Оператор';
                    } elseif (false !== stripos($text, 'Композитор')) {
                        $category = 'Композитор';
                    }
                    break;
                }
                if (null == $sibling) {
                    break;
                }
                $sibling = $sibling->previousSibling();
            }
            if (empty($category)) {
                continue;
            }

            $film = [
                'year' => '',
                'productionStatus' => '',
                'id' => '',
                'english_name' => '',
                'ru_name' => '',
                'characterName' => '',
                'characterVoice' => $characterVoice,
                'characterUncredited' => '',
                'self' => $self,
                'countOfEpisodes' => 0,
                'type' => ''
            ];

            /**
             * Id.
             */
            if ($wrap->has('div.film_name')) {
                if ($wrap->has('div.film_name a')) {
                    $a = $wrap->find('div.film_name a')[0];
                    if ($a->hasAttribute('href')) {
                        $id = $a->getAttribute('href');
                        $id = explode('/tt', $id)[1] ?? '';
                        $film['id'] = explode('/', $id)[0];
                    }
                }

                $name = trim($wrap->find('div.film_name')[0]->text());
                $name = explode('|', $name);
                $film['ru_name'] = $name[0] ?? '';
                $film['english_name'] = $name[1] ?? '';

                $film['english_name'] = explode('(', $film['english_name']);
                $film['english_name'] =  $film['english_name'][0];

                $film['english_name'] = explode(',', $film['english_name']);
                $film['english_name'] =  $film['english_name'][0];

                $film['ru_name'] = trim($film['ru_name']);
                $film['english_name'] = trim($film['english_name']);
            }
            

            $character = '';
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
                $film['countOfEpisodes'] = 1;
            } else {
                if (false !== stripos($character, 'себя')) {
                    $character = '';
                    $film['self'] = true;
                }
            }
            $film['characterName'] = $character;
            

            $uncredited = false;
            if ($wrap->has('div.film_role_descript')) {
                $text = $wrap->find('div.film_role_descript')[0]->text();
                if (false !== stripos($text, '(нет в титрах)')) {
                    $uncredited = true;
                }
            }
            $film['characterUncredited'] = $uncredited;

            /**
             * Add work to the list.
             */
            switch ($category) {
                case 'Actor':
                    $this->person['Actor'][] = $film;
                    break;
                case 'Режиссер':
                    $this->person['crew']['Режиссер'][] = $film;
                    break;
                case 'Сценарист':
                    $this->person['crew']['Сценарист'][] = $film;
                    break;
                case 'Продюсер':
                    $this->person['crew']['Продюсер'][] = $film;
                    break;
                case 'Оператор':
                    $this->person['crew']['Оператор'][] = $film;
                    break;
                case 'Композитор':
                    $this->person['crew']['Композитор'][] = $film;
                    break;
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
        return $data;
    }

    private function init()
    {
        $this->person = [
            'ktId' => 0,
            'Actor' => [],
            'crew' => [
                'Режиссер' => [],
                'Сценарист' => [],
                'Продюсер' => [],
                'Оператор' => [],
                'Композитор' => [],
            ]
        ];
    }

    private $person;
}