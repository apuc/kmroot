<?php
namespace Kinomania\Control\Person\Filmography;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class ItemCast
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->filmId = 0;
        $this->personId = 0;
        $this->status = '';
        $this->role_ru = '';
        $this->role_en = '';
        $this->note = '';
        $this->voice = '';
        $this->self = '';
        $this->uncredited = '';
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
            $iName = md5($this->filmId);
            return Server::STATIC[$this->s] . '/image' . Path::FILM . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.88.116.' . $this->image;
        }
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

    public function role_ru()
    {
        return $this->role_ru;
    }

    public function role_en()
    {
        return $this->role_en;
    }

    public function note()
    {
        return $this->note;
    }

    public function voice()
    {
        return $this->voice;
    }

    public function self()
    {
        return $this->self;
    }

    public function uncredited()
    {
        return $this->uncredited;
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
    protected $role_ru;
    protected $role_en;
    protected $note;
    protected $voice;
    protected $self;
    protected $uncredited;
    protected $episodes;
    protected $year;
    protected $source;
    protected $order;


    protected $s;
    protected $image;
    protected $name_origin;
    protected $name_ru;
}