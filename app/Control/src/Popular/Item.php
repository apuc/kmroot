<?php
namespace Kinomania\Control\Popular;

use Dspbee\Bundle\Data\TDataInit;

class Item
{
    use TDataInit;
    
    public function __construct()
    {
        $this->film_wallpaper = [];
        $this->person_wallpaper_actors = [];
        $this->person_wallpaper_actresses = [];
        $this->person_photo = [];
        $this->film_poster = [];
        $this->film_new = [];
        $this->casting_promo = [];
        $this->trailer_new = [];
        $this->wallpaper_new = [];
    }
    
    public function film_wallpaper()
    {
        return $this->film_wallpaper;
    }
    
    public function person_wallpaper_actors()
    {
        return $this->person_wallpaper_actors;
    }
    
    public function person_wallpaper_actresses()
    {
        return $this->person_wallpaper_actresses;
    }
    
    public function person_photo()
    {
        return $this->person_photo;
    }
    
    public function film_poster()
    {
        return $this->film_poster;
    }

    public function film_new()
    {
        return $this->film_new;
    }

    public function casting_promo()
    {
        return $this->casting_promo;
    }

    public function trailer_new()
    {
        return $this->trailer_new;
    }

    public function wallpaper_new()
    {
        return $this->wallpaper_new;
    }

    protected $film_wallpaper;
    protected $person_wallpaper_actors;
    protected $person_wallpaper_actresses;
    protected $person_photo;
    protected $film_poster;
    protected $film_new;
    protected $casting_promo;
    protected $trailer_new;
    protected $wallpaper_new;
}