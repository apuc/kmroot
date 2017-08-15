<?php
namespace Control\Route_sys_check;

use Dspbee\Bundle\Common\TFileSystem;
use Kinomania\Control\Controller\AdminController;

class POST extends AdminController
{
    use TFileSystem;

    public function resetOpCache()
    {
        if (!function_exists('opcache_reset')) {
            $this->infoMessage('Функция opcache_reset не определена');
        } else {
            if (opcache_reset()) {
                $this->successMessage('Кеш сброшен');
            } else {
                $this->failMessage('Кеш отключен');
            }
        }
        $this->setRedirect();
    }

    public function resetTemplate()
    {
        $this->removeFromDir($this->packageRoot . '/view/_cache');
        $this->removeFromDir(dirname($this->packageRoot) . '/Original/view/_cache');
        $this->successMessage('Кеш сброшен');
        $this->setRedirect();
    }

}