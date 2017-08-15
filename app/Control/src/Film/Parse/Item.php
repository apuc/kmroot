<?php
namespace Kinomania\Control\Film\Parse;

class Item
{
    public function __construct()
    {
        $this->image = '';
        $this->year = '';
        $this->name_origin = '';
        $this->name_ru = '';
        $this->type = '';
        $this->country = [];
        $this->genre = [];
        $this->runtime = '';
        $this->imdb = '';
        $this->imdb_count = '';
        $this->budget = '';
        $this->premiere_world = '';
        $this->premiere_ru = '';
        $this->premiere_usa = '';
        $this->limit_us = '';
        $this->series_count = '';
        $this->year_finish = '';
        $this->cast = [];
        $this->crew = [
            'Режиссер' => [],
            'Сценарист' => [],
            'Продюсер' => [],
            'Оператор' => [],
            'Композитор' => [],
        ];
    }
    
    public function image()
    {
        return $this->image;
    }
    
    public function year()
    {
        if (0 == $this->year) {
            return '';
        }
        return $this->year;
    }
    
    public function name_origin()
    {
        return $this->name_origin;
    }
    
    public function name_ru()
    {
        return $this->name_ru;
    }
    
    public function type()
    {
        return $this->type;
    }
    
    public function country()
    {
        return $this->country;
    }
    
    public function genre()
    {
        return $this->genre;
    }
    
    public function runtime()
    {
        if (0 == $this->runtime) {
            return '';
        }
        return $this->runtime;
    }
    
    public function imdb()
    {
        if (0 == $this->imdb) {
            return '';
        }
        return $this->imdb;
    }
    
    public function imdb_count()
    {
        if (0 == $this->imdb_count) {
            return '';
        }
        return $this->imdb_count;
    }
    
    public function budget()
    {
        if (0 == $this->budget) {
            return '';
        }
        return $this->budget;
    }
    
    public function premiere_world()
    {
        return $this->premiere_world;
    }
    
    public function premiere_ru()
    {
        return $this->premiere_ru;
    }
    
    public function premiere_usa()
    {
        return $this->premiere_usa;
    }
    
    public function limit_us()
    {
        return $this->limit_us;
    }

    public function series_count()
    {
        if (0 == $this->series_count) {
            return '';
        }
        return $this->series_count;
    }

    public function year_finish()
    {
        if (0 == $this->year_finish) {
            return '';
        }
        return $this->year_finish;
    }
    
    public function cast()
    {
        return $this->cast;
    }
    
    public function crew()
    {
        return $this->crew;
    }
    
    public function setImage($val)
    {
        $this->image = $val;
    }
    
    public function setYear($val)
    {
        $this->year = $val;
    }
    
    public function setName_origin($val)
    {
        $this->name_origin = $val;
    }
    
    public function setName_ru($val)
    {
        $this->name_ru = $val;
    }
    
    public function setType($val)
    {
        $this->type = $val;
    }
    
    public function setCountry($val)
    {
        $this->country = $val;
    }
    
    public function setGenre($val)
    {
        $this->genre = $val;
    }
    
    public function setRuntime($val)
    {
        $this->runtime = $val;
    }
    
    public function setImdb($val)
    {
        $this->imdb = $val;
    }
    
    public function setImdb_count($val)
    {
        $this->imdb_count = $val;
    }
    
    public function setBudget($val)
    {
        $this->budget = $val;
    }
    
    public function setPremiere_world($val)
    {
        $this->premiere_world = $val;
    }
    
    public function setPremiere_ru($val)
    {
        $this->premiere_ru = $val;
    }
    
    public function setPremiere_usa($val)
    {
        $this->premiere_usa = $val;
    }
    
    public function setLimit_us($val)
    {
        $this->limit_us = $val;
    }

    public function setSeries_count($val)
    {
        $this->series_count = $val;
    }

    public function setYear_finish($val)
    {
        $this->year_finish = $val;
    }
    
    public function setCast($val)
    {
        $this->cast = $val;
    }
    
    public function setCrew($val)
    {
        $this->crew = $val;
    }

    protected $image;
    protected $year;
    protected $name_origin;
    protected $name_ru;
    protected $type;
    protected $country;
    protected $genre;
    protected $runtime;
    protected $imdb;
    protected $imdb_count;
    protected $budget;
    protected $premiere_world;
    protected $premiere_ru;
    protected $premiere_usa;
    protected $limit_us;
    protected $series_count;
    protected $year_finish;
    protected $cast;
    protected $crew;
}