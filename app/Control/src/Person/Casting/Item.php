<?php
namespace Kinomania\Control\Person\Casting;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->personId = 0;
        $this->sex = '';
        $this->birthday = '';
        $this->height = 0;
        $this->weight = 0;
        $this->color_hair = '';
        $this->color_eyes = '';
        $this->castingId = 0;

        $this->ethnic = '';
        $this->sport = '';
        $this->language = '';
        $this->music_instrument = '';
        $this->dance = '';
        $this->sing = '';
    }


    public function id()
    {
        return $this->id;
    }

    public function personId()
    {
        return $this->personId;
    }

    public function sex()
    {
        return $this->sex;
    }

    public function birthday($raw = false)
    {
        if ($raw) {
            return $this->birthday;
        } else {
            if (empty($this->birthday)) {
                return '';
            }
            $val = explode('-', $this->birthday);
            return $val[2] . '.' . $val[1] . '.' . $val[0];
        }
    }

    public function height()
    {
        if (0 == $this->height) {
            return '';
        }
        return $this->height;
    }

    public function weight()
    {
        if (0 == $this->weight) {
            return '';
        }
        return $this->weight;
    }

    public function color_hair()
    {
        return $this->color_hair;
    }

    public function color_eyes()
    {
        return $this->color_eyes;
    }

    public function castingId()
    {
        return $this->castingId;
    }

    public function ethnic()
    {
        return $this->ethnic;
    }

    public function sport()
    {
        return $this->sport;
    }

    public function language()
    {
        return $this->language;
    }

    public function music_instrument()
    {
        return $this->music_instrument;
    }

    public function dance()
    {
        return $this->dance;
    }

    public function sing()
    {
        return $this->sing;
    }

    protected $id;
    protected $personId;
    protected $sex;
    protected $birthday;
    protected $height;
    protected $weight;
    protected $color_hair;
    protected $color_eyes;
    protected $castingId;

    protected $ethnic;
    protected $sport;
    protected $language;
    protected $music_instrument;
    protected $dance;
    protected $sing;
}