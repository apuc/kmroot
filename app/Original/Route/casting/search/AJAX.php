<?php
namespace Original\Route_casting_search;

use Kinomania\Control\Storage\Autocomplete;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Casting\Casting;
use Kinomania\System\Common\TRepository;

class AJAX extends DefaultController
{
    use TRepository;

    public function search()
    {
        $casting = new Casting();
        $this->setContent(json_encode($casting->search()));
    }
    
    /**
     * Ethnic autocomplete.
     */
    public function getEthnic()
    {
        $this->setContent((new Autocomplete($this->mysql()))->ethnic());
    }

    /**
     * Sport autocomplete.
     */
    public function getSport()
    {
        $this->setContent((new Autocomplete($this->mysql()))->sport());
    }

    /**
     * Language autocomplete.
     */
    public function getLanguage()
    {
        $this->setContent((new Autocomplete($this->mysql()))->language());
    }

    /**
     * Music Instrument autocomplete.
     */
    public function getMusicInstrument()
    {
        $this->setContent((new Autocomplete($this->mysql()))->musicInstrument());
    }

    /**
     * Dance autocomplete.
     */
    public function getDance()
    {
        $this->setContent((new Autocomplete($this->mysql()))->dance());
    }

    /**
     * Sing autocomplete.
     */
    public function getSing()
    {
        $this->setContent((new Autocomplete($this->mysql()))->sing());
    }
}