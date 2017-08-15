<?php
/**
 * @license MIT
 * @author Igor Sorokin <dspbee@pivasic.com>
 */
namespace Dspbee\Control\Alert;

/**
 * Class AlertSuccess
 * @package Dspbee\System\Alert
 */
class AlertSuccess extends Alert
{
    /**
     * AlertSuccess constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        $this->color = 'green';
        parent::__construct($message);
    }
}