<?php
namespace Kinomania\Control\Film;

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
        $this->posterId = 0;
        $this->status = '';
        $this->name_origin = '';
        $this->name_ru = '';
        $this->search = '';
        $this->country = '';
        $this->year = 0;
        $this->genre = '';
        $this->type = '';
        $this->arthouse = '';
        $this->runtime = 0;
        $this->premiere_world = '';
        $this->premiere_ru = '';
        $this->premiere_usa = '';
        $this->limit_us = '';
        $this->limit_ru = '';
        $this->budget = '';
        $this->season_count = 0;
        $this->series_count = 0;
        $this->year_finish = '';
        $this->review = 0;
        $this->preview = '';
        $this->fact = '';
        $this->id_imdb = 0;
        $this->id_kp = 0;
        $this->id_kt = 0;
        $this->id_rk = 0;
        $this->note = '';
        $this->check = '';
        
        $this->rate = 0;
        $this->rate_count = 0;
        $this->imdb = 0;
        $this->imdb_count = 0;
        $this->kp = 0;
        $this->kp_count = 0;
        $this->poster = 0;
        $this->frame = 0;
        $this->wallpaper = 0;
        $this->trailer = 0;
        $this->soundtrack = 0;
        $this->award = 0;
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
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
            return Server::STATIC[$this->s] . '/image/' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.130.' . $this->image;
        }
        return '';
    }

    public function id()
    {
        return $this->id;
    }

    public function s()
    {
        return $this->s;
    }

    public function image()
    {
        return $this->image;
    }

    public function posterId()
    {
        if (0 == $this->posterId) {
            return '';
        }
        return $this->posterId;
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

    public function country()
    {
        return $this->country;
    }

    public function year()
    {
        if (0 == $this->year) {
            return '';
        }
        return $this->year;
    }

    public function genre()
    {
        return $this->genre;
    }

    public function type()
    {
        return $this->type;
    }

    public function arthouse()
    {
        return $this->arthouse;
    }

    public function runtime()
    {
        if (0 == $this->runtime) {
            return '';
        }
        return $this->runtime;
    }

    public function premiere_world($raw = false)
    {
        if ($raw) {
            return $this->premiere_world;
        } else {
            if (empty($this->premiere_world)) {
                return '';
            }
            $val = explode('-', $this->premiere_world);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function premiere_ru($raw = false)
    {
        if ($raw) {
            return $this->premiere_ru;
        } else {
            if (empty($this->premiere_ru)) {
                return '';
            }
            $val = explode('-', $this->premiere_ru);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function premiere_usa($raw = false)
    {
        if ($raw) {
            return $this->premiere_usa;
        } else {
            if (empty($this->premiere_usa)) {
                return '';
            }
            $val = explode('-', $this->premiere_usa);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function limit_us()
    {
        return $this->limit_us;
    }

    public function limit_ru()
    {
        return $this->limit_ru;
    }

    public function budget()
    {
        if (0.0000 == $this->budget) {
            return '';
        }
        return $this->budget;
    }

    public function season_count()
    {
        if (0 == $this->season_count) {
            return '';
        }
        return $this->season_count;
    }

    public function series_count()
    {
        if (0 == $this->series_count) {
            return '';
        }
        return $this->series_count;
    }

    public function year_finish()
    {
        if (0 == $this->year_finish) {
            return '';
        }
        return $this->year_finish;
    }

    public function review()
    {
        return $this->review;
    }

    public function preview()
    {
        return $this->preview;
    }

    public function fact()
    {
        return $this->fact;
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


    public function rate()
    {
        if (0 == $this->rate) {
            return '';
        }
        return $this->rate;
    }
    
    public function rate_count()
    {
        if (0 == $this->rate_count) {
            return '';
        }
        return $this->rate_count;
    }
    
    public function imdb()
    {
        if (0 == $this->imdb) {
            return '';
        }
        return $this->imdb;
    }
    
    public function imdb_count()
    {
        if (0 == $this->imdb_count) {
            return '';
        }
        return $this->imdb_count;
    }
    
    public function kp()
    {
        if (0 == $this->kp) {
            return '';
        }
        return $this->kp;
    }
    
    public function kp_count()
    {
        if (0 == $this->kp_count) {
            return '';
        }
        return $this->kp_count;
    }
    
    public function poster()
    {
        if (0 == $this->poster) {
            return '';
        }
        return $this->poster;
    }
    
    public function frame()
    {
        if (0 == $this->frame) {
            return '';
        }
        return $this->frame;
    }
    
    public function wallpaper()
    {
        if (0 == $this->wallpaper) {
            return '';
        }
        return $this->wallpaper;
    }
    
    public function trailer()
    {
        if (0 == $this->trailer) {
            return '';
        }
        return $this->trailer;
    }
    
    public function soundtrack()
    {
        if (0 == $this->soundtrack) {
            return '';
        }
        return $this->soundtrack;
    }
    
    public function award()
    {
        if (0 == $this->award) {
            return '';
        }
        return $this->award;
    }
    
    protected $id;
    protected $s;
    protected $image;
    protected $posterId;
    protected $status;
    protected $name_origin;
    protected $name_ru;
    protected $search;
    protected $country;
    protected $year;
    protected $genre;
    protected $type;
    protected $arthouse;
    protected $runtime;
    protected $premiere_world;
    protected $premiere_ru;
    protected $premiere_usa;
    protected $limit_us;
    protected $limit_ru;
    protected $budget;
    protected $season_count;
    protected $series_count;
    protected $year_finish;
    protected $review;
    protected $preview;
    protected $fact;
    protected $id_imdb;
    protected $id_kp;
    protected $id_kt;
    protected $id_rk;
    protected $note;
    protected $check;
    
    protected $rate;
    protected $rate_count;
    protected $imdb;
    protected $imdb_count;
    protected $kp;
    protected $kp_count;
    protected $poster;
    protected $frame;
    protected $wallpaper;
    protected $trailer;
    protected $soundtrack;
    protected $award;
}