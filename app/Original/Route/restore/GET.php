<?php
namespace Original\Route_restore;

use Dspbee\Bundle\Common\Bag\CookieBag;
use Dspbee\Bundle\Common\Bag\GetBag;
use Kinomania\Original\Auth\User\Restore;
use Kinomania\Original\Controller\DefaultController;
use Kinomania\System\Common\TRepository;

class GET extends DefaultController
{
    use TRepository;

    public function index()
    {
        $cookie = new CookieBag();
        if ($cookie->has('__user__')) {
            $this->setRedirect('/');
        } else {
            $hash = (new GetBag())->fetch('h');
            $restore = (new Restore($this->mysql()));
            if (!$restore->validateHash($hash)) {
                $hash = '';
            }
            $this->addData(['hash' => $hash]);
            $this->setTemplate('auth/restore.html.php');
        }
    }
}