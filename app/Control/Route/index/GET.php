<?php
namespace Control\Route_index;

use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_index
 */
class GET extends AdminController
{
    public function index()
    {
        $list = [];
        $result = $this->mysql()->query("SELECT `key`, `count` FROM `count`");
        while ($row = $result->fetch_assoc()) {
            $list[$row['key']] = $row['count'];
        }
        $this->addData([
            'list' => $list
        ]);
        $this->setTitle('Администрирование сайта киномания');
        $this->setTemplate('index/index.html.php');
    }
}