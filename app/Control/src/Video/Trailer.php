<?php
namespace Kinomania\Control\Video;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Trailer
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->status = '';
        $this->no_main = '';
        $this->s = 0;
        $this->image = '';
        $this->date = '';
        $this->popular = '';
        $this->local = '';
        $this->type = 0;
        $this->m = 0;
        $this->hd480 = '';
        $this->hd720 = '';
        $this->hd1080 = '';
        
        $this->name = '';
        $this->personList = [];
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::FILM_TRAILER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
    }

    /**
     * @return string
     */
    public function fileSrc()
    {
        $iName = md5($this->id);
        return Server::MEDIA[$this->m] . Path::FILM_VIDEO_MEDIA . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName;
    }

    public function id()
    {
        return $this->id;
    }

    public function filmId()
    {
        return $this->filmId;
    }

    public function status()
    {
        return $this->status;
    }

    public function no_main()
    {
        return $this->no_main;
    }

    public function s()
    {
        return $this->s;
    }

    public function image()
    {
        return $this->image;
    }

    public function date()
    {
        return $this->date;
    }

    public function popular()
    {
        return $this->popular;
    }

    public function local()
    {
        return $this->local;
    }

    public function type()
    {
        return $this->type;
    }

    public function m()
    {
        return $this->m;
    }

    public function hd480()
    {
        return $this->hd480;
    }

    public function hd720()
    {
        return $this->hd720;
    }

    public function hd1080()
    {
        return $this->hd1080;
    }


    public function name()
    {
        return $this->name;
    }

    public function personList()
    {
        return $this->personList;
    }

    protected $id;
    protected $filmId;
    protected $status;
    protected $no_main;
    protected $s;
    protected $image;
    protected $date;
    protected $popular;
    protected $local;
    protected $type;
    protected $m;
    protected $hd480;
    protected $hd720;
    protected $hd1080;

    protected $name;
    protected $personList;
}