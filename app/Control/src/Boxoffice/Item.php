<?php
namespace Kinomania\Control\Boxoffice;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Common\TDate;

class Item
{
    use TDataInit;
    use TDate;

    public function __construct()
    {
        $this->id = 0;
        $this->type = '';
        $this->position = 0;
        $this->previous = 0;
        $this->filmId = 0;
        $this->name_origin = '';
        $this->name_ru = '';
        $this->company_name = '';
        $this->week = 0;
        $this->copy = 0;
        $this->gross = 0;
        $this->gross_total = 0;
        $this->gross_rub = 0;
        $this->gross_total_rub = 0;
        $this->views = 0;
        $this->views_total = 0;
        $this->date_from = '';
        $this->date_to = '';
    }
    
    public function id()
    {
        return $this->id;
    }

    public function type()
    {
        return $this->type;
    }

    public function position()
    {
        return $this->position;
    }

    public function previous()
    {
        return $this->previous;
    }

    public function filmId()
    {
        return $this->filmId;
    }

    public function name_origin()
    {
        return $this->name_origin;
    }

    public function name_ru()
    {
        return $this->name_ru;
    }

    public function company_name()
    {
        return $this->company_name;
    }

    public function week()
    {
        return $this->week;
    }

    public function copy()
    {
        return $this->copy;
    }

    public function gross()
    {
        return $this->gross;
    }

    public function gross_total()
    {
        return $this->gross_total;
    }

    public function gross_rub()
    {
        return $this->gross_rub;
    }

    public function gross_total_rub()
    {
        return $this->gross_total_rub;
    }

    public function views()
    {
        return $this->views;
    }

    public function views_total()
    {
        return $this->views_total;
    }

    public function date_from($raw = false)
    {
        if ($raw) {
            return $this->date_from;
        }
        return $this->formatDate($this->date_from);
    }

    public function date_to($raw = false)
    {
        if ($raw) {
            return $this->date_to;
        }
        return $this->formatDate($this->date_to);
    }

    protected $id;
    protected $type;
    protected $position;
    protected $previous;
    protected $filmId;
    protected $name_origin;
    protected $name_ru;
    protected $company_name;
    protected $week;
    protected $copy;
    protected $gross;
    protected $gross_total;
    protected $gross_rub;
    protected $gross_total_rub;
    protected $views;
    protected $views_total;
    protected $date_from;
    protected $date_to;
}