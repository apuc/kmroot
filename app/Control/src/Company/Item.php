<?php
namespace Kinomania\Control\Company;

use Dspbee\Bundle\Data\TDataInit;
use Kinomania\System\Config\Path;
use Kinomania\System\Config\Server;

class Item
{
    use TDataInit;

    public function __construct()
    {
        $this->id = 0;
        $this->s = 0;
        $this->image = '';
        $this->type = '';
        $this->status = '';
        $this->name = '';
        $this->short_name = '';
        $this->site = '';
        $this->phone = '';
        $this->fax = '';
        $this->text = '';
        $this->kinometro = '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::COMPANY . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
    }
    
    public function id()
    {
        return $this->id;
    }

    public function type()
    {
        return $this->type;
    }

    public function status()
    {
        return $this->status;
    }

    public function image()
    {
        return $this->image;
    }

    public function name()
    {
        return $this->name;
    }

    public function short_name()
    {
        return $this->short_name;
    }

    public function site()
    {
        return $this->site;
    }

    public function phone()
    {
        return $this->phone;
    }

    public function fax()
    {
        return $this->fax;
    }

    public function text()
    {
        return $this->text;
    }

    public function kinometro()
    {
        return $this->kinometro;
    }

    protected $id;
    protected $s;
    protected $image;
    protected $type;
    protected $status;
    protected $name;
    protected $short_name;
    protected $site;
    protected $phone;
    protected $fax;
    protected $text;
    protected $kinometro;
}