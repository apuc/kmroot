<?php
namespace Original\Route_film_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\FilmController;
use Kinomania\Original\Key\Film\Film;
use Kinomania\System\Common\TDate;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;
use Kinomania\System\Data\Player;

class GET extends FilmController
{
    use TRepository;
    use TDate;

    public function index()
    {
    	$player = new Player();
        $numList = $this->getNumList();

        $film = null;
        
        if (0 < $numList[0]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $key = 'film:' . $numList[0];
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $item = unserialize($this->redis->get($key));
            } else {
                $film = new \Kinomania\Original\Logic\Film\Film();
                $item = $film->get($numList[0]);

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 259200); // 3 days

                    $itemMin[Film::NAME_ORIGIN] = $item[Film::NAME_ORIGIN];
                    $itemMin[Film::NAME_RU] = $item[Film::NAME_RU];
                    $itemMin[Film::TITLE] = $item[Film::TITLE];
                    $this->redis->set($key . ':min', serialize($itemMin), 259200); // 3 days
                }
            }


            if ([] != $item) {
                if ('' != $item[Film::IMAGE]) {
                    $imageName = md5($numList[0]);
                    $item[Film::IMAGE_ORG] = Server::STATIC[$item[Film::S]] . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[Film::IMAGE];
                    $item[Film::IMAGE_MIN] = Server::STATIC[$item[Film::S]] . '/image' . Path::FILM . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.306.443.' . $item[Film::IMAGE];
                } else {
                    $item[Film::IMAGE_ORG] = '';
                    $item[Film::IMAGE_MIN] = Server::STATIC[0] . '/app/img/content/np_nopic_film.jpg';
                }

                /**
                 * Linked news.
                 */
                $news = [];
                $key = 'film:news:' . $numList[0];
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $news = unserialize($this->redis->get($key));
                } else {
                    $result = $this->mysql()->query("SELECT t1.`id`, t1.`s`, t1.`image`, t1.`category`, t1.`publish`, t1.`title`, t1.`anons`, t2.`comment` FROM
                                              `news_link` as `t` JOIN   
                                              `news` as `t1` ON t.`newsId` = t1.`id`
                                              LEFT JOIN `news_stat` as `t2` ON t1.`id` = t2.`newsId` 
                                              WHERE t.`filmId` = {$numList[0]} AND t1.`status` = 'show' ORDER BY t1.`publish` DESC LIMIT 3
                                            ");
                    while ($row = $result->fetch_assoc()) {
                        switch ($row['category']) {
                            case 'Новости кино':
                                $row['category'] = 'news';
                                break;
                            case 'Зарубежные сериалы':
                                $row['category'] = 'news';
                                break;
                            case 'Российские сериалы':
                                $row['category'] = 'news';
                                break;
                            case 'Арткиномания':
                                $row['category'] = 'news';
                                break;
                            case 'Фестивали и премии':
                                $row['category'] = 'news';
                                break;
                            default:
                                $row['category'] = 'article';
                        }
                        $row['publish'] = $this->formatDate($row['publish'], true, '</span>, <span class="date__hour">');
                        if ('' != $row['image']) {
                            $imageName = md5($row['id']);
                            $row['image'] = Server::STATIC[$row['s']] . '/image' . Path::NEWS . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.235.160.' . $row['image'];
                        } else {
                            $row['image'] = Server::STATIC[0] . '/app/img/content/nnc.jpg';
                        }
                        $news[] = $row;
                    }

                    if (!Wrap::$debugEnabled && [] != $news && $this->redisStatus) {
                        $this->redis->set($key, serialize($news), 600); // 10 min
                    }
                }

                /**
                 * Short cast and crew.
                 */

                $key = 'film:team:' . $numList[0];
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $team = unserialize($this->redis->get($key));
                } else {
                    if (is_null($film)) {
                        $film = new \Kinomania\Original\Logic\Film\Film();
                    }

                    $team['crew'] = $film->crew($numList[0]);
                    $team['cast'] = $film->cast($numList[0]);

                    $cache = true;
                    if ([] == $team['crew'] && [] == $team['cast']) {
                        $cache = false;
                    }

                    if (!Wrap::$debugEnabled && $cache && $this->redisStatus) {
                        $this->redis->set($key, serialize($team), 3600); // 1 hour
                    }
                }

                $this->addData([
                    'id' => $numList[0],
                    'item' => $item,
                    'team' => $team,
                    'news' => $news,
                    'stat' => $this->getStat($numList[0]),
	                'player' => $player->selectPlayer(),
                ]);
                $this->setTemplate('film/index.html.php');
            }
        }
    }
}