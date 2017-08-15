<?php
namespace Original\Route_user_LOGIN_films;

use Kinomania\Original\Controller\DefaultController;
use Kinomania\Original\Logic\Users\Films;

/**
 * Class AJAX
 * @package Original\Route_user_LOGIN_settings
 */
class AJAX extends DefaultController
{
    /**
     * Vote film.
     */
    public function rate()
    {
        $rate = (new Films())->rate();
        $this->setContent($rate);
    }

    /**
     * Get user film rate.
     */
    public function getRate()
    {
        $rate = (new Films())->getRate();
        $this->setContent($rate);
    }

    /**
     * Add film to the collection.
     */
    public function addFilm()
    {
        $error = (new Films())->addFilm();
        $this->setContent($error);
    }

    /**
     * Remove user collection directory.
     */
    public function deleteFolder()
    {
        (new Films())->deleteFolder();
        $this->setContent('');
    }

    /**
     * Update collection directory.
     */
    public function editFolder()
    {
        $error = (new Films())->editFolder();
        $this->setContent($error);
    }

    /**
     * Create new folder.
     */
    public function addFolder()
    {
        $error = (new Films())->addFolder();
        $this->setContent($error);
    }

    /**
     * Change folder order.
     */
    public function order()
    {
        (new Films())->order();
        $this->setContent('');
    }

    /**
     * Change item order.
     */
    public function orderItem()
    {
        (new Films())->orderItem();
        $this->setContent('');
    }

    /**
     * Change item order.
     */
    public function moveItem()
    {
        $error = (new Films())->moveItem();
        $this->setContent($error);
    }

    /**
     * Get actors from folder.
     */
    public function folderContent()
    {
        $list = (new Films())->folderContent($this->request);
        $this->setContent(json_encode($list));
    }

    /**
     * Get user folders.
     */
    public function folderList()
    {
        $list = (new Films())->folderList($this->request);
        $this->setContent(json_encode($list));
    }
}