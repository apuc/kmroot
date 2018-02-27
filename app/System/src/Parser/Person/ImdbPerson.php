<?php
namespace Kinomania\System\Parser\Person;

use DiDom\Document;
use Kinomania\System\Common\TError;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class ImdbPerson
 * @package Kinomania\System\Parser\Person
 */
class ImdbPerson
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

    public function parseMain($imdbId, $local = false)
    {
        $this->init();
        $this->error = '';
	   
        $imdbId = $this->getClearPersonId($imdbId);

        if (1 > $imdbId) {
            $this->error = self::BAD_ID;
            return $this->person;
        }

        $url = 'http://www.imdb.com/name/nm' . $imdbId . '/';

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->person;
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
                $data = $this->loadPage($url);
                $fh = fopen($path, 'wb');
                fwrite($fh, $data);
                fclose($fh);
            }
        } else {
            $data = $this->loadPage($url);
            if (!empty($this->error)) {
                return $this->film;
            }
        }

        /**
         * Start parsing.
         */
        $document = new Document($data);
        $overviewTop = $document->find('#overview-top')[0];

        /**
         * Original name.
         */
        $this->person['name_original'] = $overviewTop->find('.header')[0]->text();
        $this->person['name_original'] = trim(explode('(', $this->person['name_original'])[0]);

        if (empty($this->person['name_original'])) {
            $this->error = self::DOM_ERROR;
            return $this->person;
        }

        $this->person['imdbId'] = $imdbId;

        /**
         * Sex.
         */
        $this->person['sex'] = '';
        if ($overviewTop->has('.infobar')) {
            foreach ($overviewTop->find('a::attr(href)') as $href) {
                if (false !== stripos($href, 'actor')) {
                    $this->person['sex'] = 'male';
                    break;
                } else if (false !== stripos($href, 'actress')) {
                    $this->person['sex'] = 'female';
                    break;
                }
            }
        }

        /**
         * Dates and place.
         */
        $this->person['born'] = '';
        foreach ($overviewTop->find('.txt-block') as $text) {
            if ($text->has('h4')) {
                $content = $text->find('h4')[0]->text();
                if (false !== strpos($content, 'Born')) {
                    if ($text->has('time')) {
                        $date = \DateTime::createFromFormat('F d, Y', trim(preg_replace('/\s+/', ' ', $text->find('time')[0]->text())));
                        if (false === $date) {

                        } else {
                            $this->person['born'] = $date->format('Y-m-d');
                        }
                    }
                } elseif (false !== strpos($content, 'Died')) {
                    if ($text->has('time')) {
                        $date = \DateTime::createFromFormat('F d, Y', trim(preg_replace('/\s+/', ' ', $text->find('time')[0]->text())));
                        if (false === $date) {

                        } else {
                            $this->person['die'] = $date->format('Y-m-d');
                        }
                    }
                }
            }
            foreach ($text->find('a') as $a) {
                $href = $a->getAttribute('href');
                if (false !== strpos($href, 'birth_place')) {
                    $this->person['place'] = $a->text();
                    break;
                }
            }
        }

        /**
         * Count photo and video.
         */
        if ($document->has('.mediastrip_container')) {
            $container = $document->find('.mediastrip_container')[0];
            foreach ($container->find('a') as $a) {
                $href = $a->getAttribute('href');
                if (false !== stripos($href, 'mediaindex')) {
                    $text = $a->text();
                    if (!empty($text)) {
                        $this->person['countPhoto'] = intval(preg_replace('/^([^0-9]*)$/', '', $text));
                    }
                }
                if (false !== stripos($href, 'videogallery')) {
                    $text = $a->text();
                    if (!empty($text)) {
                        $this->person['countVideo'] = intval(preg_replace('/^([^0-9]*)$/', '', $text));
                    }
                }
            }
        }

        /**
         * Image.
         */
        if ($document->has('*[itemprop=image]')) {
            $image = $document->find('*[itemprop=image]')[0];
            $this->person['image'] = $image->getAttribute('src');
        }

        if ($document->has('a[href*=resumephotos]')) {
            $this->person['officialPhoto'] = true;
        }

        /**
         * Films.
         */
        if ($document->has('#filmography')) {
            foreach ($document->find('#filmography')[0]->find('.head') as $role) {
                $category = $role->getAttribute('data-category');

                foreach ($document->xpath('//div[@id="filmography"]//div[@data-category="' . $category . '"]/following::div')[0]->find('.filmo-row') as $row) {
                    $film = [
                        'year' => '',
                        'productionStatus' => '',
                        'id' => '',
                        'english_name' => '',
                        'characterName' => '',
                        'characterVoice' => '',
                        'characterUncredited' => '',
                        'self' => '',
                        'countOfEpisodes' => 0,
                        'type' => ''
                    ];

                    /**
                     * Year.
                     */
                    $year = trim($row->find('.year_column')[0]->text());
                    $year = str_replace('&nbsp;', ' ', $year);
                    $year = trim($year);
                    $year = trim($year, "\xC2\xA0");
                    $year = trim($year, "\xC2\xA0\n");
                    $film['year'] = $year;

                    /**
                     * Production status.
                     */
                    if ($row->has('a[class=in_production]')) {
                        $film['productionStatus'] = trim($row->find('a[class=in_production]')[0]->text());
                    }

                    /**
                     * Imdb id.
                     */
                    if ($row->has('a[href*=/title/tt]')) {
                        $a = $row->find('a[href*=/title/tt]')[0];
                        $id = $a->getAttribute('href');
                        $id = explode('/tt', $id)[1] ?? '';
                        $film['id'] = explode('/', $id)[0];
                        $film['english_name'] = trim($a->text());

                    }

                    /**
                     *  Character.
                     */
                    if ($row->has('a[href*=/title/tt]')) {
                        $html = $row->innerHtml();
                        $character = explode('<br>', $html)[1] ?? '';
                        $character = trim(preg_replace('/\s+/', ' ', strip_tags(explode('<div', $character)[0])));

                        if (false !== stripos($character, 'himself') || false !== stripos($character, 'herself')) {
                            $film['self'] = true;
                        } else {
                            $film['characterName'] = explode('(', $character)[0];
                        }

                        if (false !== stripos($character, 'voice')) {
                            $film['characterVoice'] = true;
                        }
                        if (false !== stripos($character, 'uncredited')) {
                            $film['characterUncredited'] = true;
                        }
                    }

                    /**
                     * Count episodes.
                     */
                    $cnt = 0;
                    foreach ($row->find('.filmo-episodes') as $episode) {
                        if ($episode->has('a[data-n]')) {
                            $film['countOfEpisodes'] = intval($episode->find('a[data-n]')[0]->getAttribute('data-n'));
                        }
                        $cnt++;
                    }
                    if (0 == $film['countOfEpisodes']) {
                        $film['countOfEpisodes'] = $cnt;
                    }

                    /**
                     * Video type.
                     */
                    $html = $row->innerHtml();
                    $type = explode('<br', $html)[0];
                    $type = explode('</a>', $type)[1] ?? '';
                    $type = explode(')', $type)[0];
                    $type = explode('(', $type)[1] ?? '';
                    if (false === stripos($type, 'class="in_production"')) {
                        $film['type'] = trim(preg_replace('/\s+/', ' ', strip_tags($type)));
                    }

                    /**
                     * Add work to the list.
                     */
                    if (false !== stripos($category, 'actor') || false !== stripos($category, 'actress') ) {
                        if ('' == $this->person['sex']) {
                            if (false !== stripos($category, 'actor')) {
                                $this->person['sex'] = 'male';
                            } else if (false !== stripos($category, 'actress')) {
                                $this->person['sex'] = 'female';
                            }
                        }
                        $this->person['Actor'][] = $film;
                    } else if (false !== stripos($category, 'director')) {
                        $this->person['crew']['Режиссер'][] = $film;
                    } else if (false !== stripos($category, 'writer')) {
                        $this->person['crew']['Сценарист'][] = $film;
                    } else if (false !== stripos($category, 'producer')) {
                        $this->person['crew']['Продюсер'][] = $film;
                    } else if (false !== stripos($category, 'cinematographer')) {
                        $this->person['crew']['Оператор'][] = $film;
                    } else if (false !== stripos($category, 'composer')) {
                        $this->person['crew']['Композитор'][] = $film;
                    }

                    /**
                     * Height
                     */
                    if ($document->has('#details-height')) {
                        $html = $document->find('#details-height')[0]->text();
                        $html = explode('(', $html)[1] ?? '';
                        $html = explode(')', $html)[0];
                        $html = trim(str_replace('m', '', $html));
                        $html = str_replace(',', '.', $html);
                        $this->person['height'] = intval(floatval($html) * 100);
                    }
                }
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
        return $data;
    }

    /**
     * Get integer ID.
     * @param $imdbId
     * @return int
     */
    public function getClearPersonId($imdbId)
    {
        if (!filter_var($imdbId, FILTER_VALIDATE_URL) === false) {
            $imdbId = explode('nm', $imdbId)[1] ?? '';
            $imdbId = explode('/', $imdbId)[0];
        } else {
            $imdbId = str_replace('nm', '', $imdbId);
        }
        return intval($imdbId);
    }

    private function init()
    {
        $this->person = [
            'imdbId' => 0,
            'name_original' => '',
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