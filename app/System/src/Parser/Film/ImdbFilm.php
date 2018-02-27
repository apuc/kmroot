<?php
namespace Kinomania\System\Parser\Film;

use DiDom\Document;
use DiDom\Element;
use Kinomania\System\Common\TError;
use Kinomania\System\Debug\Debug;
use Kinomania\System\Parser\Curl\Curl;
use Kinomania\System\Text\TText;

/**
 * Class ImdbFilm
 * @package Kinomania\System\Parser\Film
 */
class ImdbFilm
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
        
	    $imdbIdStr = $this->getClearFilmIdCustom($imdbId);
        $imdbId = $this->getClearFilmId($imdbId);
        
        
        
        if (1 > $imdbId) {
            $this->error = self::BAD_ID;
            return $this->film;
        }

        $url = 'http://www.imdb.com/title/tt' . $imdbIdStr . '/';
	   
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->film;
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

        $divInfo = $document->find('#title-overview-widget')[0];

        if ($document->has('.np_episode_guide') && $document->find('.np_episode_guide')[0]->has('.bp_sub_heading')) {
            $episode = $document->find('.np_episode_guide')[0]->find('.bp_sub_heading')[0]->text();
            $episode = explode(' ', $episode);
            $episode = intval($episode[0]);
            $this->film['episode'] = $episode;
        }

        /**
         * Title.
         */
        $header = $divInfo->find('.title_wrapper')[0];
        if ($header->has('.originalTitle')) {
            $original_name = $header->find('.originalTitle')[0]->text();
            $original_name = explode('(', $original_name)[0];
            $original_name = trim(preg_replace('/\s+/', ' ', $original_name));
            $this->film['original_name'] = $original_name;
        }

        if ($header->has('h1[itemprop=name]')) {
            $ru_name = $header->find('h1[itemprop=name]')[0]->text();
            $ru_name = explode('(', $ru_name)[0];
            $ru_name = trim(preg_replace('/\s+/', ' ', $ru_name));
            if (empty($this->film['original_name'])) {
                $this->film['original_name'] = $ru_name;
            } else {
                $this->film['ru_name'] = $ru_name;
            }
        }

        /**
         * Year.
         */
        if ($header->has('#titleYear')) {
            $year = $header->find('#titleYear')[0]->text();
            $year = str_replace(['(', ')'], '', $year);
            $year = trim(preg_replace('/\s+/', ' ', $year));
            $this->film['year'] = intval($year);
        }
	    
        /**
         * Type.
         */
        $subText = $divInfo->find('.subtext')[0];
        if ($subText->has('a[title=See more release dates]')) {
            $text = $subText->find('a[title=See more release dates]')[0]->text();
            if (false !== stripos($text, 'mini-series')) {
                $type = 'TV_MINI_SERIES';
            } else if (false !== stripos($text, 'series')) {
                $type = 'TV_SERIES';
            } else if (false !== stripos($text, 'special')) {
                $type = 'TV_SPECIAL';
            } else if (false !== stripos($text, 'episode')) {
                $type = 'TV_EPISODE';
            } else if (false !== stripos($text, 'game')) {
                $type = 'VIDEO_GAME';
            } else if (false !== stripos($text, 'video')) {
                $type = 'VIDEO';
            } else if (false !== stripos($text, 'tv')) {
                $type = 'TV_MOVIE';
            } else if (false !== stripos($text, 'v')) {
                $type = 'VIDEO';
            } else {
                $type = '';
            }
            $this->film['type'] = $type;

            /**
             * Year finish.
             */
            if (false !== strpos($text, '(')) {
                $inner = explode('(', $text)[1] ?? '';
                $inner = explode(')', $inner)[0];
                $inner = explode('–', $inner);
                if (isset($inner[1])) {
                    $this->film['year'] = intval($inner[0]);
                    $this->film['yearFinish'] = intval($inner[1]);
                } else {
                    if (empty($this->film['year'])) {
                        $this->film['year'] = intval($inner[0]);
                    }
                }
            }
        }

        /**
         * Year once more.
         */
        if (empty($this->film['year'])) {
            if (isset($document->find('meta[itemprop=datePublished]')[0])) {
                $year = $document->find('meta[itemprop=datePublished]')[0]->getAttribute('content');
                $year = explode('-', $year);
                $this->film['year'] = $year;
            }
        }

        /**
         * Duration.
         */
        if ($subText->has('time[itemprop=duration]')) {
            $text = $subText->find('time[itemprop=duration]')[0]->text();

            $duration = 0;

            if (false !== strpos($text, 'h')) {
                $hour = explode('h', $text);
                $duration = $hour[0] * 60;
                $text = $hour[1];
            }

            $text = str_replace('min', '', $text);
            $text = trim($text);
            $duration += intval($text);

            $this->film['duration'] = $duration;
        }

        /**
         * MPAA.
         */
        if ($subText->has('meta[itemprop=contentRating]')) {
            $this->film['rate_mpaa'] = $subText->find('meta[itemprop=contentRating]')[0]->getAttribute('content');
        }

        /**
         * Rate.
         */
        if ($divInfo->has('.ratingValue')) {
            $text = $divInfo->find('.ratingValue')[0]->find('strong')[0]->getAttribute('title');
            $text = explode('based on', $text);
            $this->film['rating_value'] = floatval(str_replace(',', '.', $text[0]));
            $text = explode(' user ratings', $text[1] ?? '');
            $text = trim(str_replace([' ', ','], '', $text[0]));
            $this->film['rating_count'] = intval($text);
        }

        /**
         * Genre.
         */
        foreach ($subText->find('span[itemprop=genre]') as $genre) {
            $this->film['genre'][] = $genre->text();
        }

        /**
         * Country
         */
        foreach ($document->find('#titleDetails')[0]->find('h4') as $h) {
            if ($h->text() == 'Country:') {
                foreach ($h->parent()->xpath('//h4[@class="inline"]/following::a') as $a) {
                    $this->film['country'][] = $a->text();
                }
                break;
            }
        }

        /**
         * Image.
         */
        if (!$document->has('.add-image-icon')) {
            if ($document->has('img[itemprop=image]')) {
                $this->film['image'] = $document->find('img[itemprop=image]')[0]->attr('src');
            }
        } else {
            if ($document->has('.poster')) {
                $this->film['image'] = $document->find('.poster')[0]->find('img[itemprop=image]')[0]->attr('src');
            }
        }


        /**
         * Budget.
         */
        $budget = explode('Budget:</h4>', $data);
        $budget = explode('<', $budget[1] ?? '');
        $budget = trim($budget[0]);
        $budget = explode('(', $budget);
        $budget = trim($budget[0]);
        if (!empty($budget)) {
            $budget = str_replace('$', '', $budget);
            $budget = str_replace('&euro;', '', $budget);
            $budget = str_replace(',', '', $budget);
            $budget = str_replace(' ', '', $budget);
            $budget = $budget / 1000000;
            $this->film['budget'] = floatval($budget);
        } else {
            $this->parseBoxoffice($imdbId, $local);
        }
	   
        /**
         * Release.
         */
//        $this->parseRelease($imdbId, $local);
        $this->parseRelease($imdbIdStr, $local);
	   
        /**
         * Crew and cast.
         */
	    
//        $this->parseCredits($imdbId, $local);
        $this->parseCredits($imdbIdStr, $local);
	    
	    
        return $this->film;
    }

    /**
     * Get integer ID.
     * @param $imdbId
     * @return int
     */
    public function getClearFilmId($imdbId)
    {
        if (!filter_var($imdbId, FILTER_VALIDATE_URL) === false) {
            $imdbId = explode('tt', $imdbId)[1] ?? '';
            $imdbId = explode('/', $imdbId)[0];
        } else {
            $imdbId = str_replace('tt', '', $imdbId);
        }
        return intval($imdbId);
    }
    
    public function getClearFilmIdCustom($imdbId) {
	    if (!filter_var($imdbId, FILTER_VALIDATE_URL) === false) {
		    $imdbId = explode('tt', $imdbId)[1] ?? '';
		    $imdbId = explode('/', $imdbId)[0];
	    } else {
		    $imdbId = str_replace('tt', '', $imdbId);
	    }
	    return $imdbId;
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
        return $data;
    }

    private function parseBoxoffice($imdbId, $local)
    {
        $this->error = '';

        $imdbId = $this->getClearFilmId($imdbId);

        if (1 > $imdbId) {
            $this->error = self::BAD_ID;
            return $this->film;
        }

        $url = 'http://www.imdb.com/title/tt' . $imdbId . '/business';

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->film;
        }

        if ($local) {
            $data = '';
            $path = dirname(__FILE__) . '/data.bo.html';
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
        }

        /**
         * Budget.
         */
        $budget = explode('Budget</h5>', $data);
        $budget = explode(' ', $budget[1] ?? '');
        $budget = trim($budget[0]);
        $budget = explode('(', $budget);
        $budget = trim($budget[0]);
        if (!empty($budget)) {
            $budget = str_replace('$', '', $budget);
            $budget = str_replace('&euro;', '', $budget);
            $budget = str_replace(',', '', $budget);
            $budget = str_replace(' ', '', $budget);
            $budget = $budget / 1000000;
            $this->film['budget'] = floatval($budget);
        }

        return $this->film;
    }

    private function parseRelease($imdbId, $local)
    {
        $this->error = '';
	
	    $imdbIdStr = $this->getClearFilmIdCustom($imdbId);
        $imdbId = $this->getClearFilmId($imdbId);
	    
        if (1 > $imdbId) {
            $this->error = self::BAD_ID;
            return $this->film;
        }

        $url = 'http://www.imdb.com/title/tt' . $imdbIdStr . '/releaseinfo';
	    
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->film;
        }

        if ($local) {
            $data = '';
            $path = dirname(__FILE__) . '/data.release.html';
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
        }

        $document = new Document($data);

        $this->film['imdbId'] = $imdbId;
        if ($document->has('#release_dates')) {
            $date = $document->find('#release_dates tr')[0]->child(2)->text();
            if (!empty($date)) {
                $date = date('d.m.Y', strtotime($date));
                $this->film['release_world'] = $date;

                $found = 0;
                $first = true;
                foreach ($document->find('#release_dates tr') as $tr) {
                    if ($first) {
                        $first = false;
                        continue;
                    }

                    if ('USA' == $tr->child(0)->text()) {
                        $found++;
                        $this->film['release_usa'] = date('d.m.Y', strtotime($tr->child(2)->text()));
                    }

                    if ('Russia' == $tr->child(0)->text()) {
                        $found++;
                        $this->film['release_ru'] = date('d.m.Y', strtotime($tr->child(2)->text()));
                    }

                    if (2 == $found) {
                        break;
                    }
                }
            }
        }
        return $this->film;
    }

    private function parseCredits($imdbId, $local)
    {
	    
        $this->error = '';

        $imdbIdStr = $this->getClearFilmIdCustom($imdbId);
        $imdbId = $this->getClearFilmId($imdbId);

        if (1 > $imdbId) {
            $this->error = self::BAD_ID;
            return $this->film;
        }

        $url = 'http://www.imdb.com/title/tt' . $imdbIdStr . '/fullcredits';

        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error = self::URL_ERROR;
            return $this->film;
        }

        if ($local) {
            $data = '';
            $path = dirname(__FILE__) . '/data.fullcredits.html';
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
        }

        $document = new Document($data);

        if ($document->has('#fullcredits_content')) {
            $content = $document->find('#fullcredits_content')[0];
            $headerList = $content->find('.dataHeaderWithBorder');
            $tableList = $content->find('table');

            $count = count($headerList);
            if (count($tableList) == $count) {
                for ($i = 0; $i < $count; $i++) {
                    $type = $headerList[$i]->text();
                    if (false !== stripos($type, 'Directed by')) {
                        $this->addCrew($tableList[$i], 'Режиссер', 'directors');
                    } else if (false !== stripos($type, 'Writing Credits')) {
                        $this->addCrew($tableList[$i], 'Сценарист', 'writers');
                    } else if (false !== stripos($type, 'Produced by')) {
                        $this->addCrew($tableList[$i], 'Продюсер', 'producers');
                    } else if (false !== stripos($type, 'Music by')) {
                        $this->addCrew($tableList[$i], 'Композитор', 'music_original');
                    } else if (false !== stripos($type, 'Cinematography by')) {
                        $this->addCrew($tableList[$i], 'Оператор', 'cinematographers');
                    }
                }
            }
        }

        if ($document->has('.cast_list')) {
            foreach ($document->find('.cast_list tr') as $tr) {
                if ($tr->has('.itemprop')) {
                    $name = trim($tr->find('.itemprop')[0]->text());
                    $id = explode('nm', $tr->find('a')[0]->attr('href'))[1] ?? '';
                    $id = explode('/', $id)[0];
                    $id = intval($id);

                    $character = $tr->find('.character')[0]->text();
                    $character = str_replace('&nbsp;', ' ', $character);
                    $character = trim($character);
                    $character = trim($character, "\xC2\xA0");
                    $character = trim($character, "\xC2\xA0\n");

                    $voice = false;
                    if (false !== stripos($character, '(voice)')) {
                        $voice = true;
                        $character = str_replace('(voice)', '', $character);
                    }

                    $uncredited = false;
                    if (false !== stripos($character, '(uncredited)')) {
                        $uncredited = true;
                        $character = str_replace('(uncredited)', '', $character);
                    }

                    $self = false;
                    if (false !== stripos($character, 'Himself') || false !== stripos($character, 'Herself')) {
                        $self = true;
                        $character = str_ireplace('Himself', '', $character);
                        $character = str_ireplace('Herself', '', $character);
                    }

                    $character = explode('(', $character);

                    $temp = $character[1] ?? '';
                    $character = $this->clearSpaces($character[0]);

                    $episode = '';
                    $year = '';
                    if (!empty($temp)) {
                        $episode = explode('episod', $temp);
                        $episode = $episode[0] ?? '';
                        $episode = intval(trim($episode));
                        if (0 == $episode) {
                            $episode = '';
                        }

                        $year = explode(',', $temp);
                        $year = $year[1] ?? '';
                        $year = explode(')', $year);
                        $year = $year[0] ?? '';
                        $year = trim($year);
                    }

                    $this->film['cast'][] = [$id, $name, $character, $episode, $year, $voice, $uncredited, $self];
                }
            }
        }

        return $this->film;
    }

    private function addCrew(Element $table, $type, $ignore)
    {
        foreach ($table->find('tr') as $tr) {
            if ($tr->has('a')) {
                $a = $tr->find('a')[0];
                if ($ignore != $a->attr('name')) {
                    $id = explode('nm', $a->attr('href'))[1] ?? '';
                    $id = explode('/', $id)[0];
                    $id = intval($id);
             
                    $name = $a->text();

                    $info = [];
                    $td = $tr->find('td');
                    if (2 < count($td)) {
                        $description = '';

                        $temp = $td[2]->text();
                        $episode = explode('episod', $temp);
                        $episode = $episode[0] ?? '';
                        $episode = explode('(', $episode);
                        $count = count($episode);
                        if (2 < $count) {
                            $description = $episode[1] ?? '';
                            $description = explode(')', $description);
                            $description = $description[0] ?? '';
                        }
                        $episode = $episode[$count - 1];
                        $episode = intval(trim($episode));
                        if (0 == $episode) {
                            $episode = '';
                        }

                        $year = explode(',', $temp);
                        $year = $year[1] ?? '';
                        $year = explode(')', $year);
                        $year = $year[0] ?? '';
                        $year = trim($year);
                        if (0 == intval($year)) {
                            $year = '';
                        }

                        $info = [$description, $episode, $year];
                    }

                    $item = [$id, $name, $info];
                    $this->film['crew'][$type][] = $item;
                }
            }
        }
    }

    private function init()
    {
        $this->film = [
            'imdbId' => 0,
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