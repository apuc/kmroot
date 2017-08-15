<?php
namespace Control\Route_sys_log;

use Dspbee\Bundle\Common\Bag\PostBag;
use Dspbee\Bundle\Common\Bag\ServerBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\Log\Log;

/**
 * Class AJAX
 * @package Control\Route_sys_admin
 */
class AJAX extends AdminController
{
    /**
     * Get data for DataTable plugin.
     */
    public function getList()
    {
        $this->setContent((new Log($this->mysql()))->renderTable());
    }

    /**
     * Log image.
     */
    public function updateImage()
    {
        $id = (new PostBag())->fetch('id');
        $type = (new PostBag())->fetch('type');
        $log = new Log($this->mysql());
        $log->add($this->admin()->id(), $type, 'uploadImage', '', $id);
        $this->setContent('');
    }

    /**
     * Log image.
     */
    public function deleteImage()
    {
        $id = (new PostBag())->fetch('id');
        $type = (new PostBag())->fetch('type');
        $log = new Log($this->mysql());
        $log->add($this->admin()->id(), $type, 'deleteImage', '', $id);
        $this->setContent('');
    }

    /**
     * Log image.
     */
    public function cropImage()
    {
        $id = (new PostBag())->fetch('id');
        $type = (new PostBag())->fetch('type');
        $log = new Log($this->mysql());
        $log->add($this->admin()->id(), $type, 'cropImage', '', $id);
        $this->setContent('');
    }
}