<?php
namespace Kinomania\System\Parser;

use Kinomania\System\Debug\Debug;
use Kinomania\System\Parser\Boxoffice\Kinometro;
use Kinomania\System\Parser\Boxoffice\Mojo;
use Kinomania\System\Parser\Film\ImdbFilm;
use Kinomania\System\Parser\Film\KPFilm;
use Kinomania\System\Parser\Film\KTFilm;
use Kinomania\System\Parser\Person\ImdbPerson;
use Kinomania\System\Parser\Person\KPPerson;
use Kinomania\System\Parser\Person\KTPerson;
use Kinomania\System\Parser\VseTV\VseTV;

/**
 * Class Parser
 * @package Kinomania\System\Parser
 */
class Parser
{
    public function __construct($local)
    {
        $this->local = $local;
        $this->error = 0;
        $this->data = [];
        $this->parser = '';
    }
    
    public function imdb_film($url)
    {
        $parser = new ImdbFilm();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'imdb film ' . ($this->data['imdbId'] ?? '');
    }
    
    public function kt_film($url)
    {
        $parser = new KTFilm();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'kt film ' . ($this->data['ktId'] ?? '');
    }
    
    public function kp_film($url)
    {
        $parser = new KPFilm();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'kp film ' . ($this->data['kpId'] ?? '');
    }
    
    public function imdb_person($url)
    {
        $parser = new ImdbPerson();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'imdb person' . ($this->data['imdbId'] ?? '');
    }
    
    public function kt_person($url)
    {
        $parser = new KTPerson();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'kt person' . ($this->data['ktId'] ?? '');
    }
    
    public function kp_person($url)
    {
        $parser = new KPPerson();
        $this->data = $parser->parseMain($url, $this->local);
        $this->error = $parser->error();
        $this->parser = 'kp person' . ($this->data['kpId'] ?? '');
    }

    public function kinometro_ru($url)
    {
        $parser = new Kinometro();
        $this->data = $parser->parse($url);
        $this->error = $parser->error();
        $this->parser = 'boxoffice kinometro';
    }

    public function mojo($url)
    {
        $parser = new Mojo();
        $this->data = $parser->parse($url);
        $this->error = $parser->error();
        $this->parser = 'boxoffice mojo';
    }

    public function tv($url)
    {
        $parser = new VseTV();
        $this->data = $parser->parse($url);
        $this->error = $parser->error();
        $this->parser = 'vsetv';
    }
    
    public function log(\mysqli $db)
    {
        if (!empty($this->error)) {
            $db->query("INSERT INTO `log_parser` SET `parser` = '{$this->parser}', `description` = '{$this->error}', `status` = 'error'");
        } else {
            $db->query("INSERT INTO `log_parser` SET `parser` = '{$this->parser}', `description` = '', `status` = 'ok'");
        }
    }
    
    public function data()
    {
        return $this->data;
    }
    
    public function error()
    {
        return $this->error;
    }
    
    private $local;
    private $error;
    private $data;
    private $parser;
}