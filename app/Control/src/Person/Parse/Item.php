<?php
namespace Kinomania\Control\Person\Parse;

class Item
{
    public function __construct()
    {
        $this->image = '';
        $this->name_origin = '';
        $this->name_ru = '';
        $this->sex = '';
        $this->birthday = '';
        $this->death = '';
        $this->birthplace_en = '';
        $this->birthplace_ru = '';
        $this->height = '';
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

    public function name_origin()
    {
        return $this->name_origin;
    }
    
    public function name_ru()
    {
        return $this->name_ru;
    }
    
    public function sex()
    {
        return $this->sex;
    }
    
    public function birthday()
    {
        if (0 == $this->birthday) {
            return '';
        }
        return $this->birthday;
    }
    
    public function death()
    {
        if (0 == $this->death) {
            return '';
        }
        return $this->death;
    }
    
    public function birthplace_en()
    {
        return $this->birthplace_en;
    }
    
    public function birthplace_ru()
    {
        return $this->birthplace_ru;
    }
    
    public function height()
    {
        if (0 == $this->height) {
            return '';
        }
        return $this->height;
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
    
    public function setName_origin($val)
    {
        $this->name_origin = $val;
    }
    
    public function setName_ru($val)
    {
        $this->name_ru = $val;
    }
    
    public function setSex($val)
    {
        $this->sex = $val;
    }
    
    public function setBirthday($val)
    {
        $this->birthday = $val;
    }
    
    public function setDeath($val)
    {
        $this->death = $val;
    }
    
    public function setBirthplace_en($val)
    {
        $this->birthplace_en = $val;
    }
    
    public function setBirthplace_ru($val)
    {
        $this->birthplace_ru = $val;
    }
    
    public function setHeight($val)
    {
        $this->height = $val;
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
    protected $name_origin;
    protected $name_ru;
    protected $sex;
    protected $birthday;
    protected $death;
    protected $birthplace_en;
    protected $birthplace_ru;
    protected $height;
    protected $cast;
    protected $crew;
}