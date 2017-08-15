<?php
namespace Control\Route_extra_design_edit;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Design\Design;

class POST extends AdminController
{
    /**
     * Edit ad's.
     */
    public function edit()
    {
        $design = new Design($this->mysql());

        if ($design->edit($this->packageRoot)) {
            $this->successMessage('Изменения сохранены');
            $this->setRedirect($this->request->makeUrl('extra/design'));
        } else {
            $this->setErrorComment($design->error());
            $this->failMessage('Не удалось созранить изменения');

            $this->addData([
                'post' => new PostBag()
            ]);
            $this->setTitle('Редактировать редизайн');
            $this->setTemplate('design/edit.html.php');
        }
    }
}