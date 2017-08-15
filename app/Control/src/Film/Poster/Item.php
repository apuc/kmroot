<?php
namespace Kinomania\Control\Film\Poster;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->s = '';
        $this->image = '';
        $this->filmId = 0;
        $this->width = 0;
        $this->height = 0;
        $this->size = 0;
        $this->popular = 0;
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageResizeSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . '/image' . Path::FILM_POSTER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.313.' . $this->image;
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

    public function filmId()
    {
        return $this->filmId;
    }


    public function width()
    {
        return $this->width;
    }

    public function height()
    {
        return $this->height;
    }

    public function size()
    {
        return $this->size;
    }

    public function popular()
    {
        return $this->popular;
    }

    protected $id;
    protected $s;
    protected $image;
    protected $filmId;
    protected $width;
    protected $height;
    protected $size;
    protected $popular;
}