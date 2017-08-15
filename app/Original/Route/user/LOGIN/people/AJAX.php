<?php
namespace Original\Route_user_LOGIN_people;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Users\People;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Text\TText;

/**
 * Class AJAX
 * @package Original\Route_user_LOGIN_settings
 */
class AJAX extends DefaultController
{
    use TRepository;
    use TText;

    /**
     * Add person to the collection.
     */
    public function addPerson()
    {
        $error = (new People())->addPerson();
        $this->setContent($error);
    }

    /**
     * Remove user collection directory.
     */
    public function deleteFolder()
    {
        (new People())->deleteFolder();
        $this->setContent('');
    }

    /**
     * Update collection directory.
     */
    public function editFolder()
    {
        $error = (new People())->editFolder();
        $this->setContent($error);
    }

    /**
     * Create new folder.
     */
    public function addFolder()
    {
        $error = (new People())->addFolder();
        $this->setContent($error);
    }

    /**
     * Change folder order.
     */
    public function order()
    {
        (new People())->order();
        $this->setContent('');
    }

    /**
     * Change item order.
     */
    public function orderItem()
    {
        (new People())->orderItem();
        $this->setContent('');
    }

    /**
     * Change item order.
     */
    public function moveItem()
    {
        $error = (new People())->moveItem();
        $this->setContent($error);
    }

    /**
     * Get actors from folder.
     */
    public function folderContent()
    {
        $list = (new People())->folderContent($this->request);
        $this->setContent(json_encode($list));
    }

    /**
     * Get user folders.
     */
    public function folderList()
    {
        $list = (new People())->folderList($this->request);
        $this->setContent(json_encode($list));
    }
}