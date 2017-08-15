<?php
namespace Control\Route_award_year_D_D;

use Kinomania\Control\Award\Set\Set;
use Kinomania\Control\Award\Year\Year;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    public function editDate()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $yearOp = new Year($this->mysql());

        if ($yearOp->editDate($awardId, $year)) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($yearOp->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect($this->request->makeUrl("/award/year/{$awardId}/{$year}"));
    }

    /**
     * Add new nominee.
     */
    public function add()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $set = new Set($this->mysql());
        if ($set->add($awardId, $year)) {
            $this->successMessage('Номинант добавлен');
        } else {
            $this->setErrorComment($set->error());
            $this->failMessage('Не удалось добавить номинанта');
        }

        $this->setRedirect($this->request->makeUrl("/award/year/{$awardId}/{$year}"));
    }
    
    
    /**
     * Delete nominee.
     */
    public function deleteNominee()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $set = new Set($this->mysql());
        if ($set->deleteNominee()) {
            $this->successMessage('Номинант удалён');
        } else {
            $this->setErrorComment($set->error());
            $this->failMessage('Не удалось удалить номинанта');
        }

        $this->setRedirect($this->request->makeUrl("/award/year/{$awardId}/{$year}"));
    }

    /**
     * Edit nominee.
     */
    public function editNominee()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $set = new Set($this->mysql());
        if ($set->editNominee()) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($set->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect($this->request->makeUrl("/award/year/{$awardId}/{$year}"));
    }

    /**
     * Edit winners.
     */
    public function editWin()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $set = new Set($this->mysql());
        if ($set->editWin($awardId, $year)) {
            $this->successMessage('Изменения сохранены');
        } else {
            $this->setErrorComment($set->error());
            $this->failMessage('Не удалось сохранить изменения');
        }

        $this->setRedirect($this->request->makeUrl("/award/year/{$awardId}/{$year}"));
    }

    /**
     * Delete award year and all linked data.
     */
    public function deleteAwardYear()
    {
        $numList = $this->getNumList();

        $awardId = $numList[0];
        $year = $numList[1];

        $yearOp = new Year($this->mysql());
        $setOp = new Set($this->mysql());

        if ($yearOp->delete($awardId, $year) && $setOp->delete($awardId, $year)) {
            $this->successMessage('Год удалён');
        } else {
            $this->setErrorComment($setOp->error());
            $this->failMessage('Не удалось удалить год');
        }
        
        $this->setRedirect($this->request->makeUrl('award'));
    }
}