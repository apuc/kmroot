<?php
namespace Control\Route_news;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\News\News;
use Kinomania\System\Text\TText;

class AJAX extends AdminController
{
    use TText;

    public function checkTitle()
    {
        $this->setContent('true');
        
        /**
        $exist = false;

        $title = (new GetBag())->fetch('title');
        $title = $this->clearText($title);
        $title = $this->mysql()->real_escape_string($title);
        $result = $this->mysql()->query("SELECT 1 FROM `news` WHERE `title` = '{$title}' LIMIT 1");
        if (1 == $result->num_rows) {
            $exist = true;
        }

        if ($exist) {
            $this->setContent('false');
        } else {
            $this->setContent('true');
        }
         * **/
    }

    public function getList()
    {
        $this->setContent((new News($this->mysql()))->renderTable());
    }
}