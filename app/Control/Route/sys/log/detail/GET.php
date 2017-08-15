<?php
namespace Control\Route_sys_log_detail;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;

class GET extends AdminController
{
    public function index()
    {
        $get = new GetBag();
        $id = $get->fetchInt('id');

        $log = new Log($this->mysql());
        $item = $log->getById($id);
        if (0 == $item->id()) {
            $this->setRedirect($this->request->makeUrl('sys/log'));
        } else {
            $this->addData([
                'item' => $item
            ]);
            $this->setTitle('Подробности лога');
            $this->setTemplate('sys/log/detail.html.php');
        }
    }
}