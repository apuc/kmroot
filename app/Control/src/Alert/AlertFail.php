<?php
/**
 * @license MIT
 * @author Igor Sorokin <dspbee@pivasic.com>
 */
namespace Dspbee\Control\Alert;

/**
 * Class AlertFail
 * @package Dspbee\System\Alert
 */
class AlertFail extends Alert
{
    /**
     * AlertFail constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        $this->color = 'red';
        parent::__construct($message);
    }
}