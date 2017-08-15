<?php
namespace Control\Route_person;

use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Person\Person;

class AJAX extends AdminController
{
    /**
     * Add new person.
     */
    public function add()
    {
        $person = new Person($this->mysql());

        $data['error'] = '';

        if ($person->add()) {
            $this->successMessage('');
            $data['id'] = $person->insertedId();
        } else {
            $data['error'] = 3;
            $this->setErrorComment($person->error());
            $this->failMessage('');

            if (Person::PERSON_EXIST == $person->error()) {
                $data['error'] = 1;
            }
        }

        $this->setContent(json_encode($data));
    }
    
    public function getList()
    {
        $this->setContent((new Person($this->mysql()))->renderTable());
    }

}