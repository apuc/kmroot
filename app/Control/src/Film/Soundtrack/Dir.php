<?php
namespace Kinomania\Control\Film\Soundtrack;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Dir
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->status = '';
        $this->s = 0;
        $this->image = '';
        $this->m = 0;
        $this->path = '';
        $this->name = '';
        $this->year = '';
        $this->popular = '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::FILM_SOUNDTRACK . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
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

    public function s()
    {
        return $this->s;
    }

    public function image()
    {
        return $this->image;
    }

    public function m()
    {
        return $this->m;
    }

    public function path()
    {
        return $this->path;
    }

    public function name()
    {
        return $this->name;
    }

    public function year()
    {
        return $this->year;
    }

    public function popular()
    {
        return $this->popular;
    }

    protected $id;
    protected $filmId;
    protected $status;
    protected $s;
    protected $image;
    protected $m;
    protected $path;
    protected $name;
    protected $year;
    protected $popular;
}