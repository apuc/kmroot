<?php
namespace Control\Route_company_edit;

use Kinomania\Control\Company\Company;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    
    public function edit()
    {
        $company = new Company($this->mysql());

        if ($company->edit()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect();
    }
}