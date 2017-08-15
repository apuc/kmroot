<?php
namespace Control\Route_person_casting;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Server\StaticS;
use Kinomania\Control\Storage\Autocomplete;
use Kinomania\System\Config\Server;

class AJAX extends AdminController
{
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