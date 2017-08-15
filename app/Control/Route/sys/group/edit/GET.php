<?php
namespace Control\Route_sys_group_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Admin\Group\Group;
use Kinomania\Control\Controller\AdminController;

/**
 * Class GET
 * @package Control\Route_sys_group_edit
 */
class GET extends AdminController
{
    public function index()
    {
        $group = (new Group($this->mysql()))->getByID((new GetBag())->fetchInt('id'));
        if (0 < $group->id()) {
            $this->addData([
                'group' => $group
            ]);
            $this->setTitle('Редактировать группу администраторов');
            $this->setTemplate('sys/group/edit.html.php');    
        } else {
            $this->setRedirect($this->request->makeUrl('sys/group'));   
        }
    }
}