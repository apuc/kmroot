<?php
namespace Kinomania\Control\Film\Frame;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->s = '';
        $this->image = '';
        $this->width = 0;
        $this->height = 0;
        $this->size = 0;
        $this->photo_session = 0;
        $this->film_set = 0;
        $this->concept = 0;
        $this->screenshot = 0;
        
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
            return Server::STATIC[$this->s] . Path::FILM_FRAME . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
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
            return Server::STATIC[$this->s] . '/image' . Path::FILM_FRAME . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.455.247.' . $this->image;
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

    public function s()
    {
        return $this->s;
    }

    public function image()
    {
        return $this->image;
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

    public function photo_session()
    {
        return $this->photo_session;
    }

    public function film_set()
    {
        return $this->film_set;
    }

    public function concept()
    {
        return $this->concept;
    }

    public function screenshot()
    {
        return $this->screenshot;
    }

    public function personList()
    {
        return $this->personList;
    }

    protected $id;
    protected $filmId;
    protected $s;
    protected $image;
    protected $width;
    protected $height;
    protected $size;
    protected $photo_session;
    protected $film_set;
    protected $concept;
    protected $screenshot;
    
    protected $personList;
}