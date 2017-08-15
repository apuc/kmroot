<?php
namespace Kinomania\Control\Film\Wallpaper;

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
            return Server::STATIC[$this->s] . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
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
            return Server::STATIC[$this->s] . '/image' . Path::FILM_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.280.190.' . $this->image;
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
    
    protected $personList;
}