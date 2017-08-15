<?php
namespace Kinomania\Control\Film\Filmography;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class ItemCrew
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->personId = 0;
        $this->status = '';
        $this->type = '';
        $this->description = '';
        $this->episodes = 0;
        $this->year = '';
        $this->source = '';
        $this->order = 0;

        $this->s = 0;
        $this->image = '';
        $this->name_origin = '';
        $this->name_ru = '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->personId);
            return Server::STATIC[$this->s] . '/image' . Path::PERSON . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.116.' . $this->image;
        }
        return '';
    }

    public function image()
    {
        return $this->image;
    }

    public function name_origin()
    {
        return $this->name_origin;
    }

    public function name_ru()
    {
        return $this->name_ru;
    }


    public function id()
    {
        return $this->id;
    }

    public function filmId()
    {
        return $this->filmId;
    }

    public function personId()
    {
        return $this->personId;
    }

    public function status()
    {
        return $this->status;
    }

    public function type()
    {
        return $this->type;
    }

    public function description()
    {
        return $this->description;
    }

    public function episodes()
    {
        if (0 == $this->episodes) {
            return '';
        }
        return $this->episodes;
    }

    public function year()
    {
        if (0 == $this->year) {
            return '';
        }
        return $this->year;
    }

    public function source()
    {
        return $this->source;
    }

    public function order()
    {
        return $this->order;
    }

    protected $id;
    protected $filmId;
    protected $personId;
    protected $status;
    protected $type;
    protected $description;
    protected $episodes;
    protected $year;
    protected $source;
    protected $order;
    
    protected $s;
    protected $image;
    protected $name_origin;
    protected $name_ru;
}