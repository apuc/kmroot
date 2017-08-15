<?php
namespace Kinomania\Control\News;

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
        $this->status = '';
        $this->category = '';
        $this->center = '';
        $this->popular = '';
        $this->publish = '';
        $this->authorId = 0;
        $this->title = '';
        $this->title_html = '';
        $this->meta_description = '';
        $this->title_short = '';
        $this->text = '';
        $this->text_short = '';
        $this->anons = '';
        $this->filmId = 0;

        $this->tag = '';
    }

    /**
     * @param bool $force
     * @return string
     */
    public function imageSrc($force = false)
    {
        if ($force || !empty($this->image())) {
            $iName = md5($this->id);
            return Server::STATIC[$this->s] . Path::NEWS . substr($iName, 0, 1) . '/' . substr($iName, 1, 2) . '/' . $iName . '.' . $this->image;
        }
        return '';
    }

    /**
     * @return string
     */
    public function link()
    {
        switch ($this->category) {
            case 'Новости кино':
            case 'Зарубежные сериалы':
            case 'Российские сериалы':
            case 'Арткиномания':
            case 'Фестивали и премии':
                return 'news';
                break;
        }
        
        return 'article';
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

    public function status()
    {
        return $this->status;
    }

    public function category()
    {
        return $this->category;
    }

    public function center()
    {
        return $this->center;
    }

    public function popular()
    {
        return $this->popular;
    }

    public function publish()
    {
        return $this->publish;
    }

    public function authorId()
    {
        return $this->authorId;
    }

    public function title()
    {
        return $this->title;
    }

    public function title_html()
    {
        return $this->title_html;
    }

    public function meta_description()
    {
        return $this->meta_description;
    }

    public function title_short()
    {
        return $this->title_short;
    }

    public function text()
    {
        return $this->text;
    }

    public function text_short()
    {
        return $this->text_short;
    }

    public function anons()
    {
        return $this->anons;
    }

    public function filmId()
    {
        if (0 == $this->filmId) {
            return '';
        }
        return $this->filmId;
    }

    public function tag()
    {
        return $this->tag;
    }

    protected $id;
    protected $s;
    protected $image;
    protected $status;
    protected $category;
    protected $center;
    protected $popular;
    protected $publish;
    protected $authorId;
    protected $title;
    protected $title_html;
    protected $meta_description;
    protected $title_short;
    protected $text;
    protected $text_short;
    protected $anons;
    protected $filmId;

    protected $tag;
}