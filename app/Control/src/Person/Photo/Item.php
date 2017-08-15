<?php
namespace Kinomania\Control\Person\Photo;

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
        $this->description = '';
        $this->width = 0;
        $this->height = 0;
        $this->size = 0;
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
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
            return Server::STATIC[$this->s] . '/image' . Path::PERSON_PHOTO . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.228.289.' . $this->image;
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

    public function description()
    {
        return $this->description;
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

    protected $id;
    protected $s;
    protected $image;
    protected $personId;
    protected $description;
    protected $width;
    protected $height;
    protected $size;
}