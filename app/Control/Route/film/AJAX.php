<?php
namespace Control\Route_film;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Film\Film;
use Kinomania\Control\Person\Person;

class AJAX extends AdminController
{
    /**
     * Add new film.
     */
    public function add()
    {
        $film = new Film($this->mysql());
        
        $data['error'] = '';

        if ($film->add()) {
            $this->successMessage('');
            $data['id'] = $film->insertedId();
        } else {
            $data['error'] = 3;
            $this->setErrorComment($film->error());
            $this->failMessage('');

            if (Film::FILM_EXIST == $film->error()) {
                $data['error'] = 1;
            }
        }

        $this->setContent(json_encode($data));
    }
    
    public function getList()
    {
        $this->setContent((new Film($this->mysql()))->renderTable());
    }

}