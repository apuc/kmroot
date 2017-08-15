<?php
namespace Original\Route_people_D;

use Dspbee\Bundle\Debug\Wrap;
use Kinomania\Original\Controller\PersonController;
use Kinomania\Original\Logic\Person\Person;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class GET extends PersonController
{
    public function index()
    {
        $numList = $this->getNumList();
        
        $person = null;
        
        if (0 < $numList[0]) {
            $this->redis = new \Redis();
            $this->redisStatus = $this->redis->connect('127.0.0.1');

            $key = 'person:' . $numList[0];
            if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                $item = unserialize($this->redis->get($key));
            } else {
                $person = new Person();
                $item = $person->get($numList[0]);

                if (!Wrap::$debugEnabled && [] != $item && $this->redisStatus) {
                    $this->redis->set($key, serialize($item), 259200); // 3 days

                    $itemMin[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN] = $item[\Kinomania\Original\Key\Person\Person::NAME_ORIGIN];
                    $itemMin[\Kinomania\Original\Key\Person\Person::NAME_RU] = $item[\Kinomania\Original\Key\Person\Person::NAME_RU];
                    $itemMin[\Kinomania\Original\Key\Person\Person::TITLE] = $item[\Kinomania\Original\Key\Person\Person::TITLE];
                    $this->redis->set($key . ':min', serialize($itemMin), 259200); // 3 days
                }
            }

            if ([] != $item) {
                /**
                 * Filmography.
                 */
                $key = 'person:' . $numList[0] . ':list';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    if (is_null($person)) {
                        $person = new Person();
                    }
                    $list = $person->filmography($numList[0]);

                    if (!Wrap::$debugEnabled && [] != $list && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 3600); // 1 hour
                    }
                }

                /**
                 * Linked news
                 */
                $news = [];
                $key = 'person:' . $numList[0] . ':news';
                if (!Wrap::$debugEnabled && $this->redisStatus && $this->redis->exists($key)) {
                    $list = unserialize($this->redis->get($key));
                } else {
                    if (is_null($person)) {
                        $person = new Person();
                    }
                    $news = $person->news($numList[0]);

                    if (!Wrap::$debugEnabled && [] != $news && $this->redisStatus) {
                        $this->redis->set($key, serialize($list), 720); // 12 min
                    }
                }

                /**
                 * Image.
                 */
                if ('' != $item[\Kinomania\Original\Key\Person\Person::IMAGE]) {
                    $imageName = md5($numList[0]);
                    $item[\Kinomania\Original\Key\Person\Person::IMAGE_ORG] = Server::STATIC[$item[\Kinomania\Original\Key\Person\Person::S]] . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.' . $item[\Kinomania\Original\Key\Person\Person::IMAGE];
                    $item[\Kinomania\Original\Key\Person\Person::IMAGE_MIN] = Server::STATIC[$item[\Kinomania\Original\Key\Person\Person::S]] . '/image' . Path::PERSON . substr($imageName, 0, 1) . '/' . substr($imageName, 1, 2) . '/' . $imageName . '.243.321.' . $item[\Kinomania\Original\Key\Person\Person::IMAGE];
                } else {
                    $item[\Kinomania\Original\Key\Person\Person::IMAGE_ORG] = '';
                    $item[\Kinomania\Original\Key\Person\Person::IMAGE_MIN] = Server::STATIC[0] . '/app/img/content/np_nopic.jpg';
                }

                $this->addData([
                    'stat' => $this->getStat($numList[0]),
                    'id' => $numList[0],
                    'item' => $item,
                    'list' => $list,
                    'news' => $news,
                ]);
                $this->setTemplate('person/index.html.php');
            }
        }
    }
}