<?php
namespace Kinomania\Control\Person\Wallpaper;

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
        $this->personId = 0;
        $this->width = 0;
        $this->height = 0;
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::PERSON_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
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
            return Server::STATIC[$this->s] . '/image' . Path::PERSON_WALLPAPER . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.280.190.' . $this->image;
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

    public function personId()
    {
        return $this->personId;
    }

    public function width()
    {
        return $this->width;
    }

    public function height()
    {
        return $this->height;
    }

    protected $id;
    protected $s;
    protected $image;
    protected $personId;
    protected $width;
    protected $height;
}