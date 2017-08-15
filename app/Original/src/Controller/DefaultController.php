<?php
namespace Kinomania\Original\Controller;

use Dspbee\Bundle\Debug\Wrap;
use Dspbee\Core\BaseController;
use Dspbee\Core\Request;
use Kinomania\System\Config\Server;

/**
 * Class DefaultController
 * @package Kinomania\System\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @param string $packageRoot
     * @param Request $request
     */
    public function __construct($packageRoot, Request $request)
    {
        parent::__construct($packageRoot, $request);

        $static = '';
        if (!Wrap::$debugEnabled) {
            $static = Server::STATIC[0];
        }

        $this->data = [
            'static' => $static,
        ];
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

    protected $data;
}