<?php
namespace Control\Route_restore;

use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Control\Auth\Auth;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Controller\DefaultController;

/**
 * Class GET
 * @package Control\Route_restore
 */
class GET extends DefaultController
{
    use TRepository;
    
    public function index()
    {
        $hash = (new GetBag())->fetch('h');
        $restore = (new Auth($this->mysql()))->restore();
        if (!$restore->validateHash($hash)) {
            $hash = '';
        }
        $this->addData(['hash' => $hash]);
        $this->setTemplate('admin/auth/restore.html.php');
    }
}