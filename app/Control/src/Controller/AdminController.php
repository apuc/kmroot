<?php
namespace Kinomania\Control\Controller;

use Dspbee\Auth\User;
use Dspbee\Control\Alert\AlertFail;
use Dspbee\Control\Alert\AlertInfo;
use Dspbee\Control\Alert\AlertSuccess;
use Dspbee\Core\BaseController;
use Kinomania\Control\Auth\Auth;
use Kinomania\Control\Log\Log;
use Kinomania\Control\Template\Menu;
use Dspbee\Core\Request;
use Kinomania\System\Common\TRepository;
use Kinomania\System\Config\Server;

/**
 * Class AdminController
 * @package Kinomania\System\Controller
 */
class AdminController extends BaseController
{
    use TRepository;

    /**
     * @param string $packageRoot
     * @param Request $request
     */
    public function __construct($packageRoot, Request $request)
    {
        parent::__construct($packageRoot, $request);

        $this->root = dirname(dirname($packageRoot));
        $this->errorComment = '';
        
        /**
         * Check authorization and access rights.
         */
        $this->admin = (new Auth($this->mysql()))->access()->getUser('', $request->route(), $request->method(), true);
        switch ($this->admin->status()) {
            case User::ERROR_LOGIN:
                if ('GET' == $this->request->method()) {
                    if (!headers_sent()) {
                        setcookie('__admin__', '', time() - 3600 * 24 * 30, '/');
                    }
                    $this->setRedirect($request->makeUrl('login'));
                }
                exit();
                break;
            case User::ERROR_ACCESS:
                if ('GET' == $this->request->method()) {
                    $this->setRedirect($request->makeUrl('access'));
                }
                exit();
                break;
        }
        
        $this->data = [
            'title' => 'Kinomania',
            'static' => Server::STATIC[0],
            'menu' => (new Menu($this->request))->print()
        ];
    }

    /**
     * @param mixed $comment
     */
    public function setErrorComment($comment)
    {
        $this->errorComment = $comment;
    }

    /**
     * @param string $message
     */
    public function successMessage($message)
    {
        if (!empty($message)) {
            new AlertSuccess($message);
        }

        $handler = debug_backtrace()[1]['function'];
        $data = serialize($_POST);
        (new Log($this->mysql()))->add($this->admin->id(), $this->request->route(), $handler, false, '', $data, $this->request->method());
    }

    /**
     * @param string $message
     */
    public function failMessage($message)
    {
        if (!empty($message)) {
            new AlertFail($message);
        }

        $handler = debug_backtrace()[1]['function'];
        $data = serialize($_POST);
        (new Log($this->mysql()))->add($this->admin->id(), $this->request->route(), $handler, true, $this->errorComment, $data, $this->request->method());
    }

    /**
     * @param string $message
     */
    public function infoMessage($message)
    {
        new AlertInfo($message);
    }

    /**
     * @return User
     */
    public function admin(): User
    {
        return $this->admin;
    }


    /**
     * Add items to the template data array.
     *
     * @param array $data
     */
    public function addData(array $data)
    {
        $this->data = array_replace($this->data, $data);
    }

    /**
     * Change title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    /**
     * Extends BaseController method.
     *
     * @param string $name
     * @param array $data
     */
    public function setTemplate($name, array $data = [])
    {
        if (empty($this->data)) {
            $this->data = $data;
        }
        parent::setTemplate($name, $this->data);
    }

    /**
     * @return array
     */
    protected function getNumList()
    {
        preg_match_all('/\/\d+/u', $this->request->route(), $numList);
        $numList = $numList[0];
        $numList = array_map(function($val) {
            return intval(ltrim($val, '/'));
        }, $numList);
        return $numList;
    }

    protected $root;
    private $admin;
    private $errorComment;
    protected $data;
}