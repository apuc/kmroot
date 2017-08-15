<?php
namespace Control\Route_company;

use Kinomania\Control\Company\Company;
use Kinomania\Control\Controller\AdminController;

/**
 * Class POST
 * @package Control\Route_company
 */
class POST extends AdminController
{
    /**
     * Create new company.
     */
    public function add()
    {
        $company = new Company($this->mysql());

        if ($company->add()) {
            $this->successMessage('Компания добавлена');
            $this->setRedirect($this->request->makeUrl('company/edit?id=' . $company->insertId()));
        } else {
            $this->setErrorComment($company->error());
            switch ($company->error()) {
                case Company::NAME_EXIST:
                    $this->failMessage('Компания с таким названием уже имеется');
                    break;
                default:
                    $this->failMessage('Не удалось добавить компанию');
            }
            $this->setRedirect();
        }
    }
    
    /**
     * Remove company.
     */
    public function delete()
    {
        $company = new Company($this->mysql());

        if ($company->delete()) {
            $this->successMessage('Компания удалена');
        } else {
            $this->setErrorComment($company->error());
            $this->failMessage('Не удалось удалить компанию');
        }

        $this->setRedirect();
    }
}