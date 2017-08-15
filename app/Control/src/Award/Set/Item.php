<?php
namespace Kinomania\Control\Award\Set;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->awardId = 0;
        $this->year = '';
        $this->nominationId = 0;
        $this->filmId = 0;
        $this->personId = 0;
        $this->win = '';

        $this->filmName_ru = '';
        $this->filmName_origin = '';
        $this->personName_ru = '';
        $this->personName_origin = '';
    }

    public function id()
    {
        return $this->id;
    }

    public function awardId()
    {
        return $this->awardId;
    }

    public function year()
    {
        return $this->year;
    }

    public function nominationId()
    {
        return $this->nominationId;
    }

    public function filmId()
    {
        if (0 == $this->filmId) {
            return '';
        }
        return $this->filmId;
    }

    public function personId()
    {
        if (0 == $this->personId) {
            return '';
        }
        return $this->personId;
    }

    public function win()
    {
        return $this->win;
    }

    public function filmName_ru()
    {
        return $this->filmName_ru;
    }

    public function filmName_origin()
    {
        return $this->filmName_origin;
    }

    public function personName_ru()
    {
        return $this->personName_ru;
    }

    public function personName_origin()
    {
        return $this->personName_origin;
    }

    protected $id;
    protected $awardId;
    protected $year;
    protected $nominationId;
    protected $filmId;
    protected $personId;
    protected $win;

    protected $filmName_ru;
    protected $filmName_origin;
    protected $personName_ru;
    protected $personName_origin;
}