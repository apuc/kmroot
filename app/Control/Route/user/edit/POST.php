<?php
namespace Control\Route_user_edit;

use Dspbee\Bundle\Common\Bag\GetBag;
use Dspbee\Bundle\Data\TDataInit;
use Dspbee\Control\Alert\AlertFail;
use Dspbee\Control\Alert\AlertSuccess;
use Kinomania\Control\Controller\AdminController;
use Kinomania\Control\User\User;

/**
 * Class GET
 * @package Control\Route_index
 */
class POST extends AdminController
{
    use TDataInit;

    /**
     * Save user data
     */
    public function edit()
    {
        $user = new User($this->mysql());
        if ($user->edit()) {
            $this->successMessage('Пользователь сохранен');
            $this->setRedirect($this->request->makeUrl('user'));
        } else {
            $this->setErrorComment($user->error());
            switch ($user->error()) {
                case User::EMAIL_EXIST:
                    $this->failMessage('Пользователь с таким email уже имеется');
                    break;
                case User::EMPTY_PASSWORD:
                    $this->failMessage('Некорректный пароль');
                    break;
                case User::WRONG_EMAIL:
                    $this->failMessage('Ошибка в email');
                    break;
                default:
                    $this->failMessage('Не удалось сохранить изменения');
            }

            $this->addData([
                'user' => $user->getById((new GetBag())->fetchInt('id')),
            ]);
            $this->setTitle('Редактировать пользователя');
            $this->setTemplate('user/edit.html.php');
        }
    }
}