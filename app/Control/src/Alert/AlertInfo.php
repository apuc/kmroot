<?php
/**
 * @license MIT
 * @author Igor Sorokin <dspbee@pivasic.com>
 */
namespace Dspbee\Control\Alert;

/**
 * Class AlertInfo
 * @package Dspbee\System\Alert
 */
class AlertInfo extends Alert
{
    /**
     * AlertInfo constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        $this->color = 'blue';
        parent::__construct($message);
    }
}