<?php
namespace Kinomania\Control\Person;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->s = 0;
        $this->image = '';
        $this->photoId = 0;
        $this->status = '';
        $this->name_origin = '';
        $this->name_ru = '';
        $this->search = '';
        $this->sex = '';
        $this->origin = '';
        $this->actor = '';
        $this->director = '';
        $this->screenwriter = '';
        $this->producer = '';
        $this->composer = '';
        $this->operator = '';
        $this->birthday = '';
        $this->death = '';
        $this->birthplace_en = '';
        $this->birthplace_ru = '';
        $this->height = 0;
        $this->education = '';
        $this->theater = '';
        $this->award = '';
        $this->info = '';
        $this->biography = '';
        $this->award_list = '';
        $this->match = 0;
        $this->id_imdb = 0;
        $this->id_kp = 0;
        $this->id_kt = 0;
        $this->id_rk = 0;
        $this->note = '';
        $this->check = '';

        $this->photo = 0;
        $this->wallpaper = 0;
        $this->video = 0;
    }
    
    public function casting()
    {
        if (!empty($this->image()) && 'ru' == $this->origin && 'yes' == $this->actor && null == $this->death) {
            return true;
        }
        
        return false;
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::PERSON . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSmallSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . '/image/' . Path::PERSON . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $this->image;
        }
        return '';
    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function photoId()
    {
        if (0 == $this->photoId) {
            return '';
        }
        return $this->photoId;
    }

    public function status()
    {
        return $this->status;
    }

    public function name_origin()
    {
        return $this->name_origin;
    }

    public function name_ru()
    {
        return $this->name_ru;
    }

    public function search()
    {
        return $this->search;
    }

    public function sex()
    {
        return $this->sex;
    }

    public function origin()
    {
        return $this->origin;
    }

    public function actor()
    {
        return $this->actor;
    }

    public function director()
    {
        return $this->director;
    }

    public function screenwriter()
    {
        return $this->screenwriter;
    }

    public function producer()
    {
        return $this->producer;
    }

    public function composer()
    {
        return $this->composer;
    }

    public function operator()
    {
        return $this->operator;
    }

    public function birthday($raw = false)
    {
        if ($raw) {
            return $this->birthday;
        } else {
            if (empty($this->birthday)) {
                return '';
            }
            $val = explode('-', $this->birthday);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function death($raw = false)
    {
        if ($raw) {
            return $this->death;
        } else {
            if (empty($this->death)) {
                return '';
            }
            $val = explode('-', $this->death);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function birthplace_en()
    {
        return $this->birthplace_en;
    }

    public function birthplace_ru()
    {
        return $this->birthplace_ru;
    }

    public function height()
    {
        if (0 == $this->height) {
            return '';
        }
        return $this->height;
    }

    public function education()
    {
        return $this->education;
    }

    public function theater()
    {
        return $this->theater;
    }

    public function award()
    {
        return $this->award;
    }

    public function info()
    {
        return $this->info;
    }

    public function biography()
    {
        return $this->biography;
    }

    public function award_list()
    {
        return $this->award_list;
    }

    public function match()
    {
        if (0 == $this->match) {
            return '';
        }
        return $this->match;
    }

    public function id_imdb()
    {
        if (0 == $this->id_imdb) {
            return '';
        }
        return $this->id_imdb;
    }

    public function id_kp()
    {
        if (0 == $this->id_kp) {
            return '';
        }
        return $this->id_kp;
    }

    public function id_kt()
    {
        if (0 == $this->id_kt) {
            return '';
        }
        return $this->id_kt;
    }

    public function id_rk()
    {
        if (0 == $this->id_rk) {
            return '';
        }
        return $this->id_rk;
    }

    public function note()
    {
        return $this->note;
    }

    public function check()
    {
        return $this->check;
    }

    public function photo()
    {
        if (0 == $this->photo) {
            return '';
        }
        return $this->photo;
    }

    public function wallpaper()
    {
        if (0 == $this->wallpaper) {
            return '';
        }
        return $this->wallpaper;
    }

    public function video()
    {
        if (0 == $this->video) {
            return '';
        }
        return $this->video;
    }

    protected $id;
    protected $s;
    protected $image;
    protected $photoId;
    protected $status;
    protected $name_origin;
    protected $name_ru;
    protected $search;
    protected $sex;
    protected $origin;
    protected $actor;
    protected $director;
    protected $screenwriter;
    protected $producer;
    protected $composer;
    protected $operator;
    protected $birthday;
    protected $death;
    protected $birthplace_en;
    protected $birthplace_ru;
    protected $height;
    protected $education;
    protected $theater;
    protected $award;
    protected $info;
    protected $biography;
    protected $award_list;
    protected $match;
    protected $id_imdb;
    protected $id_kp;
    protected $id_kt;
    protected $id_rk;
    protected $note;
    protected $check;

    protected $photo;
    protected $wallpaper;
    protected $video;
}