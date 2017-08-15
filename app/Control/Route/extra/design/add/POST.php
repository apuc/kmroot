<?php
namespace Control\Route_extra_design_add;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Design\Design;

class POST extends AdminController
{
    /**
     * Create new ad's.
     */
    public function add()
    {
        $design = new Design($this->mysql());

        if ($design->add()) {
            $this->successMessage('Редизайн добавлен');
            $this->setRedirect($this->request->makeUrl('extra/design'));
        } else {
            $this->setErrorComment($design->error());
            $this->failMessage('Не удалось добавить редизайн');

            $this->addData([
                'post' => new PostBag()
            ]);
            $this->setTitle('Добавить редизайн');
            $this->setTemplate('design/add.html.php');
        }
    }
}