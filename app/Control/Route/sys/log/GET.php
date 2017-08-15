<?php
namespace Control\Route_sys_log;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Admin;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_admin
 */
class GET extends AdminController
{
    /**
     * Administrators.
     */
    public function index()
    {
        $get = new GetBag();

        $from = $get->fetch('from');
        $to = $get->fetch('to');
        $adminId = $get->fetchInt('adminId');
        $objId = $get->fetchInt('objId');

        $getParameter = '';
        if (0 < $adminId) {
            $getParameter .= '&adminId=' . $adminId;
        } else {
            $adminId = '';
        }
        if (0 < $objId) {
            $getParameter .= '&objId=' . $objId;
        } else {
            $objId = '';
        }
        if (!empty($from)) {
            $getParameter .= '&from=' . $from;
        }
        if (!empty($to)) {
            $getParameter .= '&to=' . $to;
        }

        $this->addData([
            'getParameter' => $getParameter,
            'from' => $from,
            'to' => $to,
            'adminId' => $adminId,
            'objId' => $objId,
            'adminList' => (new Admin($this->mysql()))->getAdminList()
        ]);

        $this->setTitle('Журнал действий');
        $this->setTemplate('sys/log/index.html.php');
    }
}