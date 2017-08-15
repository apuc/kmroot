<?php
namespace Kinomania\System\Controller;

use Dspbee\Core\BaseController;
use Dspbee\Core\Request;

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

        $this->data = [
            'title' => 'Kinomania',
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

    protected $data;
}